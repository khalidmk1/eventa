<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
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
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login')->with(['county'=>$this->county]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
