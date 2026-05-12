<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class EditPageController extends Controller
{
    public function getEditPage(): View
    {
        return view('edit');
    }
}
