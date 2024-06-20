<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'rate';

    // khai bao cac cot nao can insert hoac update vao 
    protected $fillable = ['rate', 'id_blog', 'id_user', 'time'];
}
