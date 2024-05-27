<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Silber\Bouncer\BouncerFacade as Bouncer;

class UserController extends Controller
{


    public function createManagerForm()
    {
        return view('admin.create-manager');
    }

    public function storeManager(Request $request)
    {
        // Validacija podataka
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Kreiranje novog korisnika
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Dodela uloge menadžera korisniku
        // Ovde dodajte kod za dodelu uloge menadžera korisniku, koristeći Bouncer ili drugi alat za upravljanje ulogama
        Bouncer::assign('manager')->to($user);

        // Redirekcija nakon uspešnog dodavanja menadžera
        return redirect()->route('dashboard')->with('success', 'Manager created successfully');
    }

    public function seeUsers()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->get(['name', 'email', 'mobile_number']);

        // Iterirate kroz korisnike i postavite prazno polje ako je mobile_number null
        $users->transform(function ($user) {
            $user->mobile_number = $user->mobile_number ?: '';
            return $user;
        });

        return view('see-users', ['users' => $users]);
    }
}
