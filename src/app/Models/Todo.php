<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category; #なくても動く

class Todo extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'content',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class); //紐づいてるよ（リレーション）
    }

    public function scopeCategorySearch($query, $category_id) //category_idカラムで検索を行う
    {
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
    }
    public function scopeKeywordSearch($query, $keyword) //contentで検索
    {
        if (!empty($keyword)) {
            $query->where('content', 'like', '%' . $keyword . '%');
        }
        return $query;
    }
}
