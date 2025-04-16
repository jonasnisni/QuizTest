<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'user_id',
        'question',
        'answer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
