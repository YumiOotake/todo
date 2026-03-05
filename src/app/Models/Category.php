<?php

namespace App\Models;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    // public function todos()
    // {
    //     return $this->hasMany(Todo::class);
    // }
    // public function getName()
    // {
    //     return $this->name;
    // }
}
