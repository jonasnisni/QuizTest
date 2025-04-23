<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'user_id',
        'question',
        'answer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function respondents(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'answered_questions')
            ->withPivot(['is_correct', 'answered_at'])
            ->withTimestamps();
    }
}
