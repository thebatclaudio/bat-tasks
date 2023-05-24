<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends JsonRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            "title" => "string",
            "description" => "string",
            "status" => [
                Rule::in(Task::STATUS)
            ],
            "user_id" => "integer|exists:users,id"
        ];
    }
}
