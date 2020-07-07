<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Relationships\TaskRelationship;

class Task extends Model
{
    use TaskRelationship;

    protected $table = 'task';
}
