<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppsDevice extends Model
{
    //
    use SoftDeletes;
    protected $table = "apps_devices";
    protected $casts = ['device_id' => 'array',];
}
