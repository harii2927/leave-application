<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $table = "employee_leaves";

    protected $fillable = [
      'name',
      'emp_id',
      'emp_email',
      'date',
      'reason',
      'approval_token',
      'status',
    ];
}
