<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\User;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use Illuminate\Contracts\View\View;

class UserController extends Controller
{


	public function show(User $user): View
	{
		return view('user.show.show',
			[
				'user' => $user,
			]);
	}

	public function edit(User $user): View
	{
		return view('user.edit.edit',
		[
			'user' => $user,
		]);
	}

    public function update(Request $request, User $user): JsonResponse
	{
		Utils::dd($user);

		try
		{
			return response()->json([
				'success' => true,
				'userId' => $user->id,
			], 200);
		}
		catch (\Exception $e)
		{
			return response()->json([
				'success' => false,
				'userId' => $user->id,
			], 200);
		}
	}


	public function userList()
	{
		$users = User::all();
		$users->each(static function($userObj, $userId) {

			dump($userObj->id . " => " .  $userObj->name);
		});
		$usersNames = array_column($users->toArray(), 'name');

		//dd($usersNames);
	}
}
