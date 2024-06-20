<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'product';

    // khai bao cac cot nao can insert hoac update vao 
    protected $fillable = [ 'id_user','name', 'price','id_category','id_brand','status','sale','company','avatar','detail'];
}
