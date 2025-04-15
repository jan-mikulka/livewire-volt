<?php

use App\Livewire\Forms\ResourceForm;
use Routes\Enums\ResourceRoutes;
use App\Enums\ResourceType;
use function Laravel\Folio\name;
use function Livewire\Volt\{state, form};

name(ResourceRoutes::CREATE->value);

form(ResourceForm::class);

state([
    'resourceTypes' => ResourceType::cases()
]);

$save = function () {

    $this->form->store();

    session()->flash('status', 'Resource successfully created.');
    $this->redirectRoute(ResourceRoutes::INDEX);
}
?>
<x-layout>
    <div class="m-auto w-1/2 mb-4 bg-white p-4 rounded-lg shadow">
        @volt('resources.create')
        <div>
            <h3 class="text-lg text-gray-800 mb-3">Create Resource</h3>

            <x-mary-form wire:submit="save">
                <div class="mb-3">
                    <x-mary-input type="text" wire:model="form.name" label="Name" />
                </div>

                <div class="mb-3">
                    <x-mary-input type="text" wire:model="form.url" label="URL" />
                </div>

                <div class="mb-3">
                    <x-mary-input type="text" wire:model="form.author" label="Author" />
                </div>

                <div class="mb-3">
                    <x-mary-select wire:model="type" :options="$resourceTypes" label="Type" placeholder="Select type" />
                </div>

                <div class="mb-3">
                    <x-mary-button type="submit" class="btn-outline btn-primary">Save</x-mary-button>
                </div>
            </x-mary-form>
        </div>
        @endvolt
    </div>
</x-layout>