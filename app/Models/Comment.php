<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'comment';

    // khai bao cac cot nao can insert hoac update vao 
    protected $fillable = ['comment', 'id_blog', 'id_user', 'avatar_user','name_user','level','time'];
}
