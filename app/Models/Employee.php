<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
  use HasFactory;
  protected $fillable = [
    'name', 'email', 'department_id'
  ];

  public function department()
  {
    return $this->belongsTo(Department::class, 'department_id', 'id');
  }

  public function tasks()
  {
    return $this->belongsToMany(Task::class, 'employees_tasks', 'employee_id', 'task_id')
      ->withTimestamps();
  }
}
