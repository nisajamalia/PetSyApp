<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_info extends Model
{
    use HasFactory;
    protected $table = "category_infos";
    protected $fillable = [
        'name',
        'desc',
        'image'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
