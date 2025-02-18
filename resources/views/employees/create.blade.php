@extends('layouts.admin')

@section('title', 'Employee')

@section('content')
<div class="container">
    <h2>{{ __('messages.add_employee') }}</h2>

    <form action="{{ route('employees.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="first_name_en">{{ __('messages.first_name') }} (English)</label>
            <input type="text" class="form-control" id="first_name_en" name="first_name_en" value="{{ old('first_name_en') }}">
            @error('first_name_en')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="first_name_hi">{{ __('messages.first_name') }} (Hindi)</label>
            <input type="text" class="form-control" id="first_name_hi" name="first_name_hi" value="{{ old('first_name_hi') }}">
            @error('first_name_hi')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="last_name_en">{{ __('messages.last_name') }} (English)</label>
            <input type="text" class="form-control" id="last_name_en" name="last_name_en" value="{{ old('last_name_en') }}">
            @error('last_name_en')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="last_name_hi">{{ __('messages.last_name') }} (Hindi)</label>
            <input type="text" class="form-control" id="last_name_hi" name="last_name_hi" value="{{ old('last_name_hi') }}">
            @error('last_name_hi')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>{{ __('messages.email') }}</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>{{ __('messages.phone') }}</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
            @error('phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>{{ __('messages.company') }}</label>
            <select name="company_id" class="form-control">
                <option value="">{{ __('messages.select_company') }}</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
            @error('company_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">{{ __('messages.save') }}</button>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
    </form>
</div>
@endsection