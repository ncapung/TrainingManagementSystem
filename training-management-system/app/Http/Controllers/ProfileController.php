<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($user->profile_picture) {
            Storage::delete('public/profile_pictures/' . $user->profile_picture);
        }

        $fileName = time() . '.' . $request->profile_picture->extension();
        $request->profile_picture->storeAs('public/profile_pictures', $fileName);

        $user->profile_picture = $fileName;
        $user->save();

        return response()->json(['success' => true, 'profile_picture' => $fileName]);
    }
}
