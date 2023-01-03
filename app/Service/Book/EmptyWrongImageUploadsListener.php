<?php

namespace App\Service;

use App\Models\User;

final class EmptyWrongImageUploadsListener implements WrongImageUploadsListener
{
    public function handle(User $user): void
    {
        // do nothing
    }

}