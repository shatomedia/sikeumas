<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->user()->id);
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $requestData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'telp' => 'nullable|numeric|digits_between:10,15',
            'alamat' => 'nullable',
            'password' => 'nullable|min:8',
        ]);

        if ($request->password != '') {
            $requestData['password'] = bcrypt($request->password);
        } else {
            unset($requestData['password']);
        }

        $user = User::find(auth()->user()->id);
        $user->fill($requestData);
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diupdate');
    }
}
