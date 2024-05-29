<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_cat',
        'creation_date'
    ];

    public $timestamps = false;

//    public function subcategories() {
//        return $this->hasMany(Subcategory::class);
//    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
