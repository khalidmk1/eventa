<?php

namespace App\Http\Controllers;
use App\Models\Events;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function home(){
        
        return view('landing_page.home');
    }
}
