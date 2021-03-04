<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show(User $user){
       // dd($user->tweets);
        return view('profile.show',[
            'user' => $user//->with('tweets')
        ]);
    }

    public function edit(User $user){

        return view('profile.edit',[
            'user' => $user
        ]);
    }

    public function update(User $user){

        $validated = request()->validate([
            'username' => ['required','string','max:255',
                Rule::unique('users')->ignore($user),'alpha_dash'],
            'name' => 'required|string|max:255',
            'email' => ['required','string','max:255',
                Rule::unique('users')->ignore($user),'email'],
            'password' => 'required|string|confirmed|min:8',
        ]);

        if(request('avatar')){
            $validated['avatar'] = request('avatar')->store('avatars');
        }

        $validated['password'] = Hash::make(request('password'));

        $user->update($validated);

        return redirect()->route('profile',$user);
    }
}
