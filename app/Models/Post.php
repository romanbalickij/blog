<?php

namespace App\Models;

use Aws\S3\Enum\Storage;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;

    protected $fillable = ['title','content','date','category_id'];

    public function category(){
      return  $this->belongsTo(Category::class);
    }

    public function author(){
      return $this->belongsTo(User::class,'user_id');
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
    /**вивiд зображення */
    public function getImage(){
        if($this->image == null){
            return  '/uploads/no-image.png';
        }
            return  '/uploads/'.$this->image;
    }

    public function uploadImage($image){
            if($image == null) { return; }
        if($this->image != null){
            Storage::delete('uploads/'.$this->image);
        }

        $filename = str_random(10).'.'.$image->extension();
        $image->storeAs('uploads',$filename);
        $this->image = $filename;
        $this->save();
    }

    public  static  function addPost($postCreate){

        $post = new static;
        $post-> fill($postCreate);
        $post->user_id = 1;
        $post->save();
        return $post;
    }

    /**добавляем category_id*/
    public  function addCategoryId($id){
        $this->category_id = $id;
        $this->save();
    }

    public function addTagsId($id){
        $this->tags()->sync($id);
    }

    /**черновик*/
    public function status($value){
        if($value == null){
            $this->status  = 0;
        }else
            $this->status = $value;
            $this->save();

    }

    /**рекомендувати*/
    public function toggleFeatured($value){
        if($value == null){
            $this->is_featured  = 0;
        }else
            $this->is_featured = $value;
            $this->save();
    }

    public function getCategoryTitle(){
        if($this->category != null){
            return $this->category->title;
        }else
            return 'Категорiя Вiдсутня';
    }

    /**розвиваем масив в строку */
    public function tagsTitle()
    {
         return implode(',',$this->tags()->pluck('title')->all());

    }

}
