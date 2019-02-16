<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected  $fillable = ['text','user_id','post_id'];

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function status(){
        if($this->status  == 0){
             $this->status = 1;
             $this->save();
        }else
            $this->status = 0;
            $this->save();
    }

    public function remove(){
        $this->delete();
    }



}
