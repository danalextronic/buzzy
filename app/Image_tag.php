<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image_tag extends Model
{
    use SoftDeletes;
    
    public $timestamps = false;
    protected $table = 'image_tags';
    protected $guarded = array('id', 'created_at', 'updated_at');
//    protected $fillable = ['slug', 'title', 'body', 'user_id', 'category_id',  'pagination', 'type','ordertype', 'thumb', 'approve', 'show_in_homepage',  'show_in_homepage', 'featured_at', 'published_at', 'deleted_at'];
//
//    protected $dates = ['featured_at', 'published_at','deleted_at'];

    protected $softDelete = true;

    public function image()
    {
        return $this->belongsTo('App\Images', 'image_id');
    }
}
