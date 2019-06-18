<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\EventListener\SessionListener;

class User extends Authenticatable
{
    use Notifiable;
    const IS_BANNED = 1;
    const IS_ACTIVE = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','user_title'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(){

        return $this->hasMany(Like::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**загрузка зображення */
    public function uploadAvatar($avatar)
    {
        if ($avatar == null) {
            return;
        }
        if ($this->avatar != null) {
            Storage::delete('uploads/' . $this->avatar);
        }
        $filename = str_random(10) . '.' . $avatar->extension();
        $avatar->storeAs('uploads', $filename);
        $this->avatar = $filename;
        $this->save();
    }

    /**update user*/
    public function edit($value)
    {
        $this->fill($value);
        $this->save();
    }

    public function generalPassword($password)
    {
        if ($password != null) {
            $this->password = bcrypt($password);
            $this->save();
        }
    }

    public static function add($value)
    {
        $user = new static;
        $user->fill($value);
        $user->save();
        return $user;
    }

    public function getAvatar()
    {
        if ($this->avatar == null) {
            return '/uploads/no-image.png';
        }
            return '/uploads/'.$this->avatar;
    }


    public function status(){
        if($this->status  == null){
            $this->status = self::IS_BANNED;
            $this->save();
        }else
            $this->status = self::IS_ACTIVE;
            $this->save();
    }

    public function toggleAdmin($value)
    {
        if($value == null)
        {
            return $this->makeNormal();
        }

        return $this->makeAdmin();
    }

    public function makeNormal()
    {
        $this->is_admin = 0;
        $this->save();
    }

    public function makeAdmin()
    {
        $this->is_admin = 1;
        $this->save();
    }

    public function deleteAvatar(){
        if($this->avatar != null){
            Storage::delete("uploads/$this->avatar");
        }
    }

    public function remove(){
        $this->deleteAvatar();
        $this->delete();
    }

    public static function newUsersCont(){

        return self::where('status',1)->count();
    }

    ///////////////////////////////////////////////////////////////////////////
    ///
    /// ROLES LARACAST
    ///
    /// //////////////////////////////////////////////////////////////////////////////////

    public function hasRole($role)
    {
        if(is_string($role)){

            return $this->roles->contains('name', $role);
        }

        return !! $role->intersect($this->roles)->count();
    }

    public function assignRole( $role)
    {
      return   $this->roles()->save(
            Role::whereName($role)->firstOrFail()
        );
    }
}
