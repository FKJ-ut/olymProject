<?php

// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;

use App\Models\Delegation;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function delegationIndex()
    {
        $delegations = Delegation::all();
        return view('delegations.index', compact('delegations'));
    }

    public function createabc()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'team' => 'required|string|max:255', // Add validation for team
            'role_id' => 'required|string|in:2,3,4', // Add validation for role
        ]);

        // Convert the team value to uppercase
        $team = strtoupper($validatedData['team']);

        // Create the user with the validated data and uppercase team value
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'team' => $team, // Use the uppercase team value
            'role_id' => $validatedData['role_id'],
        ]);

        // Redirect or return response
        return redirect()->route('users.create')->with('success', 'User (' . $validatedData['name'] . ') created successfully!');
    }

    public function destroy(User $user)
    {
        // Delete the user
        $user->delete();

        // Redirect with success message
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }

    public function createDelegation()
    {
        return view('delegations.create');
    }

    public function storeDelegation(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'tag' => 'required|string|max:3',
        ]);

        // Create the user with the validated data and uppercase team value
        Delegation::create([
            'name' => $validatedData['name'],
            'tag' => $validatedData['tag'],
        ]);

        // Redirect or return response
        return redirect()->route('delegations.create')->with('success', 'Delegation (' . $validatedData['name'] . ') created successfully!');
    }

    public function destroyDelegation(Delegation $delegation)
    {
        // Delete the user
        $delegation->delete();

        // Redirect with success message
        return redirect()->route('delegations.index')->with('success', 'User deleted successfully!');
    }

}
