<?php

namespace App\Services\User;

use App\Models\Comment;
use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function update(array $data, object $user): bool
    {
        try {
            if (isset($data['avatar'])) {
                $data['avatar'] = $this->getNameImage($data['avatar']);
            } else {
                $data['avatar'] = $user->avatar;
            }

            return $user->update([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'avatar' => $data['avatar'],
            ]);
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

    public function updatePassword(array $data, object $user): array
    {
        try {
            if (Hash::check($data['old_password'], $user->password)) {
                if ($data['old_password'] != $data['password']) {
                    $user->update([
                        'password' => $data['password'],
                    ]);

                    return $this->resultArr('success', __('profile.update_password_success'));
                }
                return $this->resultArr('error', __('profile.password_same'));
            }

            return $this->resultArr('error', __('profile.password_incorrect'));
        } catch (Exception $ex) {
            return $this->resultArr('error', __('profile.error_exception'));
        }
    }

    public function resultArr($status, $message)
    {
        return [
            'status' => $status,
            'message' => $message
        ];
    }

    protected function getNameImage(object $image): string
    {
        $fileName = Storage::disk('public')->put('avatar', $image);

        return $fileName;
    }
}
