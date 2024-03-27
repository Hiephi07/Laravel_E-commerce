<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory;
    use SoftDeletes;

    // protected $fillable = ['name', 'price', 'category_id', 'user_id', 'product_content', 'product_images', 'image_path'];
    protected $guarded = [] ;
    public function images(){
        // relationships 1-n: hasMany('class_name', 'foreign_key')
        return $this->hasMany(ProductImages::class, 'product_id');
    }

    public function tags(){
        // relationships n-n: 
        // belongsToMany('class_name', 'table_trung_gian', 'foreign_key_table_trung_gian', 'primary_key')

        return $this->belongsToMany(Tags::class, 'product_tags', 'product_id', 'tag_id')->withTimestamps();;
    }

    public function category(){
        return $this->belongsTo(Categories::class, 'category_id');
    }

}
