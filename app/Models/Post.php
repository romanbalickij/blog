<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Carbon;

class Post extends Model
{
    use Sluggable;

    protected $fillable = ['title','content','date',];

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
    public function getImage() {
        if($this->image == null){
            return  '/uploads/no-image.png';
        }
            return  '/uploads/'.$this->image;
    }

    /**
     * @param $image
     */
    public function uploadImage($image) {
            if($image == null) { return; }
        if($this->image != null){
            Storage::delete('uploads/'.$this->image);
        }

        $filename = str_random(10).'.'.$image->extension();
        $image->storeAs('uploads',$filename);
        $this->image = $filename;
        $this->save();
    }

    public  static  function addPost($postAdd) {
        $post = new static;
        $post-> fill($postAdd);
        $post->user_id = 1;
        $post->save();
        return $post;
    }

    /**добавляем category_id*/
    public  function addCategoryId($id) {
        $this->category_id = $id;
        $this->save();
    }

    public function addTagsId($id) {
        $this->tags()->sync($id);
    }

    /**черновик*/
    public function status($value) {
        if($value == null){
            $this->status  = 0;
        }else
            $this->status = $value;
            $this->save();

    }

    /**рекомендувати*/
    public function toggleFeatured($value) {
        if($value == null){
            $this->is_featured  = 0;
        }else
            $this->is_featured = $value;
            $this->save();
    }

    public function getCategoryTitle() {
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

    public  function hasTag($tagId){
       $tags = $this->tags()->pluck('tags.id');
       return $tags->contains($tagId);
    }

    public function getDateAttribute($value)
    {
       $date =  Carbon::createFromFormat('Y-m-d',$value)->format('d/m/y');
       return $date;
    }

    public function edit($editPost) {
        $this->fill($editPost);
        $this->save();
    }

    public function remove(){
        $this->deleteImage();
        $this->delete();
    }

    public function deleteImage(){
        if($this->image != null){
            Storage::delete("uploads/".$this->image);
        }

    }


}
