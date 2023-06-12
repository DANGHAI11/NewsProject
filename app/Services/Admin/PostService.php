<?php

namespace App\Services\Admin;

use App\Models\Post;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class PostService
{
    public function getAll(array $dataSearch): LengthAwarePaginator
    {
        $query = Post::with(['user','categories']);

        if (isset($dataSearch['title'])) {
            $query->where('title', 'like', '%' . $dataSearch['title'] . '%');
        }

        if (isset($dataSearch['status']) && $dataSearch['status'] != "all") {
            $query->where('status', $dataSearch['status']);
        }

        if (isset($dataSearch['category']) && $dataSearch['category'] != "all") {
            $query->where('category_id', $dataSearch['category']);
        }

        if (isset($dataSearch['id'])) {
            $query->where('id', $dataSearch['id']);
        }

        $limitPage = isset($dataSearch['limit_page']) ? $dataSearch['limit_page'] : Post::HOME_LIMIT;

        return $query->orderBy('created_at', 'desc')->paginate($limitPage)->withQueryString($dataSearch);
    }

    public function approved(object $post): bool
    {
        try {
            if ($post->status == Post::STATUS_ACTIVE) {
                return $post->update([
                    'status' => Post::STATUS_INACTIVE,
                ]);
            }
            return $post->update([
                'status' => Post::STATUS_ACTIVE
            ]);
        } catch (Exception $ex) {
            return false;
        }
    }

    public function approvedAll(): bool
    {
        try {
            return Post::where('status', Post::STATUS_INACTIVE)->update([
                'status' => Post::STATUS_ACTIVE,
            ]);
        } catch (Exception $ex) {
            return false;
        }
    }

    public function deletePost(object $postDelete): bool
    {
        try {
            DB::beginTransaction();
            $postDelete->comments()->delete();
            $postDelete->likes()->detach();
            $postDelete->delete();
            DB::commit();

            return true;
        } catch (Exception $ex) {
            DB::rollBack();

            return false;
        }
    }

    public static function getPageLimit(): array
    {
        return [
            Post::HOME_LIMIT,
            Post::PAGE_LIMIT_1,
            Post::PAGE_LIMIT_2,
            Post::PAGE_LIMIT_3,
            Post::PAGE_LIMIT_4,
        ];
    }
}
