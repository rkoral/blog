<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Article extends Model
{
    public function getCategory(){
    	return $this->belongsTo(Category::class, 'category_id','id');

    }

}

