<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  use HasFactory;
  protected $fillable = [
    'name', 'description', 'priority'
  ];

  public function employees()
  {
    return $this->belongsToMany(Employee::class, 'employees_tasks', 'task_id', 'employee_id')
      ->withTimestamps();
  }
}
