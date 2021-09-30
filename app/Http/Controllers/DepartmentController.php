<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
  private $departmentModel;

  public function __construct(Department $department)
  {
    $this->departmentModel = $department;
  }

  public function index()
  {
    $departments = $this->departmentModel->get();
    return view('dashboard.departments.index', compact('departments'));
  }
  
  public function create()
  {
    return view('dashboard.departments.create');
  }

  public function store(Request $request)
  {
    try {
      $this->departmentModel::create([
        'name' => $request->name
      ]);
      session()->flash('success', 'Department created successfully');
      return redirect(route('departments.index'));
    } catch (\Exception $ex) {
      return back()->with('error', 'Try Again');
    }
  }

  public function edit($id)
  {
    $department = $this->departmentModel->findOrFail($id);
    return view('dashboard.departments.edit', compact('department'));
  }

  public function update(Request $request, $id)
  {
    $department = $this->departmentModel->findOrFail($id);
    try {
      $department->update([
        'name' => $request->name
      ]);
      session()->flash('success', 'Department updated successfully');
      return redirect(route('departments.index'));
    } catch (\Exception $ex) {
      return back()->with('error', 'Try Again');
    }
  }

  public function delete($id)
  {
    $department = $this->departmentModel->findOrFail($id);
    $department->delete();
    return response()->json(['status' => 'Department deleted successfully']);
  }
}
