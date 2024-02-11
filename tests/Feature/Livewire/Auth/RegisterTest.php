<?php

use App\Livewire\Auth\Register;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

it('renders successfully', function () {
    Livewire::test(Register::class)
        ->assertOk();
});

it('should be able to register a new user in the system', function() {
    Livewire::test(Register::class)
    ->set('name', 'Joe Doe')
    ->set('email', 'joedoe@gmail.com')
    ->set('email_confirmation', 'joedoe@gmail.com')
    ->set('password', 'password')
    ->call('submit')
    ->assertHasNoErrors();

    assertDatabaseHas('users', [
        'name' => 'Joe Doe',
        'email' => 'joedoe@gmail.com'
    ]);

    assertDatabaseCount('users', 1);
});
