<?php

namespace App\Services\Admin;

use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function getAll(array $dataSearch): LengthAwarePaginator
    {
        $query = User::orderBy('created_at', 'DESC');

        if (isset($dataSearch['name'])) {
            $query->where('name', 'like', '%' . $dataSearch['name'] . '%')
                ->orWhere('email', 'like', '%' . $dataSearch['name'] . '%');
        }

        if (isset($dataSearch['status']) && $dataSearch['status'] != "all") {
            $query->where('status', $dataSearch['status']);
        }

        if (isset($dataSearch['role']) && $dataSearch['role'] != "all") {
            $query->where('role', $dataSearch['role']);
        }

        $limitPage = isset($dataSearch['limit_page']) ? $dataSearch['limit_page'] : Post::HOME_LIMIT;

        return $query->paginate($limitPage);
    }

    public function updateStatus(object $user): bool
    {
        try {
            return $user->update([
                'status' => !$user->status
            ]);
        } catch (Exception $ex) {
            return false;
        }
    }

    public function updateStatusAll(): bool
    {
        try {
            return User::where('status', User::STATUS_INACTIVE)->update([
                'status' => User::STATUS_ACTIVE
            ]);
        } catch (Exception $ex) {
            return false;
        }
    }

    public function updateProfile(array $data, object $user): bool
    {
        try {
            $data['avatar'] = isset($data['avatar']) ? $this->getNameImage($data['avatar']) : $user->avatar;

            return $user->update($data);
        } catch (Exception $ex) {
            return false;
        }
    }

    public function delete(object $user): bool
    {
        try {
            DB::beginTransaction();
            $user->comments()->delete();
            $user->likes()->detach();
            $user->posts()->delete();
            $user->delete();
            DB::commit();

            return true;
        } catch (Exception $ex) {
            DB::rollBack();

            return false;
        }
    }

    protected function getNameImage(object $image): string
    {
        $fileName = Storage::disk('public')->put('avatar', $image);

        return $fileName;
    }
}
