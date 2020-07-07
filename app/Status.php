<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Relationships\StatusRelationship;

class Status extends Model
{
    use StatusRelationship;

    protected $table = 'status';
}
