<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected  $fillable = ['name', 'label'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function givePermissionTo(Permission $permission)
    {
        return $this->permissions()->save($permission);
    }

    public  function hasPermission($roleId)
    {
        $role = $this->permissions()->pluck('permissions.id');
        return $role->contains($roleId);
    }
}
