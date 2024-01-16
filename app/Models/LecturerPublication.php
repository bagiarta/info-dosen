<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LecturerPublication extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function publication_category(){
        return $this->belongsTo(PublicationCategory::class);
    }
    public function publication_sub_category(){
        return $this->belongsTo(PublicationSubCategory::class);
    }
}
