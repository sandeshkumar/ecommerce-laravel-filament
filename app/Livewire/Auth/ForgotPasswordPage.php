<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Password;

#[Title('Forgot Password')]
class ForgotPasswordPage extends Component
{
    public $email;

    public function save()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $status = Password::sendResetLink($this->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('success', 'Reset link sent to your email');
            $this->email = '';
        } else {
            session()->flash('error', 'Failed to send reset link');
        }
    }


    public function render()
    {
        return view('livewire.auth.forgot-password-page');
    }
}
