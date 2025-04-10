<?php

use Livewire\Volt\Volt;
use Routes\Enums\AuthRoutes;

Volt::route('/', 'home')->name(AuthRoutes::HOME);

require __DIR__.'/auth.php';
