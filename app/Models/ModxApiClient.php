<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class ModxApiClient extends Model
{
    protected function getBaseUrl(): string
    {
        $site_url = env('MODX_SITE_URL');
        $site_login = env('MODX_SITE_LOGIN');
        $site_password = env('MODX_SITE_PASSWORD');

        return "https://{$site_login}:{$site_password}@{$site_url}";
    }

    public function getStructure(): array|null
    {
        $response = Http::get($this->getBaseUrl(), [
            'action' => 'get_structure'
        ]);

        return $response->json();
    }

    public function getPage(int $id): array
    {
        $response = Http::get($this->getBaseUrl(), [
            'action' => 'get_page',
            'id' => $id
        ]);

        return $response->json();
    }

}
