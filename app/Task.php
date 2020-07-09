<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Relationships\TaskRelationship;

class Task extends Model
{
    use TaskRelationship;

    protected $table = 'task';

    protected $fillable = [
        'title',
        'description',
        'status_id',
        'created_at',
        'updated_at'
    ];
}
