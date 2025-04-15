<?php

use App\Livewire\Forms\IdeaForm;
use Routes\Enums\IdeaRoutes;
use App\Enums\ResourceType;
use App\Models\Resource;
use function Laravel\Folio\name;
use function Livewire\Volt\{state, with, form, mount};

name(IdeaRoutes::CREATE->value);

form(IdeaForm::class);

state([
    'resourceTypes' => ResourceType::cases(),
    'searchableResources' => []
]);

mount(fn() => [

]);

$save = function () {

    $this->form->store();

    session()->flash('status', 'Idea successfully created.');
    $this->redirectRoute(IdeaRoutes::INDEX);
};

$searchResources = function (string $value = '') {
    $this->searchableResources = Resource::where('name', 'like', "%$value%")
        ->take(10)
        ->orderByDesc('created_at')
        ->get();
};

?>

<x-layout>
    <div class="m-auto mb-4 bg-white p-4 rounded-lg shadow">
        @volt('ideas.create')
        <div>
            <h1 class="mb-4">Create Idea</h1>
            <form wire:submit="save">
                <x-mary-choices wire:model.live="form.resource_id" :options="$searchableResources" label="Resource"
                    placeholder="Search a resource" search-function="searchResources" single searchable>
                    @scope('item', $resource)
                    <x-mary-list-item :item="$resource" sub-value="author">
                        <x-slot:actions>
                            <x-mary-badge :value="$resource->type->value" class="badge-soft badge-primary badge-sm" />
                        </x-slot:actions>
                    </x-mary-list-item>
                    @endscope
                </x-mary-choices>

                @if ($form->resource_id)
                                @php
    $selectedResource = Resource::find($form->resource_id);
                                @endphp
                                @if ($selectedResource->type == ResourceType::Audio || $selectedResource->type == ResourceType::Video)
                                    <x-mary-input wire:model="form.time" type="time" label="Time" placeholder="e.g., 00:00" />
                                @elseif ($selectedResource->type === ResourceType::Book)
                                    <x-mary-input wire:model="form.page" type="number" label="Page" />
                                @endif
                @endif

                <x-mary-input wire:model="form.title" label="Title" />

                <x-mary-markdown wire:model="form.content" label="Content" :folder="'resources/' . $form->resource_id" />

                <x-mary-button type="submit" class="btn-primary mt-4" label="Create" />
            </form>
        </div>
        @endvolt
    </div>

    <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
    <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
</x-layout>
