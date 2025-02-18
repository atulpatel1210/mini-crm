<?php
namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Mail\NewCompanyNotification;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;


class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::latest()->paginate(10);
        return view('companies.index', compact('companies'));
    }

    public function getData(Request $request)
    {
        try {
            if ($request->ajax()) {
                $companies = Company::select(['id', 'logo', 'name_en', 'name_hi', 'email', 'website'])->orderBy('id', 'desc');
    
                return DataTables::of($companies)
                    ->editColumn('logo', function ($company) {
                        $logoPath = 'storage/' . $company->logo;
                        $defaultImage = asset('images/no-image.jpg');
                    
                        return (!empty($company->logo) && file_exists(public_path($logoPath))) 
                            ? '<img src="'.asset($logoPath).'" width="50" height="50" class="img-thumbnail"/>'
                            : '<img src="'.$defaultImage.'" width="50" height="50" class="img-thumbnail"/>';
                    })                
                    ->editColumn('name', function ($company) {
                        return app()->getLocale() == 'hi' ? $company->name_hi : $company->name_en;
                    })
                    ->addColumn('actions', function ($company) {
                        return '
                            <a href="'.route('companies.show', $company->id).'" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="'.route('companies.edit', $company->id).'" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            <form action="'.route('companies.destroy', $company->id).'" method="POST" style="display:inline;">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        ';
                    })
                    ->rawColumns(['logo', 'actions'])
                    ->make(true);
            }
    
            return response()->json(['error' => 'Unauthorized access'], 403);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    


    public function create()
    {
        return view('companies.create');
    }

    public function store(CompanyRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            Storage::disk('public')->makeDirectory('logos');
            $filename = 'logo_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('logos', $filename);
            $data['logo'] = 'logos/' . $filename;
        }
        $company = Company::create($data);
        Mail::to($data['email'])->send(new NewCompanyNotification($company));
        return redirect()->route('companies.index')->with('success', __('messages.create_success'));
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(CompanyRequest $request, $id)
    {
        $company = Company::findOrFail($id);
        $data = $request->validated();
        if ($request->hasFile('logo')) {
            if ($company->logo && Storage::disk('public')->exists($company->logo)) {
                Storage::disk('public')->delete($company->logo);
            }
            Storage::disk('public')->makeDirectory('logos');
            $filename = 'logo_' . uniqid() . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->storeAs('logos', $filename);
            $data['logo'] = 'logos/' . $filename;
        }
        $company->update($data);
        return redirect()->route('companies.index')->with('success', __('messages.update_success'));
    }

    public function show($id)
    {
        $company = Company::findOrFail($id);
        return view('companies.show', compact('company'));
    }


    public function destroy(Company $company)
    {
        if ($company->logo && Storage::exists('public/' . $company->logo)) {
            Storage::delete('public/' . $company->logo);
        }
        $company->delete();
        return redirect()->route('companies.index')->with('success', __('messages.delete_success'));
    }
}