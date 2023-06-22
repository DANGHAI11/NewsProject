<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 1;

    const STATUS_INACTIVE = 1;

    const HOME_LIMIT = 9;

    const RELATED_LIMIT = 4;

    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'categiory_id',
        'title',
        'content',
        'image',
        'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
