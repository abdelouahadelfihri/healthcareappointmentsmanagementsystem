@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Liste of Patients</h1>

        <div class="mb-3">
            <a class="btn btn-primary rounded-pill shadow-sm d-inline-flex align-items-center gap-2"
                href="{{ route('patients.create') }}">
                <i class="bi bi-plus-lg"></i> Add a Patient
            </a>
        </div>

        @if($patients->isEmpty())
            <div class="alert alert-info">No patients found.</div>
        @else
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="patientsTable" class="table table-striped table-hover table-bordered align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($patients as $patient)
                                    <tr>
                                        <td>{{ $patient->name }}</td>
                                        <td>{{ $patient->phone }}</td>
                                        <td>{{ $patient->email }}</td>
                                        <td>{{ $patient->address }}</td>
                                        <td>
                                            <span class="badge @if($req->status === 'draft') bg-secondary                                                                                                                                                                                                                        @elseif($req->status === 'pending') bg-warning text-dark
                                            @elseif($req->status === 'approved') bg-success
                                                        @else bg-light text-dark @endif">
                                                {{ ucfirst($req->status) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-1">
                                                <!-- Edit button -->
                                                <a href="{{ route('purchasesrequests.edit', $req) }}" class="btn btn-sm btn-warning"
                                                    title="Edit">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>

                                                <!-- Delete button -->
                                                <form action="{{ route('purchasesrequests.destroy', $req) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this request?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Include Bootstrap Icons CDN if not already in your layout -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

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
            $('#patientsTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true
            });
        });
    </script>
@endpush