<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ct_Category extends Model
{
    use HasFactory;

    protected $table = 'ct_category';
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'category_name', 'category_img', 'game_url', 'category_created', 'category_updated'
    ];
    
    public $timestamps = false;
}
