<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskCollection;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TasksController extends Controller
{
    public function index(): TaskCollection
    {
        return new TaskCollection(Task::all());
    }

    public function create(CreateTaskRequest $request): JsonResponse
    {
        $task = Task::create($request->only("title", "description", "status", "user_id"));

        return response()->json(new \App\Http\Resources\Task($task), 201);
    }

    public function update(Task $task, UpdateTaskRequest $request): JsonResponse
    {
        $task->update($request->only("title", "description", "status", "user_id"));

        return response()->json(new \App\Http\Resources\Task($task), 201);
    }

    public function delete(Task $task): JsonResponse
    {
        $task->delete();

        return response()->json([
            "deleted" => true
        ], 204);
    }
}
