@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('messages.dashboard_message') }}</h3>
                </div>
                <div class="card-body">
                    <p>{{ __('messages.dashboard_content') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
