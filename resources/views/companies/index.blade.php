@extends('layouts.admin')

@section('title', 'Company')

@section('content')
<div class="container">
    <h2>{{ __('messages.companies') }}</h2>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('companies.create') }}" class="btn btn-primary">{{ __('messages.add_company') }}</a>
    </div>

    <table id="companiesTable" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{ __('messages.logo') }}</th>
                <th>{{ __('messages.name') }}</th>
                <th>{{ __('messages.email') }}</th>
                <th>{{ __('messages.website') }}</th>
                <th>{{ __('messages.action') }}</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        $('#companiesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("companies.getData") }}',
                type: 'POST',
                error: function(xhr, error, thrown) {
                    console.log('Error:', xhr.responseText);
                }
            },
            pageLength: 10,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            columns: [
                { data: 'id', name: 'id' },
                { 
                    data: 'logo', 
                    name: 'logo',
                    orderable: false, 
                    searchable: false,
                },
                { data: 'name', name: 'name', orderable: false, },
                { data: 'email', name: 'email' },
                { data: 'website', name: 'website' },
                { 
                    data: 'actions', 
                    name: 'actions', 
                    orderable: false, 
                    searchable: false 
                }
            ]
        });
    });
</script>
@endsection
