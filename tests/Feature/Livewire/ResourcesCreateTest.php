<?php

use Livewire\Volt\Volt;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;
use Routes\Enums\ResourceRoutes;
use App\Models\Resource;

uses(RefreshDatabase::class);

it('renders_successfully', function () {
    $this->user = \App\Models\User::factory()->create();
    $this->actingAs($this->user);
    get(route(ResourceRoutes::CREATE))
        ->assertOk();
});

it('fills the form and submits successfully', function () {
    // SETUP
    $this->user = \App\Models\User::factory()->create();
    $this->actingAs($this->user);
    $resourceData = Resource::factory()->make()->toArray();

    // TEST
    Volt::test('resources.create')
        ->set('form.name', $resourceData['name'])
        ->set('form.url', $resourceData['url'])
        ->set('form.author', $resourceData['author'])
        ->set('form.type', $resourceData['type'])
        ->call('save')
        ->assertRedirect(route(ResourceRoutes::INDEX));

    $this->assertDatabaseHas('resources', [
        'name' => $resourceData['name'],
        'url' => $resourceData['url'],
        'author' => $resourceData['author'],
        'type' => $resourceData['type'],
    ]);
});
