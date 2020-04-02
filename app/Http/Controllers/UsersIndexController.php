<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersIndexController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'error' => false,
                'messages' => ['Here are all the users available at the DB'],
                'items' => $this->fetchUsers()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'messages' => [$e->getMessage()]
            ]);
        }
    }

    private function fetchUsers() 
    {
        return User::all();
    }
}
