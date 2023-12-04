<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\category;

class subcategory extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','name'];

    public function category(){
        return $this->belongsTo(category::class);
    }
}
