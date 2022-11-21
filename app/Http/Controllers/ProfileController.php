<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function view(Request $request)
    {   

        $users = $request->user(); 
        $articles = $request->user()->articles()->orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.profile.profile', compact('articles'))->with('users', $users);

    }



    public function updateUsername(User $user, Request $request) {
        $user->name = $request->name;
        
        $user->save();        

        return redirect()->route('admin.profile.index')->with('NameUpdate', __('Je gebruikersnaam is aangepast!'));

    }

    public function updateEmail(User $user, Request $request) {
        $user->email = $request->email;
        
        $user->save();        

        return redirect()->route('admin.profile.index')->with('EmailUpdate', __('Je E-mail adres is aangepast!'));

    }
    public function updatePassword(User $user, Request $request) {
        
        $user->password = $request->password;
        
    
        $user->password = Hash::make($request->password);

        $user->save();
        
        return redirect()->route('admin.profile.index')->with('PasswordUpdate', __('Je wachtwoord is aangepast!'));

    }
}