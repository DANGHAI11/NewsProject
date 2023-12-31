<?php

namespace App\Services\User;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    public function getAllCategories(): Collection
    {
        return Category::where(['status' => Category::STATUS_ACTIVE])->get();
    }
}
