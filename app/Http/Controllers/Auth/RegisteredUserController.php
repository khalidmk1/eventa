<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{

    public function __construct(){
        $this->county=['Casablanca','Ad Dakhla','Ad Darwa','Agadir','Aguelmous','Ain El Aouda','Ait Melloul','Ait Ourir','Al Aaroui','Al Fqih Ben Çalah',
        'Al Hoceïma','Al Khmissat','Al ’Attawia','Arfoud','Azemmour','Aziylal','Azrou','Aïn Harrouda','Aïn Taoujdat','Barrechid','Ben Guerir','Beni Yakhlef',
        'Berkane','Biougra','Bir Jdid','Bou Arfa','Boujad','Bouknadel','Bouskoura','Béni Mellal','Chichaoua','Demnat','El Aïoun','El Hajeb','El Jadid',
       'El Kelaa des Srarhna','Errachidia','Fnidq','Fès','Guelmim','Guercif','Iheddadene','Imzouren','Inezgane','Jerada','Kenitra','Khemis Sahel','Khénifra',
        'Kouribga','Ksar El Kebir','Larache','Laâyoune','Marrakech','Martil','Mechraa Bel Ksiri','Mediouna','Mehdya','Meknès','Midalt','Missour','Mohammedia',
       'Moulay Abdallah','Moulay Bousselham','Mrirt','My Drarga','M’diq','Nador','Oued Zem','Ouezzane','Oujda-Angad','Oulad Barhil','Oulad Tayeb','Oulad Teïma',
       'Oulad Yaïch','Qasbat Tadla','Rabat','Safi','Sale','Sefrou','Settat','Sidi Bennour','Sidi Qacem','Sidi Slimane','Sidi Smai’il','Sidi Yahia El Gharb',
       'Sidi Yahya Zaer','Skhirate','Souk et Tnine Jorf el Mellah','Tahla','Tameslouht','Tangier','Taourirt','Taza','Temara','Temsia','Tifariti','Tit Mellil',
       'Tétouan','Youssoufia','Zagora','Zawyat ech Cheïkh','Zaïo','Zeghanghane',
    ];
    }

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register' )->with('county' , $this->county);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {


        $user = new User();
       
        $validationRules = [
            'image' =>['required', 'file'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'county' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
        
        if ($request->role === 'Organizer') {
            $validationRules = array_merge($validationRules, [
                'adresse' => ['required', 'string', 'max:255'],
                'organization_name' => ['required', 'string', 'max:255'],
                'organization_link' => ['required', 'string', 'max:255'],
            ]);
        }
        
        $validatForme = $request->validate($validationRules);
        

$avatar = $validatForme['image'];

if($request->hasFile('image')){
    $filename = time() . '_' . $avatar->getClientOriginalName();
    $path = $avatar->storeAs('avatars', $filename, 'public');
} 

$user->image = $filename;
$user->first_name = $validatForme['first_name'];
$user->last_name = $validatForme['last_name'];

$slug =Str::slug($request->first_name,"_");
$user->slug = uniqid().'_'.$slug;

$user->email = $validatForme['email'];
$user->password = Hash::make($validatForme['password']);
$user->role = $validatForme['role'];
$user->phone = $validatForme['phone'];
$user->county = $validatForme['county'];
$user->adresse = $validatedForm['adresse'] ?? null;
$user->organization_name = $validatedForm['organization_name'] ?? null;
$user->organization_link = $validatedForm['organization_link'] ?? null;
$user->block = false;


$user->save();



return response()->json(['message' => 'user created successfully']);

}
}




