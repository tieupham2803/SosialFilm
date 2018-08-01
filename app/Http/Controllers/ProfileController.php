<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileFormRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.profile.edit', compact('user', 'id'));
    }

    public function update(ProfileFormRequest $request, $id)
    {
        $data = $request->all();
        $user = User::findOrFail($id);
        $updateData = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];
        if (Hash::check($data['password'], $user->password)) {
            $user->update($updateData);

            return redirect()->route('profile.edit', $id)->with('status', __('Your profile has been updated'));
        }

        return redirect()->route('profile.edit', $id)->with('error', __('Password is invalid!'));
    }
}
