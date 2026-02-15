@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Create Appointment</h3>
            <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Back</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('appointments.store') }}">
                    @csrf

                    <!-- Patient -->
                    <div class="mb-3">
                        <label class="form-label">Patient</label>
                        <div class="input-group">
                            <input type="hidden" name="patient_id" id="patient_id">
                            <input type="text" id="patient_name" class="form-control" readonly>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                data-bs-target="#patientModal">Select Patient</button>
                        </div>
                    </div>

                    <!-- Doctor -->
                    <div class="mb-3">
                        <label class="form-label">Doctor</label>
                        <div class="input-group">
                            <input type="hidden" name="doctor_id" id="doctor_id">
                            <input type="text" id="doctor_name" class="form-control" readonly>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                data-bs-target="#doctorModal">Select Doctor</button>
                        </div>
                    </div>

                    <!-- Date & Time -->
                    <div class="mb-3">
                        <label class="form-label">Date & Time</label>
                        <input type="datetime-local" name="appointment_datetime" class="form-control" required>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="scheduled">Scheduled</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <!-- Services -->
                    <div class="mb-3">
                        <label class="form-label">Services</label>
                        <select name="services[]" class="form-control" multiple>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }} ({{ $service->price }})</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Hold Ctrl (Windows) or Cmd (Mac) to select multiple services</small>
                    </div>

                    <!-- Notes -->
                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="{{ route('appointments.index') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('modals.patient-picker')
    @include('modals.doctor-picker')

    <script>
        function selectPatient(id, name) {
            document.getElementById('patient_id').value = id;
            document.getElementById('patient_name').value = name;
            var patientModal = bootstrap.Modal.getInstance(document.getElementById('patientModal'));
            patientModal.hide();
        }

        function selectDoctor(id, name) {
            document.getElementById('doctor_id').value = id;
            document.getElementById('doctor_name').value = name;
            var doctorModal = bootstrap.Modal.getInstance(document.getElementById('doctorModal'));
            doctorModal.hide();
        }
    </script>
@endsection