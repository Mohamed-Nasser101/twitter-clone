<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show(User $user){

        return view('profile.show',[
            'user' => $user
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
                Rule::unique('users')->ignore($user->username),'alpha_dash'],
            'name' => 'required|string|max:255',
            'email' => ['required','string','max:255',
                Rule::unique('users')->ignore($user->email),'email'],
            'password' => 'required|string|confirmed|min:8',
        ]);

        $validated['avatar'] = request('avatar')->store('avatars');

        $user->update($validated);

        return redirect()->route('profile',$user);
    }
}
