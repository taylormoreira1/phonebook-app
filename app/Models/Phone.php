<?php

namespace App\Models;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Phone extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'phonebook_id',
        'ddd',
        'phone',
        'type',
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
