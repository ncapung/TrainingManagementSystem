<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;

class RoleController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->get();
        $guests = User::where('role', 'guest')->get();

        return view('roles.index', compact('admins', 'guests'));
    }
}