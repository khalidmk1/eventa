<?php

namespace App\Http\Controllers;
use App\Models\Events;
use App\Models\User;
use App\Models\EventFolow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class LandingPageController extends Controller
{

    public function __construct(){
        $this->categories = ['Sports', 'Conferences' , 'Expos' , 'Concerts' , 'Festivals' , 'Performing arts' ,'Community'];
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
        $events = Events::take(3)->get();
        if($events){

            
    $extensions = [];
    
    foreach ($events as $event) {
        // Assuming that 'video' is a property of each event
        $extension = pathinfo($event->video, PATHINFO_EXTENSION);
        $extensions[] = $extension;
    }
    
    return view('landing_page.home')->with(['events' => $events, 'extensions' => $extensions , 'categories' => $this->categories ]);

    }else{
        return view('landing_page.home')->with('status' , 'No event has been created yet');
    }


    }

    public function show(Request $request){

      
        $searched_events = Events::query();

        if ($request->has('title')) {
            $searched_events->where('title', 'LIKE', "%{$request->title}%");
        }

        if($request->has('city')){
            $searched_events->where('city' , 'LIKE' , "%{$request->city}%");
        }

    
        if ($request->has('categorie')) {
            $categories = is_array($request->categorie) ? $request->categorie : [$request->categorie];
    
            $searched_events->where(function ($query) use ($categories) {
                foreach ($categories as $category) {
                    $query->orWhere('categorie', 'like', "%$category%");
                }
            });
        }
    
        if ($request->has('tags')) {
            $tags = is_array($request->tags) ? $request->tags : [$request->tags];
    
            $searched_events->where(function ($query) use ($tags) {
                foreach ($tags as $tag) {
                    $query->orWhere('tags', 'like', "%$tag%");
                }
            });
        }

        $events = $searched_events->get();
        
        $auth = Auth::check();

            if ($request->ajax()) {

               if(Auth::check()){
                $confirmedFolows = EventFolow::where('user_id' , auth()->user()->id)
                ->whereIn('event_id', $events->pluck('id'))
                ->where('confirmed', 1)
                ->get()
                ->groupBy('event_id');

              

                return response()->json([$events , $auth , $confirmedFolows]);
               }
               else{
                
                return response()->json([$events , $auth]);
               }

            }else{

                $events = Events::all();

                $extensions = [];
                
                foreach ($events as $event) {
                    // Assuming that 'video' is a property of each event
                    $extension = pathinfo($event->video, PATHINFO_EXTENSION);
                    $extensions[] = $extension;
                }   

        
               if(Auth::check()){
                $confirmedFolows = EventFolow::where('user_id' , auth()->user()->id)
                ->whereIn('event_id', $events->pluck('id'))
                ->where('confirmed', 1)
                ->get()
                ->groupBy('event_id');



                 
                return view('landing_page.events.show')->with([
                    'confirmedFolows'=> $confirmedFolows,
                    'events' => $events,
                    'extensions' => $extensions,
                    'city' => $this->city,
                    'categories' => $this->categories,
                    'sport_tags' => $this->sport_tags,
                    'Conferences_tags' => $this->Conferences_tags,
                    'expos_tags' => $this->expos_tags,
                    'concerts_tags' => $this->concerts_tags,
                    'Festivals_tags' => $this->Festivals_tags,
                    'Performing_arts_tags' => $this->Performing_arts_tags,
                    'Community_tags' => $this->Community_tags,
                ]);
               }else{
                return view('landing_page.events.show')->with([
                    'events' => $events,
                    'extensions' => $extensions,
                    'city' => $this->city,
                    'categories' => $this->categories,
                    'sport_tags' => $this->sport_tags,
                    'Conferences_tags' => $this->Conferences_tags,
                    'expos_tags' => $this->expos_tags,
                    'concerts_tags' => $this->concerts_tags,
                    'Festivals_tags' => $this->Festivals_tags,
                    'Performing_arts_tags' => $this->Performing_arts_tags,
                    'Community_tags' => $this->Community_tags,
                ]);
               }
            }
           
     
    }


    public function detail($slug){
        $event = Events::where('slug' , $slug)->first();
        $extension = pathinfo($event->video, PATHINFO_EXTENSION);
       if(Auth::check()){
        $confirmedFolows = EventFolow::where('user_id' , auth()->user()->id)
        ->whereIn('event_id', $event->pluck('id'))
        ->where('confirmed', 0)
        ->get()
        ->groupBy('event_id');
        
        return view('landing_page.events.detail')->with(['event' => $event ,  'extension' => $extension, 
        'confirmedFolows'=>$confirmedFolows ,
    ]);
       }else{
        return view('landing_page.events.detail')->with(['event' => $event ,  'extension' => $extension
    ]);
}
    
}

    public function edit(Request $request , $slug){

        $user = User::where('slug' , $slug)->first();

        $events = Events::where('user_id' , $user->id)->get();

        $extensions = [];
    
        foreach ($events as $event) {
            // Assuming that 'video' is a property of each event
            $extension = pathinfo($event->video, PATHINFO_EXTENSION);
            $extensions[] = $extension;
        }
        

       
        return view('landing_page.profile.show')->with([
            'user' => $user  , 'events' => $events , 'extensions' => $extensions ,
            'city' => $this->city,
           ]);
    }

    public function update(Request $request){

        $user = $request->user(); 
         // Validation rules
         $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^[0-9\(\)\s\-]+$/'],
            'email' => 'required|email|max:255',
            'county' => 'required|string|max:255',
        ];

        $validatedData = $request->validate($rules);
       
       

        if ($request->hasFile('image')) {
            
            $originaleName = time() . '_' . $request->file('image')->getClientOriginalName();
            // Delete the old image if it exists
            Storage::delete('public/avatars/' . $user->image);
        
            $imagePath = $request->file('image')->storeAs('avatars/' , $originaleName , 'public');
            $user->image = $originaleName;
        }

        $user->fill($validatedData);
       

    
        // Check if email is updated
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
    
       // Save the user
       $user->save();
       
       return redirect()->back()->with('status', 'Profile updated successfully');

    }


    public function event_folow($slug){
        if(Auth::check()){
            $event = Events::where('slug' , $slug )->first();
       
        $folow_false = EventFolow::where('user_id', auth()->user()->id)
            ->where('event_id', $event->id)
            ->where('confirmed', 0)
            ->first();
        
        $folow_true = EventFolow::where('user_id', auth()->user()->id)
            ->where('event_id', $event->id)
            ->where('confirmed', 1)
            ->first();
        
        if ($folow_false) {
            $message = 'folow true';
            $folow_false->update([
                'confirmed' => 1
            ]);
            return response()->json($message);
        } elseif ($folow_true) {
            $message = 'folow false';
            $folow_true->update([
                'confirmed' => 0
            ]);
            return response()->json($message);
        } else {
            $message = 'folow created';
            $newfolow = EventFolow::create([
                'user_id' => auth()->user()->id,
                'event_id' => $event->id,
                'confirmed' => 1
            ]);
            return response()->json($message);
        }
        }else{
            $message = 'please you need to be authenticated';
            return response()->json($message);
        }
    }

    public function Favoris_list(Request $request){

        $searched_events = Events::query();

        if ($request->has('title')) {
            $searched_events->where('title', 'LIKE', "%{$request->title}%");
        }

        if($request->has('city')){
            $searched_events->where('city' , 'LIKE' , "%{$request->city}%");
        }

    
        if ($request->has('categorie')) {
            $categories = is_array($request->categorie) ? $request->categorie : [$request->categorie];
    
            $searched_events->where(function ($query) use ($categories) {
                foreach ($categories as $category) {
                    $query->orWhere('categorie', 'like', "%$category%");
                }
            });
        }
    
        if ($request->has('tags')) {
            $tags = is_array($request->tags) ? $request->tags : [$request->tags];
    
            $searched_events->where(function ($query) use ($tags) {
                foreach ($tags as $tag) {
                    $query->orWhere('tags', 'like', "%$tag%");
                }
            });
        }

        $events = $searched_events->get();

            if ($request->ajax()) {

                return response()->json($events);

            }else{


                $events = EventFolow::with('event')->where('user_id', auth()->user()->id)
                ->where('confirmed', 1)
                ->get();

                $extensions = [];
                
                foreach ($events as $event) {
                    // Assuming that 'video' is a property of each event
                    $extension = pathinfo($event->event->video, PATHINFO_EXTENSION);
                    $extensions[] = $extension;
                }   
    
                 
                return view('landing_page.events.favoris')->with([
                    'events' => $events,
                    'extensions' => $extensions,
                    'city' => $this->city,
                    'categories' => $this->categories,
                    'sport_tags' => $this->sport_tags,
                    'Conferences_tags' => $this->Conferences_tags,
                    'expos_tags' => $this->expos_tags,
                    'concerts_tags' => $this->concerts_tags,
                    'Festivals_tags' => $this->Festivals_tags,
                    'Performing_arts_tags' => $this->Performing_arts_tags,
                    'Community_tags' => $this->Community_tags,
                ]);
               

            }




    }

    



}
