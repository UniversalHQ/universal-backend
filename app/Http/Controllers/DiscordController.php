<?php

namespace App\Http\Controllers;

use App\Discord\AuthenticationService;

class DiscordController extends Controller
{
    public function redirectToDiscord()
    {
        $service = new AuthenticationService();

        return $service->discordRedirect();
    }

    public function callbackFromDiscord(\Illuminate\Http\Request $request)
    {
        $service = new AuthenticationService();
        if(!$service->validateState($request->state)){
            return response('Dont even try to fuck with me :)',422);
        }
        $service->loadOAuthAccessFromCode($request->code);
        $user = $service->getUserFromOAuthAccess();
        $service->syncUserGuilds();

        $user->tokens()->delete();
        $token = $user->createToken('api_token');

        return redirect(config('app.url_frontend') . '/login/' . $token->plainTextToken);
    }
}
