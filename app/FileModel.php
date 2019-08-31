<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileModel extends Model
{
    protected $fillable = [
      'name', 'file_name', 'mime_type', 'disk', 'size'
  ];
}
