@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>{{ __('messages.employee_details') }}</h2>

    <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">{{ __('messages.back') }}</a>

    <table class="table table-bordered">
        <tr><th>{{ __('messages.id') }}</th><td>{{ $employee->id }}</td></tr>
        <tr><th>{{ __('messages.first_name') }}</th><td>{{ app()->getLocale() == 'hi' ? $employee->first_name_hi : $employee->first_name_en }}</td></tr>
        <tr><th>{{ __('messages.last_name') }}</th><td>{{ app()->getLocale() == 'hi' ? $employee->last_name_hi : $employee->last_name_en }}</td></tr>
        <tr><th>{{ __('messages.email') }}</th><td>{{ $employee->email }}</td></tr>
        <tr><th>{{ __('messages.phone') }}</th><td>{{ $employee->phone }}</td></tr>
        <tr><th>{{ __('messages.company') }}</th><td>{{ app()->getLocale() == 'hi' ? $employee->company->name_hi : $employee->company->name_en }}</td></tr>
    </table>
</div>
@endsection
