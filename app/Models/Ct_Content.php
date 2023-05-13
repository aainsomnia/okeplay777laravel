<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Ct_Category;

class Ct_Content extends Model
{
    use HasFactory;

    protected $table = 'ct_content';
    protected $primaryKey = 'content_id';
    protected $fillable = [
        'category_id', 'content_index', 'content_name', 'content_img', 'content_persen', 'content_created', 'content_updated'
    ];
    
    public $timestamps = false;

    public function category(){
        return $this->hasOne(Ct_Category::class, 'category_id', 'category_id');
    }
}
