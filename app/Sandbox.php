<?php

namespace App;

use App\Traits\AttachFilesTrait;
use Illuminate\Database\Eloquent\Model;

class Sandbox extends Model
{
    use AttachFilesTrait;

    public $table = 'sandbox';

    protected $fillable = [
      'name',
      'origin',
      'voucher',
      'admin_user_id'
    ];

    public $searchable = [
        'name'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $with = [
      'adminUser'
    ];

    public function adminUser()
    {
        return $this->belongsTo(AdminUser::class);
    }
}
