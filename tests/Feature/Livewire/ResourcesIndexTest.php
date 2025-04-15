<?php

use Livewire\Volt\Volt;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;
use Routes\Enums\ResourceRoutes;
use \App\Models\Resource;

uses(RefreshDatabase::class);

it('renders_successfully', function () {
    get(route(ResourceRoutes::INDEX))
        ->assertOk()
        ->assertSeeText([
            __('Resources'),
            __('Create Resource')
        ]);
});

it('displays only own resources', function () {
    // SETUP
    $this->user = \App\Models\User::factory()->create();
    $this->actingAs($this->user);
    Resource::factory(5)->create(['user_id' => $this->user->id]);
    Resource::factory(5)->create(['user_id' => \App\Models\User::factory()->create()->id]);

    // TEST
    Volt::test('resources.index')
        ->assertSee(Resource::where('user_id', $this->user->id)->first()->name)
        ->assertDontSee(Resource::where('user_id', '!=', $this->user->id)->first()->name);
});


