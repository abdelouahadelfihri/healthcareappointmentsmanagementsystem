@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Liste of Suppliers</h1>

        <div class="mb-3">
            <a class="btn btn-primary rounded-pill shadow-sm d-inline-flex align-items-center gap-2"
                href="{{ route('suppliers.create') }}">
                <i class="bi bi-plus-lg"></i> Add a Supplier
            </a>
        </div>

        @if($suppliers->isEmpty())
            <div class="alert alert-info">No suppliers found.</div>
        @else
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="patientsTable" class="table table-striped table-hover table-bordered align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Specialty</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($doctors as $doctor)
                                    <tr>
                                        <td>{{ $doctor->name }}</td>
                                        <td>{{ $doctor->specialty }}</td>
                                        <td>{{ $doctor->phone }}</td>
                                        <td>{{ $doctor->email }}</td>
                                        <td>
                                            @if($selectFor && $returnUrl)
                                                @php
                                                    $form = session('sale_quotation_form', []);
                                                    $query = array_merge(['selected_customer_id' => $s->id], $form);
                                                @endphp
                                                <a class="btn btn-success btn-sm"
                                                    href="{{ $returnUrl }}?{{ http_build_query($query) }}">
                                                    Select
                                                </a>
                                            @else
                                                <a class="btn btn-warning btn-sm" href="{{ route('customers.edit', $s) }}">Edit</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        @endif
        </div>
@endsection

    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    @endpush

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#suppliersTable').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true
                });
            });
        </script>
    @endpush




    @extends('layouts.app')

    @section('content')
        <div class="container">
            <h1>Doctors</h1>
            <a href="{{ route('doctors.create') }}" class="btn btn-primary mb-3">Add Doctor</a>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Specialty</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($doctors as $doctor)
                        <tr>
                            <td>{{ $doctor->name }}</td>
                            <td>{{ $doctor->specialty }}</td>
                            <td>{{ $doctor->phone }}</td>
                            <td>{{ $doctor->email }}</td>
                            <td>
                                <a href="{{ route('doctors.edit', $doctor) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('doctors.destroy', $doctor) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete this doctor?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection