<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Furniture extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = [
        'deleted_at'
    ];

    protected $fillable = [
        'id', 'name', 'price', 'typeId', 'colorId', 'image'
    ];

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function color(){
        return $this->belongsTo(Color::class);
    }
}
