<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class St_Link extends Model
{
    use HasFactory;

    protected $table = 'st_link';
    protected $primaryKey = 'id';
    protected $fillable = [
        'link_btn_login', 'link_btn_register', 'link_created', 'link_updated'
    ];
    
    public $timestamps = false;
}
