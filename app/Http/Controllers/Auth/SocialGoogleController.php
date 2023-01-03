<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;

class SocialGoogleController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')
                    ->scopes(['email', 'profile'])
                    ->redirect();
    }

    public function handleProviderCallback(Request $request)
    {
        try {
            $user = Socialite::driver('google')->user();

            $existingUser = User::where('provider_id', $user->getId())->first();

            if ($existingUser)
            {
                Auth::login($existingUser);
            }
            else
            {
                $newUser = new User();

                $newUser->email = $user->getEmail();
                $newUser->provider_id = $user->getId();

                // при логіні від Google метод getNickname() повертає NULL, тому
                // використовуємо метод getName()
                $newUser->name = $user->getName();
                $newUser->handle_social = $user->getName();
                $newUser->password = bcrypt(uniqid('', true));


                // тут налаштовуються решта необхідних полів для
                // створення користувача
                // ...


                $newUser->save();

                Auth::login($newUser);
            }

            flash('Successfully authenticated using Google');

            return redirect()->route('home');
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }
}
