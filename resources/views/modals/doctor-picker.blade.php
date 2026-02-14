<div class="modal fade" id="doctorModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            {{-- Header --}}
            <div class="modal-header">
                <h5 class="modal-title">Select Doctor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            {{-- Body --}}
            <div class="modal-body">

                {{-- Search --}}
                <div class="mb-3">
                    <input type="text" id="doctorSearch" class="form-control" placeholder="Search doctors...">
                </div>

                {{-- Doctors table --}}
                <table class="table table-hover" id="doctorTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Specialty</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\Doctor::all() as $doctor)
                            <tr>
                                <td>{{ $doctor->name }}</td>
                                <td>{{ $doctor->specialty }}</td>
                                <td>{{ $doctor->email }}</td>
                                <td>{{ $doctor->phone }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary select-doctor"
                                        data-id="{{ $doctor->id }}" data-name="{{ $doctor->name }}">
                                        Select
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <hr>

                {{-- Add new doctor --}}
                <h6 class="fw-bold mb-3">Add New Doctor</h6>

                <div class="mb-2">
                    <input type="text" id="new_doctor_name" class="form-control" placeholder="Doctor Name" required>
                </div>

                <div class="mb-2">
                    <input type="text" id="new_doctor_specialty" class="form-control" placeholder="Specialty">
                </div>

                <div class="mb-2">
                    <input type="text" id="new_doctor_phone" class="form-control" placeholder="Phone">
                </div>

                <div class="mb-3">
                    <input type="email" id="new_doctor_email" class="form-control" placeholder="Email">
                </div>

                <button type="button" class="btn btn-success w-100" id="addDoctorBtn">
                    + Add Doctor
                </button>

            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {

            // 🔍 Search doctors
            $('#doctorSearch').on('keyup', function () {
                let value = $(this).val().toLowerCase();
                $('#doctorTable tbody tr').filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });

            // ➕ Add doctor via AJAX
            $('#addDoctorBtn').on('click', function () {

                let name = $('#new_doctor_name').val().trim();
                let specialty = $('#new_doctor_specialty').val().trim();
                let phone = $('#new_doctor_phone').val().trim();
                let email = $('#new_doctor_email').val().trim();

                if (name === '') {
                    alert('Doctor name is required');
                    return;
                }

                $.ajax({
                    url: '{{ route("doctors.ajaxStore") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: name,
                        specialty: specialty,
                        phone: phone,
                        email: email
                    },
                    success: function (data) {

                        $('#doctorTable tbody').append(`
                            <tr>
                                <td>${data.name}</td>
                                <td>${data.specialty ?? ''}</td>
                                <td>${data.email ?? ''}</td>
                                <td>${data.phone ?? ''}</td>
                                <td>
                                    <button type="button"
                                        class="btn btn-sm btn-primary select-doctor"
                                        data-id="${data.id}"
                                        data-name="${data.name}">
                                        Select
                                    </button>
                                </td>
                            </tr>
                        `);

                        // reset form
                        $('#new_doctor_name').val('');
                        $('#new_doctor_specialty').val('');
                        $('#new_doctor_phone').val('');
                        $('#new_doctor_email').val('');
                    }
                });
            });

            // 🎯 Select doctor
            $(document).on('click', '.select-doctor', function () {

                let id = $(this).data('id');
                let name = $(this).data('name');

                $('#doctor_id').val(id);
                $('#doctor_name').val(name);

                // close modal
                let modalEl = document.getElementById('doctorModal');
                let modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                modal.hide();
            });

        });
    </script>
@endpush