<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Register extends Component
{
    #[Rule(['required', 'max:255'])]
    public ?string $name = null;

    #[Rule(['required', 'email', 'max:255', 'confirmed'])]
    public ?string $email = null;

    #[Rule(['required'])]
    public ?string $email_confirmation = null;

    #[Rule(['required'])]
    public ?string $password = null;

    public function render(): View
    {
        return view('livewire.auth.register');
    }

    public function submit(): void
    {
        $this->validate();

        /** @var User */
        $user = User::query()->create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ]);

        auth()->login($user);

        $this->redirect(RouteServiceProvider::HOME);
    }
}
