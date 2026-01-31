@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Liste of Purchases Requests</h1>

        <div class="mb-3">
            <a class="btn btn-primary rounded-pill shadow-sm d-inline-flex align-items-center gap-2"
                href="{{ route('purchasesrequests.create') }}">
                <i class="bi bi-plus-lg"></i> Add a New Purchase Request
            </a>
        </div>

        @if($requests->isEmpty())
            <div class="alert alert-info">No purchases requests found.</div>
        @else
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="purchasesRequestsTable"
                            class="table table-striped table-hover table-bordered align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>Patient</th>
                                    <th>Doctor</th>
                                    <th>Date & Time</th>
                                    <th>Status</th>
                                    <th>Services</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $appointment)
                                    <tr>
                                        <td>{{ $appointment->patient->name }}</td>
                                        <td>{{ $appointment->doctor->name }}</td>
                                        <td>{{ $appointment->appointment_datetime }}</td>
                                        <td>{{ ucfirst($appointment->status) }}</td>
                                        <td>
                                            @foreach($appointment->services as $service)
                                                {{ $service->name }} ({{ $service->pivot->quantity }})<br>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('appointments.edit', $appointment) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('appointments.destroy', $appointment) }}" method="POST"
                                                style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Delete this appointment?')">Delete</button>
                                            </form>
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
            $('#purchasesRequestsTable').DataTable({
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
        <h1>Appointments</h1>
        <a href="{{ route('appointments.create') }}" class="btn btn-primary mb-3">Add Appointment</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Date & Time</th>
                    <th>Status</th>
                    <th>Services</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->patient->name }}</td>
                        <td>{{ $appointment->doctor->name }}</td>
                        <td>{{ $appointment->appointment_datetime }}</td>
                        <td>{{ ucfirst($appointment->status) }}</td>
                        <td>
                            @foreach($appointment->services as $service)
                                {{ $service->name }} ({{ $service->pivot->quantity }})<br>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('appointments.destroy', $appointment) }}" method="POST"
                                style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete this appointment?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection