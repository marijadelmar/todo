<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\User;

class TasksCreateController extends Controller
{
    public function create(Request $request)
    {
        try {
            $task = new Task($request->all());

            $userAuthor = User::find($request->get('user_id'));
            $task->setUser($userAuthor);
            
            $assigneesIds = explode(',', $request->get('assignees'));
            $assignees = User::whereIn('id', $assigneesIds)->get()->all();

            $task->save();

            $task->assignUsers($assignees);

            $task->save();

            return response()->json([
              'error' => false,
              'messages' => ['The task is successfully created'],
              'item' => $task
            ]);
        } catch (\Exception $e) {
            return response()->json([
              'error' => true,
              'messages' => [$e->getMessage()]
            ]);
        }
    }
}
