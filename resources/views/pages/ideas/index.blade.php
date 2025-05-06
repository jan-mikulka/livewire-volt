<?php

use App\Models\Idea;
use Routes\Enums\IdeaRoutes;
use function Laravel\Folio\name;
use function Livewire\Volt\{with, state, usesPagination, mount, updating};

name(IdeaRoutes::INDEX->value);

usesPagination();

state([
    'headers' => [
        ['key' => 'title', 'label' => 'Title', 'sortable' => true],
    ]
]);

with(fn() => ['ideas' => Idea::query()->own()->paginate(10)]);

?>

<x-layout>
    <div class="m-auto mb-4 bg-white p-4 rounded-lg shadow">
        @volt('ideas.index')
        <div>
            <h1 class="text-3xl font-bold mb-4">{{ __('Ideas') }}</h1>
            <div class="mb-4">
                <a href="{{ route(IdeaRoutes::CREATE) }}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Create Idea') }}
                </a>
            </div>
            <x-mary-table :headers="$headers" :rows="$ideas" link="/ideas/{id}" />
            {{ $ideas->links() }}
        </div>
        @endvolt
    </div>
</x-layout>