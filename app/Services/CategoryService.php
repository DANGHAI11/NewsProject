<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    protected $categories;

    public function __construct(Category $categories)
    {
        $this->categories = $categories;
    }

    public function getAllCategories(): Collection
    {
        return $this->categories::where(['status' => $this->categories::STATUS_ACTIVE])->get();
    }
}
