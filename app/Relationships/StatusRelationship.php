<?php

namespace App\Relationships;

use App\Task;

trait StatusRelationship
{
    public function task()
    {
        return $this->hasMany(Task::class, 'status_id');
    }
}
