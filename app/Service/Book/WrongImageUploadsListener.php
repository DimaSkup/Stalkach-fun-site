<?php


namespace App\Service;

use App\Models\User;

interface WrongImageUploadsListener
{
    public function handle(User $user);
}