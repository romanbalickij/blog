<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    /**загрузка зображення */
    public function uploadAvatar($avatar){

        if($avatar == null) {return;}
        if($this->avatar != null){
            Storage::delete('uploads/'.$this->avatar);
        }
        $filename  = str_random(10).'.'.$avatar->extension();
        $avatar->storeAs('uploads',$filename);
        $this->avatar = $filename;
        $this->save();
    }

    /**update user*/
    public function edit($value){
         $this->fill($value);
         $this->save();
    }

  public function generalPassword($password){
      if($password != null){
          $this->password = bcrypt($password);
          $this->save();
      }
  }


}
