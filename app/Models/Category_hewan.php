<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_hewan extends Model
{
    use HasFactory;
    protected $table = "category_hewans";
    protected $fillable = [
        'title'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function post(){
        return $this-> hasMany(Postingan::class);
    }
}
