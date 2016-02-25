<?php

namespace App\Model;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    /**
     * Judge if role has this permission.
     *
     * @param Permission $permission
     * @return bool
     */
    public function hasPerm(Permission $permission)
    {
        if ($this->perms->contains($permission->id)) {
            return true;
        }
        return false;
    }
}
