<?php

namespace App\Livewire\Forms;

use App\Models\Idea;
use App\Models\Resource;
use Auth;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Log;

class IdeaForm extends Form
{
    public ?Idea $idea;

    #[Locked]
    public int $id;

    #[Validate('nullable', 'exists:resources,id')]
    public ?int $resource_id = null;

    #[Validate('required', 'string', 'max:255')]
    public string $content = '';

    #[Validate('nullable', 'string')]
    public ?string $page = null;

    //Removed validate for time as it is handled by setter now
    public ?string $time = null;

    public function setResource($resource_id)
    {

        $this->resource_id = $resource_id;
        Log::info($this->resource_id);

    }

    public function setIdea(Idea $idea)
    {
        $this->id = $idea->id;
        $this->resource_id = $idea->resource_id;
        $this->user_id = $idea->user_id;
        $this->page = $idea->page;
        $this->time = $idea->time;
        $this->content = $idea->content;

        $this->idea = $idea;
    }

    public function store(): Idea
    {
        $this->validate();

        //When storing time will be handled by setter
        return Idea::create(array_merge($this->only([
            'title',
            'content',
            'page',
            'time',
            'resource_id',
        ]),
        ['user_id' => Auth::id()]
    ));
    }

    public function update(): Idea
    {
        $this->validate();

        //When updating time will be handled by setter
        $this->idea->update($this->only([
            'title',
            'content',
            'page',
            'time',
            'resource_id',
        ]));

        return $this->idea;
    }
}
