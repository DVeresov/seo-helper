<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class ModxApiClient extends Model
{
    public function getStructure(): array|null
    {
        $response = Http::get('https://developer:123456qq@danil.dev.ngpromo.pro/api/api.php', [
            'action' => 'get_structure'
        ]);

        return $response->json();
    }

    public function getPage(int $id): array
    {
        $response = Http::get('https://developer:123456qq@danil.dev.ngpromo.pro/api/api.php', [
            'action' => 'get_page',
            'id' => $id
        ]);

        return $response->json();
    }

}
