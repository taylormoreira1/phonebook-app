<?php

namespace App\Models;

use App\Models\Phone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'birth',
        'cpf',
    ];

    protected $dates = [
        'birth',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }
}
