<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function publication_sub_categories(){
        return $this->hasMany(PublicationSubCategory::class,'publication_category_id','id');
    }
    public function lecturer_publications(){
        return $this->hasMany(LecturerPublication::class);
    }
}
