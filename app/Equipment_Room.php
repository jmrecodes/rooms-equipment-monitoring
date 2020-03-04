<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Equipment_Room extends Model
{
    protected $table = 'equipment_room';
    protected $guarded = [''];

    public $timestamps = false;
}
