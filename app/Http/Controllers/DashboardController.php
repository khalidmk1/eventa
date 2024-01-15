<?php

namespace App\Http\Controllers;
use App\Models\Events;
use App\Models\EventsAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\File;


class DashboardController extends Controller
{

    public function __construct(){
        $this->city=["Casablanca","El Kelaa des Srarhna","Fès","Tangier","Marrakech","Sale","Mediouna","Rabat",
        "Meknès","Oujda-Angad","Kenitra","Agadir","Tétouan","Taourirt","Temara","Safi","Khénifra","Laâyoune","Mohammedia",
        "Kouribga","El Jadid","Béni Mellal","Ait Melloul","Nador","Taza","Settat","Barrechid","Al Khmissat","Inezgane",
        "Ksar El Kebir","Larache","Guelmim","Berkane","Khemis Sahel","Ad Dakhla","Bouskoura","Al Fqih Ben Çalah",
        "Oued Zem","Sidi Slimane","Errachidia","Guercif","Oulad Teïma","Ben Guerir","Sefrou","Fnidq","Sidi Qacem",
        "Moulay Abdallah","Youssoufia","Martil","Aïn Harrouda","Skhirate","Ouezzane","Sidi Yahya Zaer",
        "Al Hoceïma","M’diq","Sidi Bennour","Midalt","Azrou","My Drarga","Ain El Aouda","Beni Yakhlef","Ad Darwa",
        "Al Aaroui","Qasbat Tadla","Boujad","Jerada","Mrirt","El Aïoun","Azemmour","Temsia","Zagora","Ait Ourir",
        "Aziylal","Sidi Yahia El Gharb","Biougra","Zaïo","Aguelmous","El Hajeb","Zeghanghane","Imzouren","Tit Mellil",
        "Mechraa Bel Ksiri","Al ’Attawia","Demnat","Arfoud","Tameslouht","Bou Arfa","Sidi Smai’il","Souk et Tnine Jorf el Mellah",
        "Mehdya","Aïn Taoujdat","Chichaoua","Tahla","Oulad Yaïch","Moulay Bousselham","Iheddadene","Missour","Zawyat ech Cheïkh",
        "Bouknadel","Oulad Tayeb","Oulad Barhil","Bir Jdid","Tifariti"];
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

    public function home(){
        return view('dashboard.home');
    }

    

   

   

     //Controllers of admin

   



     //Controllers of organizare


     public function show(){
        $events = Events::where('user_id' , auth()->user()->id)->get();
        $extensions = [];

        foreach ($events as $event) {
            $extensions[] = pathinfo($event->video, PATHINFO_EXTENSION);
        }
        return view('dashboard.organizare.events.show')->with(['events'=>$events , 'extensions' => $extensions]);
    }

    public function detail($slug){
        $event = Events::where('slug' , $slug)->first();
        $extension =pathinfo($event->video, PATHINFO_EXTENSION);
        return view('dashboard.organizare.events.detail')->with(['event'=>$event , 
        'extension'=>$extension]);
    }

    public function create(){
        return view('dashboard.organizare.events.create')->with(['categories'=>$this->categories, 
        'sport_tags'=>$this->sport_tags , 'Conferences_tags' =>$this->Conferences_tags,
        'expos_tags' =>$this->expos_tags , 'concerts_tags' =>$this->concerts_tags ,
        'Festivals_tags' =>$this->Festivals_tags , 'Performing_arts_tags'=> $this->Performing_arts_tags,
        'Community_tags' =>$this->Community_tags , 'city' => $this->city

    ]);
    }


    public function assetevent(Request $request){

       /*  $eventasset = new EventsAsset(); */

       /*  dd($eventasset); */
/* 
        $video = $request->file('video'); */
        /*  dd($video_image); */

       /*  $originalName = time() . '_' . $video->getClientOriginalName(); */
       /*  $storagePath = $video->storeAs('event/video', $originalName, 'public'); */

       // Set the path to the video file
       $filePath = $request->file('video')->getRealPath();
       $chunkSize = 10 * 1024 * 1024; // 10MB chunks (you can adjust this as needed)
       
       $fileHandle = fopen($filePath, 'rb');
       
       if ($fileHandle !== false) {
           $chunkIndex = 1;
       
           // Create the directory if it doesn't exist
           $tempDirectory = storage_path('app/temp/');
           if (!File::isDirectory($tempDirectory)) {
               File::makeDirectory($tempDirectory, 0777, true, true);
           }
       
           while (!feof($fileHandle)) {
               $chunkContent = fread($fileHandle, $chunkSize);
       
               $chunkFilePath = $tempDirectory . 'chunk_' . $chunkIndex;
               file_put_contents($chunkFilePath, $chunkContent);
       
               $uploadedChunk = Cloudinary::upload($chunkFilePath, [
                   'resource_type' => 'video',
                   'folder' => 'uploads',
               ]);
       
               $secureUrl = $uploadedChunk->getSecurePath();
       
               // Process or store the URL as needed
               // ...
               return response()->json($secureUrl);
       
               $chunkIndex++;
           }
       
           fclose($fileHandle);
       }

        
    // Upload the video to Cloudinary
   /*  $uploadedVideo = Cloudinary::upload($fileHandle, [
        'folder' => 'uploads',
        'resource_type' => 'video',
        'transformation' => [
            'width' => 350,
            'height' => 200,
            'crop' => 'fill',
        ],
    ]);
 */
    // Get the secure URL of the transformed video
    /* $secureUrl = $uploadedVideo->getSecurePath(); */

  /*   return response()->json($secureUrl); */


      /*   return response()->json($data, 200, $headers); */


      /*   $eventasset->video = $originalName; */


       /*  if($video_image && $video_image->isValid()){
            CompressVideo::dispatch($video_image)->onQueue('fileuploads');
        }

        $eventasset->create([
            'user_id' => auth()->user()->id,
            'events_id'
        ]); */


    
        /*  if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])){
             dd($originalName); 
            
            
    
         }
         if(in_array($extension , ['mp4', 'avi', 'mov'])){
    
               // Store the original file
              
               // Dispatch the job for video compression
               CompressVideo::dispatch($originalPath, $originalName);
               $event->video = $originalName;
              
         } */

         
        /*  if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])){
            Storage::delete('public/event/image/' . $originalName);
   
        }
        if(in_array($extension , ['mp4', 'avi', 'mov']) ){

            Storage::delete('public/event/video/' . $originalName); 
        } */

        return response()->json($video_image);
    }

    public function store(Request $request){

           // Validate the request data
    $validator = Validator::make($request->all(), [
      /*   'video' => 'required|file', */
        'title' => 'required|string|max:255',
        'tags' => 'required|array',
        'adresse' =>'required|string|max:255',
        'date_start' => 'required',
        'date_end' => 'required',
        'categories' => 'required|array',
        'description' => 'required|string|max:65535',
        'programme' => 'required|array',
        'city' => 'required|string|max:255'
    ]);
        

 // If the validation fails, return the errors
 if ($validator->fails()) {
    
    return response()->json(['errors' => $validator->errors()], 422);

}else{

    $event = new Events();

    /* dd($event); */

     
     
  
       
         foreach ($request->input('categories') as $categorie) {
             $UploadCategories[] = $categorie;
         }
        
 
        
         foreach ($request->input('tags') as $tag) {
             $UploadTags[] = $tag;
         }
         
         
 
         foreach($request->input('programme') as $programmes) {
             $UploadProgrammes[] = $programmes;
         }

         $currentDate = new \DateTime('now');

         // Convert input date strings to DateTime objects
         $dateStart = \DateTime::createFromFormat('m/d/Y h:i A', $request->input('date_start'));
         $dateEnd = \DateTime::createFromFormat('m/d/Y h:i A', $request->input('date_end'));
         
         $event->user_id = auth()->user()->id; 
        
         $price = $request->input('price');

         if($price){
            $event->price = $price; 
         }else{
            $event->price = 'free';
         }
         
         $event->city = $request->input('city');
         $event->adresse = $request->input('adresse');

         $event->date_start = $dateStart;
         $event->date_end = $dateEnd;

         $event->description = $request->input('description');
         $slug = Str::slug($request->input('title'), '_');
         $event->title = $request->input('title');
         $event->slug = $slug.'_' .uniqid()  ;
         
         $event->tags = $UploadTags;
         $event->categorie = $UploadCategories;
         $event->programme = $UploadProgrammes;
        

         if ($currentDate < $dateStart && $dateStart < $dateEnd) {
            // Your event creation logic
            $event->save();
            return response()->json(['message' => 'Event created successfully']);
        } else {

            return response()->json(['message' => 'The date is invalid']);
        }

   
}



    }
    

    public function checked_paticipated(){
        
        return view('dashboard.organizare.table.pariticipated');
    }
   

}
