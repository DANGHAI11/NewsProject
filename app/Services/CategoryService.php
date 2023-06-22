<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{

    protected $categories;

    public function __construct(Category $categories)
    {
        $this->categories = $categories;
    }

    public function getAllCategories(): object
    {
        $categories = $this->categories::where(['status' => $this->categories::STATUS_ACTIVE])->get();
        return $categories;
    }

    public function createCategory(array $data): object
    {
        $result = $this->categories::create($data);
        return $result;
    }
}
