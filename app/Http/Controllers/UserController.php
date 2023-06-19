<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Unique;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
    
        $this->middleware('auth')->only('index');
        
    }
    public function index()
    {
        if (Auth::user()->user_roll != 1) {
            abort(403);
        }
        $user = User::all();
        return view('manageuseraccount', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('createaccount');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'yourname' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = new User();
        $user->your_name = $validated['yourname'];
        $user->name = $validated['username'];
        $user->email = $validated['email'];
        $user->password = $validated['password'];
        $user->user_roll = "2";

        $user->save();
        return redirect('/loginform');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
