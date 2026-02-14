<div class="modal fade" id="patientModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            {{-- Header --}}
            <div class="modal-header">
                <h5 class="modal-title">Select Patient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            {{-- Body --}}
            <div class="modal-body">

                {{-- Search --}}
                <div class="mb-3">
                    <input type="text" id="patientSearch" class="form-control" placeholder="Search patients...">
                </div>

                {{-- Patients table --}}
                <table class="table table-hover" id="patientTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\Patient::all() as $patient)
                            <tr>
                                <td>{{ $patient->name }}</td>
                                <td>{{ $patient->email }}</td>
                                <td>{{ $patient->phone }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary select-patient"
                                        data-id="{{ $patient->id }}" data-name="{{ $patient->name }}"
                                        data-email="{{ $patient->email }}" data-phone="{{ $patient->phone }}">
                                        Select
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <hr>

                {{-- Add new patient --}}
                <h6 class="fw-bold mb-3">Add New Patient</h6>

                <div class="mb-2">
                    <input type="text" id="new_patient_name" class="form-control" placeholder="Name" required>
                </div>

                <div class="mb-2">
                    <input type="date" id="new_patient_date_of_birth" class="form-control">
                </div>

                <div class="mb-2">
                    <input type="text" id="new_patient_phone" class="form-control" placeholder="Phone">
                </div>

                <div class="mb-2">
                    <input type="email" id="new_patient_email" class="form-control" placeholder="Email">
                </div>

                <div class="mb-3">
                    <textarea id="new_patient_address" class="form-control" placeholder="Address" rows="2"></textarea>
                </div>

                <button type="button" class="btn btn-success w-100" id="addPatientBtn">
                    + Add Patient
                </button>

            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        $(document).ready(function () {

            // 🔍 Search filter
            $('#patientSearch').on('keyup', function () {
                let value = $(this).val().toLowerCase();
                $('#patientTable tbody tr').filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            // ➕ Add patient via AJAX
            $('#addPatientBtn').on('click', function () {

                let name = $('#new_patient_name').val().trim();
                let date_of_birth = $('#new_patient_date_of_birth').val();
                let phone = $('#new_patient_phone').val().trim();
                let email = $('#new_patient_email').val().trim();
                let address = $('#new_patient_address').val().trim();

                if (name === '') {
                    alert('Name is required');
                    return;
                }

                $.ajax({
                    url: '{{ route("patients.ajaxStore") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: name,
                        date_of_birth: date_of_birth,
                        phone: phone,
                        email: email,
                        address: address
                    },
                    success: function (data) {

                        $('#patientTable tbody').append(`
                        <tr>
                            <td>${data.name}</td>
                            <td>${data.email ?? ''}</td>
                            <td>${data.phone ?? ''}</td>
                            <td>
                                <button type="button"
                                    class="btn btn-sm btn-primary select-patient"
                                    data-id="${data.id}"
                                    data-name="${data.name}"
                                    data-email="${data.email}"
                                    data-phone="${data.phone}">
                                    Select
                                </button>
                            </td>
                        </tr>
                    `);

                        // clear inputs
                        $('#new_patient_name').val('');
                        $('#new_patient_date_of_birth').val('');
                        $('#new_patient_phone').val('');
                        $('#new_patient_email').val('');
                        $('#new_patient_address').val('');
                    }
                });
            });

            // 🎯 Select patient
            $(document).on('click', '.select-patient', function () {

                let id = $(this).data('id');
                let name = $(this).data('name');

                $('#patient_id').val(id);
                $('#patient_name').val(name);

                // close modal
                let modalEl = document.getElementById('patientModal');
                let modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                modal.hide();
            });

        });
    </script>
@endpush