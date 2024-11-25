<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtherController extends Controller
{
    public function faq()
    {
        return view('other.faq');
    }
}
