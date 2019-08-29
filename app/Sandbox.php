<?php

namespace App;
use Plank\Mediable\Mediable;
use Illuminate\Database\Eloquent\Model;

class Sandbox extends Model
{
  use Mediable;
  public $table = 'sandbox';

  protected $fillable = [
      'name'
  ];
}
