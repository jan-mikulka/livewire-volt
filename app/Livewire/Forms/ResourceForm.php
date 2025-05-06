<?php

namespace App\Livewire\Forms;

use App\Enums\ResourceType;
use App\Models\Resource;
use Auth;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ResourceForm extends Form
{
    public ?Resource $resource;

    #[Locked]
    public int $id;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('nullable|string|url|max:255')]
    public ?string $url = null;

    #[Validate('nullable|string|max:255')]
    public ?string $author = null;

    #[Validate('nullable|string|max:255')]
    public ?string $domain = null;

    #[Validate('required')]
    public string $type = ResourceType::Idea->value;


    public function setResource(Resource $resource)
    {
        $this->id = $resource->id;
        $this->name = $resource->name;
        $this->url = $resource->url;
        $this->author = $resource->author;
        $this->domain = $resource->domain;
        $this->type = $resource->type;
        $this->user_id = $resource->user_id;

        $this->resource = $resource;
    }

    public function store()
    {
        $this->validate();

        return Resource::create(array_merge(
            $this->only([
                'name',
                'url',
                'author',
                'domain',
                'type',
            ]),
            ['user_id' => Auth::id()]
        ));
    }

    public function update()
    {
        $this->validate();

        $this->resource->update($this->only([
            'name',
            'url',
            'author',
            'domain',
            'type',
        ]));
    }
}
