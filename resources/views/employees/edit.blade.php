@extends('layouts.admin')

@section('title', 'Employee')

@section('content')
<div class="container">
    <h2>{{ __('messages.edit_employee') }}</h2>

    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>{{ __('messages.first_name') }} (English)</label>
            <input type="text" class="form-control" id="first_name_en" name="first_name_en" value="{{ old('first_name_en', $employee->first_name_en) }}" required>
            @error('first_name_en')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>{{ __('messages.first_name') }} (Hindi)</label>
            <input type="text" class="form-control" id="first_name_hi" name="first_name_hi" value="{{ old('first_name_hi', $employee->first_name_hi) }}" required>
            @error('first_name_hi')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>{{ __('messages.last_name') }} (English)</label>
            <input type="text" class="form-control" id="last_name_en" name="last_name_en" value="{{ old('last_name_en', $employee->last_name_en) }}" required>
            @error('last_name_en')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>{{ __('messages.last_name') }} (Hindi)</label>
            <input type="text" class="form-control" id="last_name_hi" name="last_name_hi" value="{{ old('last_name_hi', $employee->last_name_hi) }}" required>
            @error('last_name_hi')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>{{ __('messages.email') }}</label>
            <input type="email" name="email" value="{{ $employee->email }}" class="form-control">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>{{ __('messages.phone') }}</label>
            <input type="text" name="phone" value="{{ $employee->phone }}" class="form-control">
            @error('phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>{{ __('messages.company') }}</label>
            <select name="company_id" class="form-control">
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ $employee->company_id == $company->id ? 'selected' : '' }}>
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">{{ __('messages.update') }}</button>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
    </form>
</div>
@endsection
