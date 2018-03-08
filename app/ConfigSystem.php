<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigSystem extends Model
{
    protected $table = 'config_system';
    protected $fillable = ['key', 'value'];
    protected $guarded = ['id'];
}
