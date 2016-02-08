<?php

namespace App\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = ['name','display_name','description'];

    public static function getAllRolesList()
    {
        return self::paginate(25);
    }

    public static function getRoleById($id)
    {
        return self::find($id);
    }

    public static function getAllRolesDataModel()
    {
        return self::all();
    }
}
