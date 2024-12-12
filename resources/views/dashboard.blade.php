<x-app-layout>
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">{{ Auth::user()->name }} Dashboard</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Visitors</p>
                                        <h4 class="card-title">{{ $totaVisitor }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Unique Visitors</p>
                                        <h4 class="card-title">{{ $totaUniqueVisitor }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Todays Visitors</p>
                                        <h4 class="card-title">{{ $todaysVisitor }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                        <i class="far fa-check-circle"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Order</p>
                                        <h4 class="card-title">576</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">User Statistics</div>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-label-success btn-round btn-sm me-2">
                                        <span class="btn-label">
                                            <i class="fa fa-pencil"></i>
                                        </span>
                                        Export
                                    </a>
                                    <a href="#" class="btn btn-label-info btn-round btn-sm">
                                        <span class="btn-label">
                                            <i class="fa fa-print"></i>
                                        </span>
                                        Print
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="min-height: 375px">
                                <canvas id="statisticsChart"></canvas>
                            </div>
                            <div id="myChartLegend"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Customer Queries</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="query-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">#</th>
                                            <th scope="col" class="text-center">Name</th>
                                            <th scope="col" class="text-center">Status</th>
                                            <th scope="col" class="text-center">Email</th>
                                            <th scope="col" class="text-center">Phone No</th>
                                            <th scope="col" class="text-center">Date</th>
                                            <th scope="col" class="text-center">Message</th>
                                            <th scope="col" class="text-center">Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customer_query as $index => $query)
                                            <tr>
                                                <td class="text-center">{{ $index + 1 }}</td>
                                                <td class="text-center">{{ $query->name }}</td>
                                                <td
                                                    class="text-center {{ $query->status == true ? 'text-danger' : 'text-success' }}">
                                                    {{ $query->status == true ? 'new' : 'read' }}</td>
                                                <td class="text-center">{{ $query->email }}</td>
                                                <td class="text-center">{{ $query->phone_no }}</td>
                                                <td class="text-center">{{ $query->date }}</td>
                                                <td class="text-center">
                                                    {{ \Illuminate\Support\Str::limit($query->message, $limit = 20, $end = '...') }}
                                                </td>
                                                <td class="text-center"><button
                                                        class="btn btn-info btn-sm rounded-0 view-query"
                                                        data-id="{{ $query->id }}" data-name="{{ $query->name }}"
                                                        data-email="{{ $query->email }}"
                                                        data-phone="{{ $query->phone_no }}"
                                                        data-date="{{ $query->date }}"
                                                        data-message="{{ $query->message }}">view</button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Appointments</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">#</th>
                                            <th scope="col" class="text-center">Name</th>
                                            <th scope="col" class="text-center">Status</th>
                                            <th scope="col" class="text-center">Phone No</th>
                                            <th scope="col" class="text-center">Appointment Date</th>
                                            <th scope="col" class="text-center">Entry Date</th>
                                            <th scope="col" class="text-center">Doctor</th>
                                            <th scope="col" class="text-center">Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookAppointment as $index => $query)
                                            <tr>
                                                <td class="text-center">{{ $index + 1 }}</td>
                                                <td class="text-center">{{ $query->patient_name }}</td>
                                                <td
                                                    class="text-center {{ $query->status == 'new' ? 'text-danger' : 'text-success' }}">
                                                    {{ $query->status }}</td>
                                                <td class="text-center">{{ $query->age }}</td>
                                                <td class="text-center">{{ $query->appointment_date }}</td>
                                                <td class="text-center">{{ $query->entry_date }}</td>
                                                <td class="text-center">{{ $query->doctor_name }}</td>
                                                <!-- <td class="text-center">{{ \Illuminate\Support\Str::limit($query->message, $limit = 20, $end = '...') }}</td> -->
                                                <td class="text-center"><button
                                                        class="btn btn-info btn-sm rounded-0 view"
                                                        data-id="{{ $query->id }}"
                                                        data-patient_name="{{ $query->patient_name }}"
                                                        data-age="{{ $query->age }}"
                                                        data-phone_no="{{ $query->phone_no }}"
                                                        data-address="{{ $query->address }}"
                                                        data-appointment_date="{{ $query->appointment_date }}"
                                                        data-entry_date="{{ $query->entry_date }}"
                                                        data-doctor_name="{{ $query->doctor_name }}"
                                                        data-message="{{ $query->message }}">view</button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="detailModal" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceName">Appointment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row text-center">
                        <div class="col-md-12 bg-info text-light">
                            <label for="Registration No" class="form-label">Doctor Name</label>
                            <p id="modal_doctor_name"></p>
                        </div>
                        <div class="col-md-4">
                            <label for="Registration No" class="form-label">Name</label>
                            <p id="modal_name"></p>
                        </div>
                        <div class="col-md-4">
                            <label for="Registration No" class="form-label">Age</label>
                            <p id="modal_age"></p>
                        </div>
                        <div class="col-md-4">
                            <label for="Registration No" class="form-label">Phone No</label>
                            <p id="modal_phone"></p>
                        </div>
                        <div class="col-md-4">
                            <label for="Registration No" class="form-label">Entry Date</label>
                            <p id="modal_date"></p>
                        </div>
                        <div class="col-md-4">
                            <label for="Registration No" class="form-label">Appointment Date</label>
                            <p id="modal_appointment_date"></p>
                        </div>
                        <div class="col-md-12">
                            <label for="Registration No" class="form-label">
                                <Address></Address>
                            </label>
                            <p id="modal_modal_address"></p>
                        </div>
                        <div class="col-md-12">
                            <label for="Registration No" class="form-label">Message</label>
                            <p id="modal_message"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm rounded-0"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="queryDetailModal" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceName">Customer Query Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <label for="Registration No" class="form-label">Name</label>
                            <p id="modal_cutomer_name"></p>
                        </div>
                        <div class="col-md-4">
                            <label for="Registration No" class="form-label">Email</label>
                            <p id="modal_customer_email"></p>
                        </div>
                        <div class="col-md-4">
                            <label for="Registration No" class="form-label">Phone No</label>
                            <p id="modal_customer_phone"></p>
                        </div>
                        <div class="col-md-4">
                            <label for="Registration No" class="form-label">Entry Date</label>
                            <p id="modal_customer_date"></p>
                        </div>
                        <div class="col-md-12">
                            <label for="Registration No" class="form-label">Message</label>
                            <p id="modal_customer_message"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm rounded-0"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $(document).ready(function() {
        $("#query-datatables").DataTable({});
        $(document).on('click', '.view-query', function(e) {
            e.preventDefault();
            var name = $(this).data('name');
            var phone_no = $(this).data('phone_no');
            var email = $(this).data('email');
            var entry_date = $(this).data('date');
            var message = $(this).data('message');

            $('#modal_cutomer_name').text(name);
            $('#modal_customer_email').text(email);
            $('#modal_customer_phone').text(phone_no);
            $('#modal_customer_date').text(entry_date);
            $('#modal_customer_message').text(message);
            $('#queryDetailModal').modal('show')
            var id = $(this).data('id');
            var jsonData = JSON.stringify({
                'id': id,
                'type': 'query',
            });
            $.ajax({
                type: "POST",
                url: "{{ route('changeCustomerStatus') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: jsonData,
                cache: false,
                processData: false,
                contentType: 'application/json',
                // dataType: "json",
                // encode: true,
            }).done(function(data) {
                if (data.response == 'success') {

                }
            });
        })
        $("#basic-datatables").DataTable({});
        $(document).on("click", ".view", function(e) {
            e.preventDefault();
            var name = $(this).data('patient_name');
            var phone_no = $(this).data('phone_no');
            var age = $(this).data('age');
            var doctor_name = $(this).data('doctor_name');
            var appointment_date = $(this).data('appointment_date');
            var entry_date = $(this).data('entry_date');
            var address = $(this).data('address');
            var message = $(this).data('message');

            $('#modal_name').text(name);
            $('#modal_age').text(age);
            $('#modal_phone').text(phone_no);
            $('#modal_date').text(entry_date);
            $('#modal_appointment_date').text(appointment_date);
            $('#modal_address').text(address);
            $('#modal_message').text(message);
            $('#modal_doctor_name').text(doctor_name);
            $('#detailModal').modal('show')
            var id = $(this).data('id');
            var jsonData = JSON.stringify({
                'id': id,
                'type': 'appointment',
            });
            $.ajax({
                type: "POST",
                url: "{{ route('changeCustomerStatus') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: jsonData,
                cache: false,
                processData: false,
                contentType: 'application/json',
                // dataType: "json",
                // encode: true,
            }).done(function(data) {
                if (data.response == 'success') {

                }
            });

        });
    });
</script>
