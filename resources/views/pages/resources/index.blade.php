<?php

use App\Models\Resource;
use Routes\Enums\ResourceRoutes;
use function Laravel\Folio\name;
use function Livewire\Volt\{with, state, usesPagination, mount, updating};

name(ResourceRoutes::INDEX->value);

usesPagination();

state([
    'headers' => [
        ['key' => 'name', 'label' => 'Name', 'sortable' => true],
        ['key' => 'type', 'label' => 'Type', 'sortable' => true],
        ['key' => 'url', 'label' => 'URL', 'sortable' => true],
        ['key' => 'author', 'label' => 'Author', 'sortable' => true],
        ['key' => 'domain', 'label' => 'Domain', 'sortable' => true],
    ]
]);

with(fn() => ['resources' => Resource::query()->own()->paginate(10)]);

?>

<x-layout>
    <div class="m-auto mb-4 bg-white p-4 rounded-lg shadow">
        @volt('resources.index')
        <div>
            <h1 class="text-3xl font-bold mb-4">{{ __('Resources') }}</h1>
            <div class="mb-4">
                <a href="{{ route(ResourceRoutes::CREATE) }}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Create Resource') }}
                </a>
            </div>
            <x-mary-table :headers="$headers" :rows="$resources" />
            {{ $resources->links() }}
        </div>
        @endvolt
    </div>
</x-layout>