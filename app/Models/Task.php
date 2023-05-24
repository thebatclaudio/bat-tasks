<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    const STATUS = [
        "PLANNED" => "planned",
        "IN_PROGRESS" => "in progress",
        "DONE" => "done"
    ];

    protected $fillable = [
        "title", "description", "status", "user_id"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
