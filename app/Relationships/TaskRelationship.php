<?php

namespace App\Relationships;

use App\Status;

trait TaskRelationship
{
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
