<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Domain extends Model
{
//    use SoftDeletes;
    
    public $timestamps = false;
    protected $table = 'domains';
    protected $guarded = array('id', 'created_at', 'updated_at');
//    protected $fillable = ['slug', 'title', 'body', 'user_id', 'category_id',  'pagination', 'type','ordertype', 'thumb', 'approve', 'show_in_homepage',  'show_in_homepage', 'featured_at', 'published_at', 'deleted_at'];

//    protected $dates = ['featured_at', 'published_at','deleted_at'];

//    protected $softDelete = true;
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('App\Posts', 'domain_id');
    }
    
}
