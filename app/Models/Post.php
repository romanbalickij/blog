<?php

namespace App\Models;

use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Carbon;
use phpDocumentor\Reflection\Types\Null_;

class Post extends Model
{
    use Sluggable;

    protected $fillable = ['title','content','date','description'];

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
    public function likes(){

        return $this->hasMany(Like::class);
    }


    public function comment(){
        return $this->hasMany(Comment::class);
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
        $post->user_id = Auth::user()->id;
        $post->save();
        return $post;
    }

    /**добавляем category_id*/
    public  function addCategoryId($id) {
        if($id == null) {return;}
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
        if(!$this->tags->isEmpty()) {
            return implode(',', $this->tags()->pluck('title')->all());
        }
            return 'Теги Вiдсутнi';
    }

    public  function hasTag($tagId){
        {
            $tags = $this->tags()->pluck('tags.id');
            return $tags->contains($tagId);
        }
    }

    public function getDateAttribute($value)
    {
       $date =  Carbon::createFromFormat('Y-m-d', $value)->format('d/m/y');
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

        if($this->image != null) {
            Storage::delete("uploads/".$this->image);
        }
    }

    public function getCategoryID(){
        return $this->category != null ? $this->category->id : null;
    }

    public function getDate(){
       return  Carbon::createFromFormat('d/m/y',$this->date)->format('F,d,Y');

    }

    /**получаэ вci пости крым теперiшнього*/
    public function related(){
      return  self::all()->except($this->id);
    }

    public function hasCategory(){

        return $this->category != null ? true : false;
    }

     public static function  getPopularPost(){

        return self::orderBy('views','desc')->take(3)->get();
     }

     public static function featuredPosts(){

        return self::where('is_featured',1)->take(3)->get();
     }

     public static  function recentPosts(){

        return self::orderBy('date','desc')->take(3)->get();
     }

     public static function PostsCount(){

        return self::where('status',0)->count();
     }

    public   function getComments(){

        return $this->comment()->where('status', 1)->get();
    }

    public function  increaseViews(){
        $this->views++ ;
        $this->save();
    }

    public function commentCount(){
      return  $this->comment()->count();
    }
/*
    public function likePost($postId){
        $user = new User();
        return $user->likes()->where('post_id',$postId)
            ->first() ? $user->likes()
            ->where('post_id',$postId)
           ->first()->like == 1 ? 'You like this post' : 'Like' : 'Like' ;
    }

    public function disLikePost($postId){
        $user = new User();
        return $user->likes()->where('post_id',$postId)
            ->first() ? $user->likes()
            ->where('post_id',$postId)
            ->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike' ;

    }

*/

    public function likesCount()
    {
        $like = Like::where('post_id', '=', $this->id)
            ->select('like')
            ->sum('like');
        return $like;
    }
}


