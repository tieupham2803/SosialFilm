<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileFormRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

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
        $slug = uniqid();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $slug . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/images/profiles/', $name);
            $data['avatar'] = '/images/profiles/' . $name;
            $imagePath = public_path() . '/images/profiles/' . $name;
            Image::make($imagePath)->resize(250, 250)->save();
        } else {
            $data['avatar'] = '/images/profiles/default-avatar.png';
            $imagePath = public_path() . '/images/profiles/default-avatar.png';
            Image::make($imagePath)->resize(250, 250)->save();
        }
        $updateData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'avatar' => $data['avatar'],
        ];
        if (Hash::check($data['password'], $user->password)) {
            $user->update($updateData);

            return redirect()->route('profile.edit', $id)->with('status', __('Your profile has been updated'));
        }

        return redirect()->route('profile.edit', $id)->with('error', __('Password is invalid!'));
    }
}
