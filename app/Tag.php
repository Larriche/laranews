<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tags';

    public function news()
    {
        return $this->belongsToMany('App\News' , 'tags_to_posts' ,'tag_id','article_id' );
    }
}
