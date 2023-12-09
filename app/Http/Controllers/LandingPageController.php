<?php

namespace App\Http\Controllers;
use App\Models\Events;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingPageController extends Controller
{

    public function __construct(){
        $this->categories = ['Sports', 'Conferences' , 'Expos' , 'Concerts' , 'Festivals' , 'Performing arts' ,'Community'];
    }

    public function home(){   
        $events = Events::take(3)->get();

    $extensions = [];
    
    foreach ($events as $event) {
        // Assuming that 'video' is a property of each event
        $extension = pathinfo($event->video, PATHINFO_EXTENSION);
        $extensions[] = $extension;
    }
    
    return view('landing_page.home')->with(['events' => $events, 'extensions' => $extensions , 'categories' => $this->categories ]);
    }

}
