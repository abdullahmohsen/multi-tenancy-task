<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\{
  Employee, Department
};

class EmployeeController extends Controller
{
  private $employeeModel;
  private $departmentModel;

  public function __construct(Employee $employee, Department $department)
  {
    $this->employeeModel = $employee;
    $this->departmentModel = $department;
  }

  public function index()
  {
    $employees = $this->employeeModel->get();
    $departments = $this->departmentModel->select('name')->get();
    return view('dashboard.employees.index', compact('employees', 'departments'));
  }

  public function create()
  {
    $departments = $this->departmentModel->get();
    return view('dashboard.employees.create', compact('departments'));
  }

  public function store(EmployeeRequest $request)
  {
    try {
      $this->employeeModel::create([
        'name'          => $request->name,
        'email'         => $request->email,
        'department_id' => $request->department_id
      ]);
      session()->flash('success', 'Employee added successfully');
      return redirect(route('employees.index'));
    } catch (\Exception $ex) {
      return back()->with('error', 'Try Again');
    }
  }

  public function edit($id)
  {
    $employee = $this->employeeModel->findOrFail($id);
    $departments = $this->departmentModel->get();
    return view('dashboard.employees.edit', compact('employee', 'departments'));
  }

  public function update(EmployeeRequest $request, $id)
  {
    $employee = $this->employeeModel->findOrFail($id);
    try {
      $employee->update([
        'name'          => $request->name,
        'email'         => $request->email,
        'department_id' => $request->department_id
      ]);
      session()->flash('success', 'Employee updated successfully');
      return redirect(route('employees.index'));
    } catch (\Exception $ex) {
      return back()->with('error', 'Try Again');
    }
  }

  public function delete($id)
  {
    $employee = $this->employeeModel->findOrFail($id);
    $employee->delete();
    return response()->json(['status' => 'Employee deleted successfully']);
  }
}
