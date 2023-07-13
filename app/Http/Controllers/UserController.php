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
    public function index()
    {
        if (Auth::user()->user_roll != 1) {
            abort(403);
        }else{
            $user = User::all();
            return view('manageuseraccount', compact('user'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->user_roll != 1) {
            abort(403);
        }else{
            return view('createaccount');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|max:255',
            'email' => 'required',
            'password' => 'required',
            'user_roll' => 'required'
        ]);

        $user = new User();
        $user->name = $validated['username'];
        $user->email = $validated['email'];
        $user->password = $validated['password'];
        $user->user_roll = $validated['user_roll'];

        $user->save();
        return redirect('/user');
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
        User::destroy($id);
        session()->flash('deleteduser', 'Deleted successfully.');
        return redirect('/user');
    }
}
