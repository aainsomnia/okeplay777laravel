<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bn_Banner extends Model
{
    use HasFactory;

    protected $table = 'bn_banner';
    protected $primaryKey = 'banner_id';
    protected $fillable = [
        'banner_img', 'banner_created', 'banner_updated'
    ];
    
    public $timestamps = false;
}
