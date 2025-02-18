@extends('layouts.admin')

@section('title', 'Company')

@section('content')
<div class="container">
    <h2>{{ __('messages.edit_company') }}</h2>

    <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>{{ __('messages.name') }} (English)</label>
            <input type="text" id="name_en" name="name_en" class="form-control" value="{{ old('name_en', $company->name_en) }}">
            @error('name_en')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>{{ __('messages.name') }} (Hindi)</label>
            <input type="text" id="name_hi" name="name_hi" class="form-control" value="{{ old('name_hi', $company->name_hi) }}">
            @error('name_hi')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">{{ __('messages.email') }}</label>
            <input type="email" id="email" name="email" value="{{ old('email', $company->email) }}" class="form-control">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="website">{{ __('messages.website') }}</label>
            <input type="text" id="website" name="website" value="{{ old('website', $company->website) }}" class="form-control">
            @error('website')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="logo">{{ __('messages.logo') }}</label>
            <input type="file" id="logo" name="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*">
            
            @error('logo')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            @php
                $logoPath = 'storage/' . $company->logo;
                $defaultImage = asset('images/no-image.jpg');
            @endphp

                <div class="mt-2">
                    <img id="logo-preview" src="{{ !empty($company->logo) && file_exists(public_path($logoPath)) ? asset($logoPath) : $defaultImage }}" width="100" alt="Company Logo" class="img-thumbnail">
                </div>
        </div>
        <button type="submit" class="btn btn-success">{{ __('messages.update') }}</button>
        <a href="{{ route('companies.index') }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
    </form>
</div>

@endsection

@section('scripts')
<script>
    document.getElementById('logo').addEventListener('change', function(event) {
        let reader = new FileReader();
        reader.onload = function() {
            let output = document.getElementById('logo-preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    });
</script>
@endsection
