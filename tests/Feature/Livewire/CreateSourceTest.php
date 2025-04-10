<?php

namespace Tests\Feature\Livewire;

use App\Livewire\CreateSource;
use Livewire\Livewire;
use Tests\TestCase;

class CreateSourceTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(CreateSource::class)
            ->assertStatus(200);
    }

    /** @test */
    public function component_exists_on_the_page()
    {
        $this->get(route('sources.create'))
            ->assertSeeLivewire(CreateSource::class);
    }
}