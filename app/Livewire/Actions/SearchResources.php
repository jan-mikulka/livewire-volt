<?php

namespace App\Livewire\Actions;

use App\Models\Resource;

trait SearchResources
{
    public function searchResources(string $value = '')
    {
        return Resource::where('name', 'like', "%$value%")
            ->take(10)
            ->orderByDesc('created_at')
            ->get();
    }
}
