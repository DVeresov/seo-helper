<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModxApiClient;
use Illuminate\View\View;

class ModxApiClientController extends Controller
{
    public function getStructure(): View
    {
        $client = new ModxApiClient();
        $response = $client->getStructure();

        return view('structure', ['structure' => $response]);
    }

}
