@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>{{ __('messages.company_details') }}</h2>

    <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">{{ __('messages.back') }}</a>

    <table class="table table-bordered">
        <tr><th>{{ __('messages.id') }}</th><td>{{ $company->id }}</td></tr>
        <tr><th>{{ __('messages.name') }}</th><td>{{ app()->getLocale() == 'hi' ? $company->name_hi : $company->name_en }}</td></tr>
        <tr><th>{{ __('messages.email') }}</th><td>{{ $company->email }}</td></tr>
        <tr><th>{{ __('messages.website') }}</th><td>{{ $company->website }}</td></tr>
        <tr>
            <th>{{ __('messages.logo') }}</th>
            <td>
                <img src="{{ $company->logo && file_exists(public_path('storage/' . $company->logo)) 
                            ? asset('storage/' . $company->logo) 
                            : asset('images/no-image.jpg') }}" 
                    class="img-fluid" width="100">
            </td>
        </tr>
    </table>

    <h3>{{ __('messages.employee_list') }}</h3>
    @if($company->employees->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ __('messages.id') }}</th>
                    <th>{{ __('messages.first_name') }}</th>
                    <th>{{ __('messages.last_name') }}</th>
                    <th>{{ __('messages.email') }}</th>
                    <th>{{ __('messages.phone') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($company->employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>
                            {{ app()->getLocale() == 'hi' ? $employee->first_name_hi : $employee->first_name_en }}
                        </td>
                        <td>
                            {{ app()->getLocale() == 'hi' ? $employee->last_name_hi : $employee->last_name_en }}
                        </td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>{{ __('messages.no_employees') }}</p>
    @endif
</div>
@endsection
