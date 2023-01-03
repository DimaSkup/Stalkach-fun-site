<?php


namespace App\Service;


use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;

final class BanningWrongImageUploadsListener implements WrongImageUploadsListener
{
    const BAN_THRESHOLD = 5;

    private BanUserCommand $banUserCommand;
    private RateLimiter $rateLimiter;

    public function __construct(
        BanUserCommand $banUserCommand,
        RateLimiter $rateLimiter)
    {
        $this->banUserCommand = $banUserCommand;
        $this->rateLimiter = $rateLimiter;
    }

    public function handle(User $user): bool
    {
        $rateLimiterResult = $this->rateLimiter::tooManyAttempts();

        if ($rateLimiterResult)
        {
            $this->banUserCommand->banUser($user);
            return false;
        }

        return true;
    }
}