<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Silber\Bouncer\BouncerFacade as Bouncer;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class UserController extends Controller
{

    // Metod za kreiranje novog admina
    public function createAdmin(Request $request)
    {
        // Provera da li već postoji admin u bazi
        if (User::where('admin', true)->exists()) {
            // Već postoji admin, ne dozvoli kreiranje novog admina
            return redirect()->back()->with('error', 'Admin already exists');
        }

        // Ako ne postoji admin, kreiraj novog
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->admin = true;
        $user->save();

        return redirect()->back()->with('success', 'Admin created successfully.');
    }

    public function createManagerForm()
    {
        if (Bouncer::can('create-managers'))
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
        })->get(['id','name', 'email', 'mobile_number']);

        // Iterirate kroz korisnike i postavite prazno polje ako je mobile_number null
        $users->transform(function ($user) {
            $user->mobile_number = $user->mobile_number ?: '';
            return $user;
        });

        return view('see-users', ['users' => $users]);
    }

    public function editUser($id)
    {
        if (!Bouncer::can('update-users')) {
            abort(403, 'Unauthorized action.');
        }

        // Pronalazimo korisnika po id-u
        $user = User::findOrFail($id);

        // Vraćamo view sa podacima korisnika
        return view('users.edit', compact('user'));
    }

//    public function userUpdate(Request $request, $id)
//    {
//        $validatedData = $request->validate([
//            'name' => 'required|string|max:255',
//            'mobile' => 'required|string|max:15',
//            'role' => 'required|in:headmaster,professor,student',
//        ]);
//
//        $user = User::findOrFail($id);
//        $user->name = $validatedData['name'];
//        $user->mobile = $validatedData['mobile'];
//        $user->role = $validatedData['role'];
//        $user->save();
//
//        return redirect()->route('dashboard')->with('success', 'User updated successfully.');
//    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'sometimes|string|in:admin,manager,user', // Adjust roles as needed
            'mobile_number' => 'nullable|string|max:15|regex:/^[0-9]*$/' // Validation rule for mobile number
        ]);

        // Prevent updating email or username
        $data = $request->except(['email', 'username']);

        // Prevent changing role to highest role
        if (!Bouncer::is($user)->an('Admin') && $request->role === 'admin') {
            return redirect()->back()->withErrors(['role' => 'You cannot change the role to admin.']);
        }

        // Update user data
        $user->update($data);

        // Update user role if necessary
        if ($request->has('role')) {
            Bouncer::sync($user)->roles([$request->role]);
        }

        return redirect()->route('users.edit', $user)->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        // Provera ovlašćenja: Samo admin može da obriše naloge, ali ne i svoj nalog
        if ($user->id === auth()->id() && $user->isAdmin()) {
            return redirect()->back()->withErrors(['message' => 'You cannot delete your own account.']);
        }

        // Brisanje naloga
        $user->delete();

        return redirect()->route('dashboard')->with('success', 'User deleted successfully.');
    }

}
