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

    public $searchable = [
        'name',
        'email'
    ];

    public function admin_user()
    {
        return $this->belongsTo(AdminUser::class);
    }
}
