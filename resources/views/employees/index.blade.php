@extends('layouts.admin')

@section('title', 'Employee')

@section('content')
<div class="container">
    <h2>{{ __('messages.employees') }}</h2>
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
        <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">{{ __('messages.add_employee') }}</a>
    </div>

    <table id="employeesTable" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{ __('messages.first_name') }}</th>
                <th>{{ __('messages.last_name') }}</th>
                <th>{{ __('messages.email') }}</th>
                <th>{{ __('messages.phone') }}</th>
                <th>{{ __('messages.company') }}</th>
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
        $('#employeesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("employees.getData") }}',
                type: 'POST',
                error: function(xhr, error, thrown) {
                    console.log('Error:', xhr.responseText);
                }
            },
            pageLength: 10,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            columns: [
                { data: 'id', name: 'id' },
                { data: 'first_name', name: 'first_name', orderable: false },
                { data: 'last_name', name: 'last_name', orderable: false },
                { data: 'email', name: 'email' },
                { data: 'phone', name: 'phone' },
                { data: 'company_name', name: 'company_name', orderable: false },
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