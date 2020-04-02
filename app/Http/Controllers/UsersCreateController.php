<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersCreateController extends Controller
{
    public function create(Request $request)
    {
        try {
            //vtora opcija - avion
            $user = new User($request->all());
            $user->save();

            return response()->json([
              'error' => false,
              'messages' => ['The User is successfully registered']
            ]);
        } catch (\Exception $e) {
            return response()->json([
              'error' => true,
              'messages' => [$e->getMessage()]
            ]);
        }
    }
}
