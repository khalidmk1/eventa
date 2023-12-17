<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{



    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('dashboard.profile.show', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $user = $request->user(); 
        // Update individual fields

        if ($request->hasFile('image')) {
            
            $originaleName = time() . '_' . $request->file('image')->getClientOriginalName();
            // Delete the old image if it exists
             Storage::delete('public/avatars/' . $user->image);
        
            $imagePath = $request->file('image')->storeAs('avatars/' , $originaleName , 'public');
            $user->image = $originaleName;
        }
      
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->phone = $request->input('phone');
        $user->organization_name = $request->input('organization_name');
        $user->email = $request->input('email');
        $user->organization_link = $request->input('organization_link');
        $user->county = $request->input('county');
        $user->adresse = $request->input('adresse');
    
        // Check if email is updated
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
    
        // Save the user
        $user->save();
    
        return redirect()->back()->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
