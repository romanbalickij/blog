<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;

    protected $fillable = ['title','content'];

    public function category(){
      return  $this->hasOne(Category::class);
    }

    public function author(){
      return $this->hasOne(User::class);
    }

    public function tags(){
      return $this->belongsToMany(
          Tag::class,
          'post_tags',
          'post_id',
          'tag_id'
      );
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

}
