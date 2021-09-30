<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\{
  Employee, Task
};
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
  private $taskModel;
  private $employeeModel;

  public function __construct(Task $task, Employee $employee)
  {
    $this->taskModel = $task;
    $this->employeeModel = $employee;
  }

  public function index()
  {
    $tasks = $this->taskModel::with('employees')->get();
    $employees = $this->employeeModel->select('name');
    return view('dashboard.tasks.index', compact('tasks', 'employees'));
  }

  public function create()
  {
    $employees = $this->employeeModel->get();
    return view('dashboard.tasks.create', compact('employees'));
  }

  public function store(TaskRequest $request)
  {
    $employees = $request->employees_id;
    try {
      DB::beginTransaction();
      $task = $this->taskModel::create([
        'name'        => $request->name,
        'description' => $request->description,
        'priority'    => $request->priority
      ]);
      $task->employees()->sync($employees);
      DB::commit();
      session()->flash('success', 'Task created successfully');
      return redirect(route('tasks.index'));
    } catch (\Exception $ex) {
      DB::rollBack();
      return back()->with('error', 'Try Again');
    }
  }

  public function edit($id)
  {
    $task = $this->taskModel->findOrFail($id);
    $employees = $this->employeeModel->get();
    return view('dashboard.tasks.edit', compact('task', 'employees'));
  }

  public function update(TaskRequest $request, $id)
  {
    $task = $this->taskModel->findOrFail($id);
    $employees = $request->employees_id;
    try {
      DB::beginTransaction();
      $task->update([
        'name'        => $request->name,
        'description' => $request->description,
        'priority'    => $request->priority
      ]);
      $task->employees()->sync($employees);
      DB::commit();
      session()->flash('success', 'Task updated successfully');
      return redirect(route('tasks.index'));
    } catch (\Exception $ex) {
      DB::rollBack();
      return back()->with('error', 'Try Again');
    }
  }

  public function delete($id)
  {
    $task = $this->taskModel->findOrFail($id);
    $task->delete();
    return response()->json(['status' => 'Task deleted successfully']);
  }
}
