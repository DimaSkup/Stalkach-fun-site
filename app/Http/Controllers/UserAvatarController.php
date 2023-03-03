<?php

namespace App\Http\Controllers;

use App\Service\ImageUploader;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserAvatarController extends Controller
{
	public function update(Request $request, ImageUploader $imageUploader): JsonResponse
	{
		try
		{
			$responseData = [
				'success' => true,
			];

			return response()->json($responseData, 200);
		}
		catch (\Exception $e)
		{
			return response()->json([
				'success' => false,
			], 200);
		}
	}
}
