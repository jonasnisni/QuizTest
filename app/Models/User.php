<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'password',
    ];

    /**
     * Relación uno a muchos: un usuario crea muchas preguntas
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Relación muchos a muchos: preguntas respondidas por el usuario
     * Campos extra: is_correct, answered_at
     */
    public function answeredQuestions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'answered_questions')
            ->withPivot(['is_correct', 'answered_at'])
            ->withTimestamps();
    }

    /**
     * Almacenamiento seguro de la contraseña
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}



