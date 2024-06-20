<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'country';

    // khai bao cac cot nao can insert hoac update vao 
    protected $fillable = ['title'];
}
