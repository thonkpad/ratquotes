<?php

namespace App\Livewire;

use Livewire\Component;

class Login extends Component
{
    public function discordRedirect()
    {
        return redirect()->to('/login/discord');
    }
    public function render()
    {
        return view('livewire.login');
    }
}
