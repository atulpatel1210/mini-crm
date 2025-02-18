<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::latest()->paginate(10);
        return view('employees.index', compact('employees'));
    }

    public function getData(Request $request)
    {
        try {
            if ($request->ajax()) {
                $employees = Employee::with('company')->select(['id', 'first_name_en', 'first_name_hi', 'last_name_en', 'last_name_hi', 'email', 'phone', 'company_id'])->orderBy('id', 'desc');

                return DataTables::of($employees)
                    ->addColumn('company_name', function($employee) {
                        return $employee->company ? $employee->company->name : 'N/A';
                    })
                    ->editColumn('first_name', function ($employee) {
                        return app()->getLocale() == 'hi' ? $employee->first_name_hi : $employee->first_name_en;
                    })
                    ->editColumn('last_name', function ($employee) {
                        return app()->getLocale() == 'hi' ? $employee->last_name_hi : $employee->last_name_en;
                    })
                    ->addColumn('actions', function($employee) {
                        return '
                            <a href="'.route('employees.show', $employee->id).'" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="'.route('employees.edit', $employee->id).'" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            <form action="'.route('employees.destroy', $employee->id).'" method="POST" style="display:inline;">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        ';
                    })
                    ->rawColumns(['company_name', 'actions'])
                    ->make(true);
                }
                return response()->json(['error' => 'Unauthorized access'], 403);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function create()
    {
        $companies = Company::all();
        return view('employees.create', compact('companies'));
    }

    public function store(EmployeeRequest $request)
    {
        Employee::create($request->validated());
        return redirect()->route('employees.index')->with('success', __('messages.employee_create_success'));
    }

    public function edit(Employee $employee)
    {
        $companies = Company::all();
        return view('employees.edit', compact('employee', 'companies'));
    }

    public function update(EmployeeRequest $request, $id)
    {        
        $employee = Employee::findOrFail($id);
        $employee->update($request->validated());
        return redirect()->route('employees.index')->with('success', __('messages.employee_update_success'));
    }

    public function show($id)
    {
        $employee  = Employee::findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', __('messages.employee_delete_success'));
    }
}