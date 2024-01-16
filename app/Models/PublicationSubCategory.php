<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationSubCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function publication_category(){
        return $this->belongsTo(PublicationCategory::class,'publication_category_id','id');
    }
    public function lecturer_publications(){
        return $this->hasMany(LecturerPublication::class);
    }
}
