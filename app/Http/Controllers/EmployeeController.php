<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use App\Notifications\NewEmployeeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Schema;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $employees = Employee::with('company')
            ->when($search, function ($query, $search) {
                $columns = Schema::getColumnListing('employees');

                $query->where(function ($query) use ($columns, $search) {
                    foreach ($columns as $column) {
                        $query->orWhere($column, 'like', "%$search%");
                    }
                });
            })
            ->paginate(10); // Fetch 10 employees per page

        return view('employees.index', compact('employees'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        return view('employees.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $validated = $request->validated();
        $employee = Employee::create($validated);

        // Notify the admin of the company
        $admin = User::where('email', 'admin@folkatech.com')->first();
        if ($admin) {
            $admin->notify(new NewEmployeeNotification($employee));
        }

        return redirect()->route('employees.index')->with('success', 'Employee added successfully, and admin notified!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $companies = Company::all();
        return view('employees.edit', compact('employee', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $validated = $request->validated();
        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
