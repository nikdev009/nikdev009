<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\category;
use App\Models\subcategory;

class product extends Model
{
    use HasFactory;

    protected $fillable = ['name','image','price','description','addtional_info','category_id','subcategory_id'];

    public function category(){
        return $this->hasOne(category::class,'id','category_id');
    }

}
