<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loker extends Model
{
    use HasFactory;
    protected $table = 'lokers';
    protected $guarded = [];

    public function author()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
