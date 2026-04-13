<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = [
        'name',
        'kana',
        'tel',
        'email',
        'body',
        'created_at',
        'updated_at',
    ];
    public $timestamps = false;
}