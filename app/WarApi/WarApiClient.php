<?php

namespace App\WarApi;

use App\Models\Map;
use Illuminate\Support\Facades\Http;

class WarApiClient
{
    public function __construct(protected string $baseUrl)
    {
    }

    public function get(string $path): \Illuminate\Http\Client\Response
    {
        return Http::get($this->baseUrl . $path);
    }

    /**
     * Make this api call with e_tag header to reduce server load
     * See https://github.com/clapfoot/warapi#rate-limiting-and-caching
     *
     * @param string $path
     * @param string $eTag
     * @return \Illuminate\Http\Client\Response
     */
    public function getWithETag(string $path, string $eTag): \Illuminate\Http\Client\Response
    {
        return Http::withHeaders(['If-None-Match' => $eTag ?? '"0"'])
            ->get($this->baseUrl . $path);
    }

    public function getWarData(): array
    {
        return $this->get('/war')->json();
    }

    public function getMapsData(): array
    {
        return $this->get('/maps')->json();
    }

    public function getDynamicMapData(Map $map): array|null
    {
        $response = $this->getWithETag('/maps/' . $map->hex_name . '/dynamic/public', $map->dynamic_e_tag);

        if ($response->status() === 304) {

            return null;
        }

        $dataArray = $response->json();
        $map->dynamic_e_tag = $response->header('ETag');
        $map->dynamic_timestamp = $dataArray['lastUpdated'];
        $map->save();

        return $dataArray;
    }

    public function getStaticMapData(Map $map): array|null
    {
        $response = $this->getWithETag('/maps/' . $map->hex_name . '/static', $map->static_e_tag);

        if ($response->status() === 304) {

            return null;
        }

        $map->static_e_tag = $response->header('ETag');
        $map->save();

        return $response->json();
    }

    public function getWarReportForMap(Map $map): array|null
    {
        $response = $this->getWithETag('/warReport/' . $map->hex_name, $map->report_e_tag);

        if ($response->status() === 304) {
            return null;
        }

        $map->report_e_tag = $response->header('ETag');
        $map->save();

        return $response->json();
    }
}
