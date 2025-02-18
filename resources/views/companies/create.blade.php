@extends('layouts.admin')

@section('title', 'Company')

@section('content')
<div class="container">
    <h2>{{ __('messages.add_company') }}</h2>

    <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>{{ __('messages.name') }} (English)</label>
            <input type="text" id="name_en" name="name_en" class="form-control" value="{{ old('name_en') }}">
            @error('name_en')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>{{ __('messages.name') }} (Hindi)</label>
            <input type="text" id="name_hi" name="name_hi" class="form-control" value="{{ old('name_hi') }}">
            @error('name_hi')
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
            <label>{{ __('messages.website') }}</label>
            <input type="text" name="website" class="form-control" value="{{ old('website') }}">
            @error('website')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="logo">{{ __('messages.logo') }}</label>
            <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">
            
            @error('logo')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            @if(isset($company) && $company->logo)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $company->logo) }}" width="100" alt="Company Logo">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-success">{{ __('messages.save') }}</button>
        <a href="{{ route('companies.index') }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
    </form>
</div>
@endsection