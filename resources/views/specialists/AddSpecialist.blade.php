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
                                                    <th scope="col" class="text-center">Department Name</th>
                                                    <th scope="col" class="text-center">Doctor Name</th>
                                                    <th scope="col" class="text-center">Doctor Image</th>
                                                    <th scope="col" class="text-center">Descriptions</th>
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
                                                    </td>
                                                    <td>
                                                        <img src="{{ Storage::url($query->doctor_image) }}"
                                                            alt="Service Images" style="width: 10%" />
                                                    </td>
                                                    <td>{{ \Illuminate\Support\Str::limit($query->descriptions, $limit = 20, $end = '...') }}
                                                    </td>
                                                    <td><button class="btn btn-info btn-sm rounded-0 view"
                                                            data-specialist_id="{{ $query->id }}"
                                                            data-doctor_image="{{ $query->doctor_image }}"
                                                            data-department_name="{{ $query->department_name }}"
                                                            data-doctor_name="{{ $query->doctor_name }}"
                                                            data-facebook_link="{{ $query->facebook_link }}"
                                                            data-instagram_link="{{ $query->instagram_link }}"
                                                            data-twitter_link="{{ $query->twitter_link }}"
                                                            data-linked_in_link="{{ $query->linked_in_link }}"
                                                            data-descriptions="{{ $query->descriptions }}">view</button>
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
                                    <select name="department_name" id="" class="form-control" require>
                                        <option value="">Select Department</option>
                                        @foreach ($departments as $dep)
                                        <option value="{{ $dep->id }}">{{ $dep->department_name }}</option>
                                        @endforeach
                                    </select>
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
                        <button type="button" class="btn btn-info btn-sm rounded-0 text-end"
                            id="ediBtn">Edit</button>
                        <form id="editForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row text-center">
                                <div class="col-md-4">
                                    <label for="Registration No" class="form-label">Doctor Name</label>
                                    <input type="text" class="form-control" id="modal_doctor_name"
                                        name="doctor_name">
                                    <input type="hidden" class="form-control" id="specialist_id"
                                        name="specialist_id">
                                </div>
                                <div class="col-md-4">
                                    <label for="Registration No" class="form-label">Department Name</label>
                                    <p id="modal_department_name"></p>
                                </div>
                                <div class="col-md-4">
                                    <label for="Registration No" class="form-label">Facebook Link</label>
                                    <input type="text" class="form-control" id="modal_facebook_link"
                                        name="facebook_link">
                                </div>
                                <div class="col-md-4">
                                    <label for="Registration No" class="form-label">Instagram Link</label>
                                    <input type="text" class="form-control" id="modal_instagram_link"
                                        name="instagram_link">
                                </div>
                                <div class="col-md-12">
                                    <label for="Registration No" class="form-label">Twitter Link</label>
                                    <input type="text" class="form-control" id="modal_twitter_link"
                                        name="twitter_link">
                                </div>
                                <div class="col-md-12">
                                    <label for="Registration No" class="form-label">LinkedIn Link</label>
                                    <input type="text" class="form-control" id="modal_linked_in_link"
                                        name="linked_in_link">
                                </div>
                                <div class="col-md-12">
                                    <label for="department name" class="form-label">Doctor Image</label>
                                <input type="file" id="doctor_image_1" name="doctor_image" class="form-control"
                                    accept="image/*">
                                <span id="doctor_image_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-12">
                                    <label for="department name" class="form-label">Description<span
                                            class="text-danger">*</span></label>
                                    <textarea name="descriptions" id="modal_descriptions" class="form-control" cols="20"></textarea>
                                </div>
                                <div id="editDetails"></div>
                                <div id="newEditinput">
                                </div>
                                <div class="col-md-12 text-left" style="display: none;" id="editMore">
                                    <button id="rowEditAdder" type="button" class="btn btn-dark btn-sm rounded-0 mt-2">
                                        <span class="bi bi-plus-square-dotted">
                                        </span> ADD MORE DETAILS
                                    </button>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm rounded-0 mt-4" id="editSubmitBtn"
                                style="display: none;">Submit</button>
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
        $("#rowEditAdder").click(function() {
            newRowAdd =
                '<div class="row mt-2" id="roleRow">' +
                '<label for="department name" class="form-label">Header<span class="text-danger">*</span></label>' +
                '<div class="col-md-12"><input type="text" id="inputPassword5" name="header[]" class="form-control">' +
                '<label for="department name" class="form-label">Details<span class="text-danger">*</span></label>' +
                '<div class="col-md-12"><input type="text" id="inputPassword5" name="specialist_detail[]" class="form-control">' +
                '<div class="col-md-4"><button class="btn btn-danger mt-4 btn-sm rounded-0" id="DeleteEditRow" type="button"><i class="bi bi-trash"></i> Delete</button>' +
                '</div></div></div>';
            $('#newEditinput').append(newRowAdd);
        });
        $("body").on("click", "#DeleteEditRow", function() {
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
            var descriptions = $(this).data('descriptions');
            var specialist_id = $(this).data('specialist_id');

            $('#specialist_id').val(specialist_id);
            $('#modal_doctor_name').val(doctor_name);
            $('#modal_department_name').html(department_name);
            $('#modal_facebook_link').val(facebook_link);
            $('#modal_instagram_link').val(instagram_link);
            $('#modal_twitter_link').val(twitter_link);
            $('#modal_linked_in_link').val(linked_in_link);
            $('#modal_descriptions').text(descriptions);

            $.ajax({
                url: "{{ route('SpecialistDetails') }}", // Replace with your route
                method: 'GET',
                data: {
                    'specialist_id': specialist_id
                },
                success: function(response) {
                    if (response.status == 'success') {
                        $('#editDetails').empty();
                        var div = document.getElementById('editDetails');

                        response.specialistDetails.forEach(item => {
                            var tempDiv = "<div class='col-md-12 mt-2'>" +
                                "<label for='Registration No' class='form-label'>Header</label>" +
                                "<input type='text' class='form-control' name='header[]' value='" +
                                item.header + "' disabled>" +
                                "  </div>" +
                                " <div class='col-md-12'>" +
                                " <label for='Registration No' class='form-label'>Details</label>" +
                                "<input type='text' class='form-control' name='specialist_detail[]' value='" +
                                item.specialist_detail + "' disabled>" +
                                "</div>"
                            // div.append(tempDiv)
                            $('#editDetails').append(tempDiv);
                        })
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
            $('#editForm :input').attr('disabled', 'disabled');
        });
        $(document).on("click", "#ediBtn", function(e) {
            $('#editForm :input').attr('disabled', false);
            $("#editSubmitBtn").css("display", "block");
            $("#editMore").css("display", "block");
        });
        $('#editForm').submit(function(e) {
            e.preventDefault(); 
            var formData = new FormData($(this)[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('EditSpecialist') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                cache: false,
                processData: false,
                contentType: false
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
    });
</script>