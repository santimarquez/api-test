<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionList extends Model
{
    use HasFactory;

    protected $table = 'permission_list';

    protected $fillable = [
        'permission_name',
    ];
}
