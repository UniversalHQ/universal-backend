<?php


namespace App\Discord;


use App\Models\Authentication;
use App\Models\Guild;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Http;

class AuthenticationService
{
    private string $accessToken;
    private string $refreshToken;
    private string $scope;
    private int $expiresIn;
    private int $userId;

    public function __construct(Authentication $authentication = null)
    {
        if ($authentication) {
            $this->loadOAuthAccessFromAuthentication($authentication);
        }
    }

    /**
     * @throws \Exception
     */
    public function loadOAuthAccessFromAuthentication(Authentication $authentication)
    {
        if ($authentication->type != 'discord') {
            throw new Exception('Not a Discord Authentication provided');
        }

        $this->accessToken = $authentication->accessToken;
        $this->refreshToken = $authentication->refreshToken;
        $this->scope = $authentication->scope;
        $this->expiresIn = $authentication->expiresIn;
        $this->userId = $authentication->user_id;
    }

    public function discordRedirect()
    {
        $state = $this->generateState();

        $parameters = http_build_query([
            'client_id'     => '855895920055156778',
            'state'         => $state,
            'response_type' => 'code',
            'scope'         => 'identify guilds',
            'grant_type'    => 'authorization_code',
            'prompt'        => 'none',
            'redirect_uri'  => config('app.url') . '/discord-callback',
        ]);

        return redirect()->away('https://discord.com/api/oauth2/authorize?' . $parameters);
    }

    public function loadOAuthAccessFromCode(string $code)
    {
        $body = [
            'client_id'     => env('DISCORD_CLIENT_ID'),
            'client_secret' => env('DISCORD_CLIENT_SECRET'),
            'grant_type'    => 'authorization_code',
            'code'          => $code,
            'redirect_uri'  => config('app.url') . '/discord-callback',
        ];
        $response = Http::asForm()->post('https://discord.com/api/oauth2/token', $body);
        $response = $response->json();
        $this->accessToken = $response['access_token'];
        $this->refreshToken = $response['refresh_token'];
        $this->scope = $response['scope'];
        $this->expiresIn = $response['expires_in'];
    }

    public function getUserFromOAuthAccess(): User
    {
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $this->accessToken])
                        ->get('https://discord.com/api/v9/users/@me');
        $response = $response->json();
        /** @var User $user */
        $user = User::updateOrCreate([
            'discord_id' => $response['id'],
        ], [
            'username'          => $response['username'],
            'discord_avatar_id' => $response['avatar'],
            'discriminator'     => $response['discriminator'],
            'discord_banner_id' => $response['banner'],
            'locale'            => $response['locale'],
        ]);
        $this->userId = $user->id;

        Authentication::updateOrCreate([
            'user_id' => $user->id,
            'type'    => 'discord',
        ], [
            'access_token'  => $this->accessToken,
            'refresh_token' => $this->refreshToken,
            'scope'         => $this->scope,
            'expires_in'    => $this->expiresIn,
        ]);

        return $user;
    }

    public function syncUserGuilds()
    {
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $this->accessToken])
                        ->get('https://discord.com/api/v9/users/@me/guilds');

        $guildData = collect($response->json());
        /** @var User $user */
        $user = User::find($this->userId);
        $guildData->each(function ($entry) use ($user) {
            $guild = Guild::updateOrCreate([
                'discord_id' => $entry['id'],
            ], [
                'discord_icon_id' => $entry['icon'],
                'name'            => $entry['name'],
            ]);
            $user->guilds()->attach($guild, ['owner' => $entry['owner']]);
        });

    }

    private function generateState(): string
    {
        $key = random_int(0, 9999);
        $value = base64_encode(random_bytes(32));
        cache([$key => $value]);

        return $key . '_' . $value;
    }

    public function validateState($state): bool
    {
        $state = explode('_', $state);
        $value = cache($state[0]);

        return $value == $state[1];
    }
}