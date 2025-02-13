<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginComponent extends Component
{
    public $email;
    public $password;

    public function submit()
    {
        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials)) {
            // Authentication successful
            return redirect()->to('/dashboard');
        } else {
            // Authentication failed
            session()->flash('error', 'Invalid email or password.');
        }
    }

    public function render()
    {
        return view('livewire.pages.auth.login');
    }
}
