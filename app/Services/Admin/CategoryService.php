<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    public function getAllCategory(array $dataSearch, bool $getCategory = false): LengthAwarePaginator|Collection
    {
        $query = Category::orderBy('id', 'DESC');

        if (isset($dataSearch['name'])) {
            $query->where('name', 'like', '%' . $dataSearch['name'] . '%');
        }

        $limitPage = isset($dataSearch['limit_page']) ? $dataSearch['limit_page'] : Post::HOME_LIMIT;

        if ($getCategory) {
            return $query->get(['id', 'name']);
        }

        return $query->paginate($limitPage)->withQueryString($dataSearch);
    }

    public function store(array $data): bool
    {
        try {
            Category::create($data);

            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    public function update(array $data, object $category): bool
    {
        try {
            return $category->update($data);
        } catch (Exception $ex) {
            return false;
        }
    }

    public function delete(object $category): bool
    {
        $arrPostId = $category->posts()->select('id')->get()->pluck('id');
        try {
            DB::beginTransaction();
            Comment::whereIn('post_id', $arrPostId)->delete();
            Auth::user()->likes()->detach($arrPostId);
            $category->posts()->delete();
            $category->delete();
            DB::commit();
            return true;
        } catch (Exception $ex) {
            DB::rollBack();
            return false;
        }
    }
}
