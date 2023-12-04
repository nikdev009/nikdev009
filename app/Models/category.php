<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use App\Models\subcategory;


class category extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug','description','image'];

    public function subcategory(){
        return $this->hasmany(subcategory::class);
    }
}
