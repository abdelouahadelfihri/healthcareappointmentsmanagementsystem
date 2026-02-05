<div class="modal fade" id="patientModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Patient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                {{-- Search --}}
                <div class="mb-2">
                    <input type="text" id="patientSearch" class="form-control" placeholder="Search categories...">
                </div>

                {{-- Table --}}
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
                        @foreach(App\Models\Patient::all() as $patient)
                            <tr>
                                <td>{{ $patient->name }}</td>
                                <td>{{ $patient->email }}</td>
                                <td>{{ $patient->phone }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary select-patient"
                                        data-id="{{ $patient->id }}" data-name="{{ $patient->name }}" data-email="{{ $patient->email }}"
                                        data-phone="{{ $patient->phone }}">
                                        Select
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <hr>

                {{-- ADD NEW SUPPLIER --}}
                <h6 class="fw-bold mb-2">Add New Patient</h6>

                <div class="row g-2 mb-2">
                    <div class="col-md-6">
                        <input type="text" id="new_patient_name" class="form-control" placeholder="Patient Name">
                    </div>
                    <div class="col-md-6">
                        <input type="email" id="new_patient_email" class="form-control" placeholder="Email">
                    </div>
                </div>

                <div class="row g-2 mb-2">
                    <div class="col-md-6">
                        <input type="text" id="new_patient_phone" class="form-control" placeholder="Phone">
                    </div>
                    <div class="col-md-6">
                        <input type="text" id="new_patient_address" class="form-control" placeholder="Address">
                    </div>
                </div>

                <button type="button" class="btn btn-success w-100" id="addPatientBtn">+ Add Patient</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {

            // 🔎 Search filter
            $('#patientSearch').on('keyup', function () {
                let value = $(this).val().toLowerCase();
                $('#patientTable tbody tr').filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            // ➕ Add category via AJAX
            $('#addPatientBtn').click(function () {
                let name = $('#new_patient_name').val().trim();
                let email = $('#new_patient_email').val().trim();
                let phone = $('#new_patient_phone').val().trim();
                let address = $('#new_patient_address').val().trim();

                if (name === '') return alert('Name is required');

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
                            <td>${data.date_of_birth ?? ''}</td>
                            <td>${data.phone ?? ''}</td>
                            <td>${data.email ?? ''}</td>
                            <td>${data.address ?? ''}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary select-patient"
                                    data-id="${data.id}" data-name="${data.name}" data-date_of_birth="${data.date_of_birth}" 
                                    data-phone="${data.phone}" data-email="${data.email}" data-address="${data.address}">
                                    Select
                                </button>
                            </td>
                        </tr>
                    `);

                        // clear inputs
                        $('#new_patient_name').val('');
                        $('#new_patient_email').val('');
                        $('#new_patient_phone').val('');
                        $('#new_patient_address').val('');
                    }
                });
            });

            // 🎯 Select category
            $(document).on('click', '.select-patient', function () {
                let id = $(this).data('id');
                let name = $(this).data('name');

                $('#category_id').val(id);
                $('#category_name').val(name);

                // close modal
                let modalEl = document.getElementById('patientModal');
                let modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                modal.hide();
            });

        });
    </script>
@endpush