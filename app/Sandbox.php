<?php

namespace App;

use App\Traits\AttachFilesTrait;
use Illuminate\Database\Eloquent\Model;

class Sandbox extends Model
{
    use AttachFilesTrait;

    public $table = 'sandbox';

    protected $fillable = [
      'name'
    ];
}
