<x-app-layout>
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="{{ route('dashboard') }}">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Doctor Lists</a>
                    </li>
                </ul>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addSpecialist">
                            Add Doctor
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Doctor Lists</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="basic-datatables" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-center">#</th>
                                                    <th scope="col" class="text-center">department_name</th>
                                                    <th scope="col" class="text-center">doctor_name</th>
                                                    <th scope="col" class="text-center">doctor_image</th>
                                                    <th scope="col" class="text-center">descriptions</th>
                                                    <th scope="col" class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($allSpecilists as $index => $query)
                                                    <tr>
                                                        <th>{{ $index + 1 }}</th>
                                                        <td>{{ $query->department_name }}</td>
                                                        <td>
                                                            {{ $query->doctor_name }}

                                                            {{-- {{$query->get_specialist_lists}}
                                                            @foreach ($query['get_specialist_lists'] as $specialist)
                                                            <li>
                                                                <strong>{{ $specialist['header'] }}</strong>: {{ $specialist['specialist_detail'] }}
                                                            </li>
                                                        @endforeach --}}
                                                        </td>
                                                        <td>
                                                            <img src="{{ Storage::url($query->doctor_image) }}"
                                                                alt="Service Images" style="width: 10%" />
                                                        </td>
                                                        <td>{{ \Illuminate\Support\Str::limit($query->descriptions, $limit = 20, $end = '...') }}
                                                        </td>
                                                        <td><button class="btn btn-info btn-sm rounded-0 view"
                                                                data-specialist_id="{{ $query->id }}"
                                                                data-department_name="{{ $query->department_name }}"
                                                                data-doctor_name="{{ $query->doctor_name }}"
                                                                data-facebook_link="{{ $query->facebook_link }}"
                                                                data-instagram_link="{{ $query->instagram_link }}"
                                                                data-twitter_link="{{ $query->twitter_link }}"
                                                                data-linked_in_link="{{ $query->linked_in_link }}"
                                                                data-get_specialist_lists="{{ $query->get_specialist_lists }}">view</button>
                                                        </td>
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
        </div>
        {{-- =============================
         add specialist modal
         ============================= --}}
        <div class="modal fade" id="addSpecialist" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="serviceName">Add Doctor Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="SpecialistsForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-2">
                                <div class="col-md-12">
                                    <label for="department name" class="form-label">Department Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="department_name" name="department_name"
                                        class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label for="department name" class="form-label">Doctor Name<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="doctor_name" name="doctor_name" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label for="department name" class="form-label">Facebook Link</label>
                                    <input type="text" id="facebook_link" name="facebook_link" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label for="department name" class="form-label">Instagram Link</label>
                                    <input type="text" id="instagram_link" name="instagram_link"
                                        class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label for="department name" class="form-label">Twitter Link</label>
                                    <input type="text" id="twitter_link" name="twitter_link"
                                        class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label for="department name" class="form-label">LinkedIn Link</label>
                                    <input type="text" id="linked_in_link" name="linked_in_link"
                                        class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label for="department name" class="form-label">Doctor Image<span
                                            class="text-danger">*</span></label>
                                    <input type="file" id="doctor_image" name="doctor_image" class="form-control"
                                        accept="image/*">
                                </div>
                                <div class="col-md-12">
                                    <label for="department name" class="form-label">Description<span
                                            class="text-danger">*</span></label>
                                    <textarea name="descriptions" id="" class="form-control"></textarea>
                                </div>
                                <div id="newinput">
                                </div>
                                <div class="col-md-4 mt-3">
                                    <button id="rowRoleAdder" type="button" class="btn btn-dark btn-sm rounded-0">
                                        <span class="bi bi-plus-square-dotted">
                                        </span> ADD MORE DETAILS
                                    </button>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success btn-sm rounded-0 mt-2">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm rounded-0"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- ===================================
        specialist detail modal
        =================================== --}}
        <!-- Modal -->
        <div class="modal fade" id="detailModal" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="serviceName">Doctor Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <button type="button" class="btn btn-info btn-sm rounded-0" id="ediBtn">Edit</button>
                        <form action="" id="detailForm">
                            <div class="row text-center">
                                <div class="col-md-4">
                                    <label for="Registration No" class="form-label">Doctor Name</label>
                                    <input type="text" class="form-control" id="modal_doctor_name">
                                </div>
                                <div class="col-md-4">
                                    <label for="Registration No" class="form-label">department</label>
                                    <input type="text" class="form-control" id="modal_department_name">
                                </div>
                                <div class="col-md-4">
                                    <label for="Registration No" class="form-label">facebook_link</label>
                                    <input type="text" class="form-control" id="modal_facebook_link">
                                </div>
                                <div class="col-md-4">
                                    <label for="Registration No" class="form-label">modal_instagram_link</label>
                                    <input type="text" class="form-control" id="modal_instagram_link">
                                </div>
                                <div class="col-md-12">
                                    <label for="Registration No" class="form-label">twitter_link</label>
                                    <input type="text" class="form-control" id="modal_twitter_link">
                                </div>
                                <div class="col-md-12">
                                    <label for="Registration No" class="form-label">linked_in_link</label>
                                    <input type="text" class="form-control" id="modal_linked_in_link">
                                </div>
                                <div class="col-md-12">
                                    <label for="Registration No" class="form-label">get_specialist_lists</label>
                                    <p id="modal_get_specialist_lists"></p>
                                </div>
                            </div>
                            <div class="row" id="editDetails"></div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm rounded-0"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    $(document).ready(function() {
        $("#rowRoleAdder").click(function() {
            newRowAdd =
                '<div class="row mt-2" id="roleRow">' +
                '<label for="department name" class="form-label">Header<span class="text-danger">*</span></label>' +
                '<div class="col-md-12"><input type="text" id="inputPassword5" name="header[]" class="form-control">' +
                '<label for="department name" class="form-label">Details<span class="text-danger">*</span></label>' +
                '<div class="col-md-12"><input type="text" id="inputPassword5" name="specialist_detail[]" class="form-control">' +
                '<div class="col-md-4"><button class="btn btn-danger mt-4 btn-sm rounded-0" id="DeleteRoleRow" type="button"><i class="bi bi-trash"></i> Delete</button>' +
                '</div></div></div>';
            $('#newinput').append(newRowAdd);
        });

        $("body").on("click", "#DeleteRoleRow", function() {
            $(this).parents("#roleRow").remove();
        });

        $(document).on("submit", "#SpecialistsForm", function(e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('SubmitSpecialist') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                cache: false,
                processData: false,
                contentType: false
                // dataType: "json",
                // encode: true,
            }).done(function(data) {
                if (data.response == 'success') {
                    Swal.fire({
                            title: "Success",
                            text: data.message,
                            icon: "success",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willStore) => {
                            if (willStore) {
                                location.reload();
                            }
                        });
                }
                if (data.response == "validationFails") {
                    var message = []
                    $.each(data.error, function(index, value) {
                        $('#' + index + '_error').html(value)

                    })
                    $("#validation_message").html(message)
                }
                if (data.response == 'error') {
                    Swal.fire({
                        title: "Failed",
                        text: "Something Went Wrong",
                        icon: "error",
                        buttons: false,
                        dangerMode: true,
                    })
                }

            });
        });

        $("#basic-datatables").DataTable({});
        $(document).on('click', '.view', function(e) {
            e.preventDefault();
            var doctor_name = $(this).data('doctor_name');
            var department_name = $(this).data('department_name');
            var facebook_link = $(this).data('facebook_link');
            var instagram_link = $(this).data('instagram_link');
            var twitter_link = $(this).data('twitter_link');
            var linked_in_link = $(this).data('linked_in_link');
            var get_specialist_lists = $(this).data('get_specialist_lists');
            var specialist_id = $(this).data('specialist_id');

            $('#modal_doctor_name').val(doctor_name);
            $('#modal_department_name').val(department_name);
            $('#modal_facebook_link').val(facebook_link);
            $('#modal_instagram_link').val(instagram_link);
            $('#modal_twitter_link').val(twitter_link);
            $('#modal_linked_in_link').val(linked_in_link);
            $('#modal_get_specialist_lists').text(get_specialist_lists);

            $.ajax({
                url: "{{ route('SpecialistDetails') }}", // Replace with your route
                method: 'GET',
                data: {
                    'specialist_id': specialist_id
                },
                success: function(response) {
                    if (response.status == 'success') {
                        var div = document.getElementById('editDetails');

                        // Assuming response.specialistDetails is an array of items
                        response.specialistDetails.forEach(item => {
                            // Create a container div with the col-md-12 class
                            let colDiv = document.createElement('div');
                            colDiv.className = 'col-md-12';

                            // Create a label element
                            let label = document.createElement('label');
                            label.setAttribute('for', 'modal_linked_in_link');
                            label.className = 'form-label';
                            label.textContent = 'linked_in_link';

                            // Create an input field
                            let input = document.createElement('input');
                            input.type = 'text';
                            input.className = 'form-control';
                            input.id = 'modal_linked_in_link';
                            input.value = item.header;

                            // Append label and input to the colDiv
                            colDiv.appendChild(label);
                            colDiv.appendChild(input);

                            // Append the colDiv to the main div
                            div.appendChild(colDiv);
                        });
                      
                        // $('#appointmentForm :input').attr('disabled', 'disabled');
                        // Swal.fire({
                        //     title: "Thank You!",
                        //     text: "Message Sent Successfully",
                        //     icon: "success"
                        // });
                    }
                },
                error: function(xhr, status, error) {
                    // console.error(xhr.responseText);
                    Swal.fire({
                        title: "Validation Fail!",
                        text: "Please Enter Correct Data",
                        icon: "error"
                    });
                }
            });


            $('#detailModal').modal('show')
            $('#detailForm :input').attr('disabled', 'disabled');
        });
        $(document).on("click", "#ediBtn", function(e) {
            $('#detailForm :input').attr('disabled', false);
        });
        $('#appointmentForm').submit(function(e) {
            e.preventDefault(); // Prevent form submission

            // Serialize form data
            var formData = $(this).serialize();

            // Send AJAX request
            $.ajax({
                url: "{{ route('EditSpecialist') }}", // Replace with your route
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.status == 'success') {
                        $('#appointmentForm :input').attr('disabled', 'disabled');
                        Swal.fire({
                            title: "Thank You!",
                            text: "Message Sent Successfully",
                            icon: "success"
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // console.error(xhr.responseText);
                    Swal.fire({
                        title: "Validation Fail!",
                        text: "Please Enter Correct Data",
                        icon: "error"
                    });
                }
            });
        });
    });
</script>
