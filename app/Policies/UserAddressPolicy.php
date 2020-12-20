<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserAddressPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //检测是不是自己的账号，只允许地址的拥有者来修改和删除地址

    public function own(User $user,UserAddress $address){
        return $address->user_id == $user->id;
    }
}
