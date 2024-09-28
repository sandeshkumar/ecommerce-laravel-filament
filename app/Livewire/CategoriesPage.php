<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Category;

#[Title('Categories - Sandia')]
class CategoriesPage extends Component
{
    public function render()
    {
        $categories = Category::where('is_active', 1)->get();
        return view('livewire.categories-page', compact('categories'));
    }
}
