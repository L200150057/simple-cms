<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyProfileController extends Controller
{
    public function index()
    {
        return view('my-profile.index');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'address' => 'required|string',
        ]);

        $image = $request->file('photo');

        if ($image) {
            $hashName = $image->hashName();
            $image->storeAs('public', $hashName);

            $validatedData = array_merge($validatedData, [
                'photo' => $hashName
            ]);
        }

        $user = auth()->user();
        $user->update($validatedData);

        return redirect()->route('my.profile.index')->with('success', 'User Update Successfully');
    }
}
