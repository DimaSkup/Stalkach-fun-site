<?php

namespace App\Service;

final class BanUserCommand
{
    public function banUser(User $user)
    {
        $user->banned = true;
        $user->save();
    }
}