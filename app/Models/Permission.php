<?php

namespace App\Models;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $fillable = ['name','display_name','description'];

    public static function getAllPermissions()
    {
        return self::paginate(25);
    }

    public static function getPermissionById($id)
    {
        return self::find($id);
    }
}