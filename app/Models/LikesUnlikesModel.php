<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikesUnlikesModel extends Model
{
    protected $fillable = ['name'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = auth()->id();
            // $model->family_id = null;
        });
    }
}
