<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $table = 'picture';
    protected $primaryKey = 'pic_id';
    public $timestamps = false;
    protected $guarded = [];
}
