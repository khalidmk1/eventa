<?php

namespace App\Http\Controllers;
use App\Models\Events;
use App\Jobs\CompressVideo;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Facades\Storage;


class DashboardController extends Controller
{

    public function __construct(){
        $this->categories = ['Sports', 'Conferences' , 'Expos' , 'Concerts' , 'Festivals' , 'Performing arts' ,'Community'];
        $this->sport_tags = ['american football' ,'basketball' , 'cricket' , 'baseball','NFL','NCAA','premier league','NASCAR','hockey','running','Football','skating',
        'golf','bicycling'];
        $this->Conferences_tags = ['International','Agriculture','Business','Sales','Food','Technology','Digital','Automotive','Education','Industrial','Tourism','Conferences'];
        $this->expos_tags = ['product', 'entertainment','family','attraction','construction', 'food','design','health','medical','packaging','craft','music','fashion'];
        $this->concerts_tags=['Rock','Instrument','Hip Hop','Pop','Rap','Jazz','Country','R&B','Music','Club','Skating'];
        $this->Festivals_tags=['movie','music','outdoor','family','fundraiser','performing-arts','entertainment','fashion','food','craft','community','agriculture'];
        $this->Performing_arts_tags =['Entertainment','Fundraiser','Social','Business','Festival','Music','Comedy','Concert','Family','Skating','Food'];
        $this->Community_tags = ['Farmers markets','Fetes and fairs','Parades','Fun runs','Fireworks','Rallies','Fundraising events','Night markets',
        'Special interest seminars','Faith-based talks and tours','Flea markets','Community workshops','Volunteering days'];
    }

    public function index(){
        return view('');
    }

     //Controllers of admin

   



     //Controllers of organizare

    public function create(){
        return view('dashboard.organizare.events.create')->with(['categories'=>$this->categories, 
        'sport_tags'=>$this->sport_tags , 'Conferences_tags' =>$this->Conferences_tags,
        'expos_tags' =>$this->expos_tags , 'concerts_tags' =>$this->concerts_tags ,
        'Festivals_tags' =>$this->Festivals_tags , 'Performing_arts_tags'=> $this->Performing_arts_tags,
        'Community_tags' =>$this->Community_tags

    ]);
    }

    public function store(Request $request){

        $event = new Events();

        $video = $request->video;

       

        if($video){
            // Store the original file
            $originalPath = $video->storeAs('originals', $video->getClientOriginalName(), 'public');
            // Dispatch the job for video compression
            CompressVideo::dispatch($originalPath, $video->getClientOriginalName());
            $compressedVideoPath = Storage::disk('public')->path('compressed/' . $video->getClientOriginalName());
            $event->video = $video->getClientOriginalName();
        }
       
      

            // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'tags' => 'required|array',
            'date' => 'required|string|max:255',
            'categories' => 'required|array',
            'description' => 'required|string|max:65535',
            'programme' => 'required|array',
        ]);

        foreach ($validatedData['categories'] as $categorie) {
            $UploadCategories[] = $categorie;
        }
        
        foreach ($validatedData['tags'] as $tag) {
            $UploadTags[] = $tag;
        }
        
        foreach($validatedData['programme'] as $programmes) {
            $UploadProgrammes[] = $programmes;
        }
        
        $event->user_id = auth()->user()->id; 
        $event->title = $validatedData['title'];
        $event->date =$validatedData['date'];
        $event->description = $validatedData['description'];
        $slug = Str::slug($validatedData['title'], '_');
        $existingSlug = Events::where('slug', $slug)->first();
        
        if($existingSlug){
            $event->slug = $slug. '-' . uniqid();
        }
        
        $event->tags = $UploadTags;
        $event->categorie = $UploadCategories;
        $event->programme = $UploadProgrammes;


        $event->save();



  









// You can return a response as needed
return response()->json(['message' => 'Event created successfully']);

    }
    
   

}
