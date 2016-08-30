<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class News extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'news';

    protected $fillable = ['title','body','intro','published_at','user_id','image_url'];


    public function scopePublished($query)
    {
    	$query->where('status','=','PUBLISHED');

    }

    public function scopeUnpublished($query)
    {
    	$query->where('status','=','UNPUBLISHED');
    }

    public function writer()
    {
    	return $this->belongsTo('App\User' , 'author_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag' , 'tags_to_posts' , 'article_id' , 'tag_id');
    }
}
