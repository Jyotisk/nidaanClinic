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
                        <a href="#">Facility Lists</a>
                    </li>
                </ul>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addSpecialist">
                            Add Facility/Service
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Facility/Service Lists</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="basic-datatables" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-center">#</th>
                                                    <th scope="col" class="text-center">Facility Name</th>
                                                    <th scope="col" class="text-center">Type</th>
                                                    <th scope="col" class="text-center">Image</th>
                                                    <th scope="col" class="text-center">Descriptions</th>
                                                    <th scope="col" class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($facilityLists as $index => $query)
                                                    <tr>
                                                        <th>{{ $index + 1 }}</th>
                                                        <td>{{ $query->facility_name }}</td>
                                                        <td>{{ $query->type }}</td>
                                                        <td>
                                                            <img src="{{ env('IMAGE_PATH') . Storage::url($query->image) }}"
                                                                alt="Service Images" style="width: 10%" />
                                                        </td>
                                                        <td>{{ \Illuminate\Support\Str::limit($query->descriptions, $limit = 20, $end = '...') }}
                                                        </td>
                                                        <td><button class="btn btn-info btn-sm rounded-0 view"
                                                                data-facility_id="{{ $query->id }}"
                                                                data-facility_name="{{ $query->facility_name }}"
                                                                data-descriptions="{{ $query->descriptions }}">View</button>
                                                            <a href="{{ $query->id }}"
                                                                data-status="{{ $query->status }}"
                                                                class="btn-sm rounded-0 change-status {{ $query->status == true ? 'btn btn-success' : 'btn btn-danger' }}">
                                                                {{ $query->status == true ? 'true' : 'false' }}
                                                            </a>
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
                        <h5 class="modal-title" id="serviceName">Add Facility Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="text-danger mb-4">To get a better view of the website's resolution of the image, it
                            should be 370*398 px.</span>
                        <form id="FacilityForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-2">
                                <div class="col-md-12">
                                    <label for="Registration No" class="form-label">Category</label>
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="service">Service</option>
                                        <option value="speciality">Speciality</option>
                                    </select>
                                    <span id="type_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-12">
                                    <label for="Registration No" class="form-label">Speciality</label>
                                    <select name="department_id" id="department_id" class="form-control">
                                        <option value="">Select</option>
                                        @foreach ($departments as $dept)
                                            <option value="{{ $dept->id }}">{{ $dept->department_name }}</option>
                                        @endforeach
                                    </select>
                                    <span id="department_id_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-12">
                                    <label for="facility name" class="form-label">Facility/Service Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="facility_name" name="facility_name" class="form-control">
                                    <span id="facility_name_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-12">
                                    <label for="department name" class="form-label">Description<span
                                            class="text-danger">*</span></label>
                                    <textarea name="descriptions" id="" class="form-control"></textarea>
                                    <span id="descriptions_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-12">
                                    <label for="department name" class="form-label">Image<span
                                            class="text-danger">*</span></label>
                                    <input type="file" id="image" name="image" class="form-control"
                                        accept="image/*">
                                    <span id="image_error" class="text-danger"></span>
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
                        <h5 class="modal-title" id="serviceName">Facility/Service Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="text-danger mb-4">To get a better view of the website's resolution of the image,
                            it
                            should be 370*398 px.</span>
                        <button type="button" class="btn btn-info btn-sm rounded-0" id="ediBtn">Edit</button>
                        <form action="" id="editForm" method="post">
                            @csrf
                            <div class="row text-center">
                                <div class="col-md-12">
                                    <label for="facility name" class="form-label">Facility/Service Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="modal_facility_name" name="facility_name"
                                        class="form-control" disabled>
                                    <span id="facility_name_edit_error" class="text-danger"></span>
                                    <input type="hidden" id="facility_id" name="facility_id" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label for="department name" class="form-label">Image<span
                                            class="text-danger">*</span></label>
                                    <input type="file" id="image" name="image" class="form-control"
                                        accept="image/*">
                                    <span id="image_edit_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-12">
                                    <label for="department name" class="form-label">Description<span
                                            class="text-danger">*</span></label>
                                    <textarea name="descriptions" id="modal_descriptions" class="form-control" disabled></textarea>
                                    <span id="descriptions_edit_error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="row" id="editDetails"></div>
                            <div id="newEditinput">
                            </div>
                            <div class="col-md-12 text-left" style="display: none;" id="editMore">
                                <button id="rowEditAdder" type="button"
                                    class="btn btn-dark btn-sm rounded-0 mt-2">
                                    <span class="bi bi-plus-square-dotted">
                                    </span> ADD MORE DETAILS
                                </button>
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
                '<label for="department name" class="form-label">Facility Detail<span class="text-danger">*</span></label>' +
                '<div class="col-md-12"><input type="text" id="inputPassword5" name="facility_detail[]" class="form-control">' +
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
                '<label for="department name" class="form-label">Facility Detail<span class="text-danger">*</span></label>' +
                '<div class="col-md-12"><input type="text" id="inputPassword5" name="facility_detail[]" class="form-control">' +
                '<div class="col-md-4"><button class="btn btn-danger mt-4 btn-sm rounded-0" id="DeleteEditRow" type="button"><i class="bi bi-trash"></i> Delete</button>' +
                '</div></div></div>';
            $('#newEditinput').append(newRowAdd);
        });
        $("body").on("click", "#DeleteEditRow", function() {
            $(this).parents("#roleRow").remove();
        });

        $(document).on("submit", "#FacilityForm", function(e) {
            e.preventDefault();
            Swal.fire({
                title: "Loading ...",
                html: "Uploading In progress",
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            });
            var formData = new FormData($(this)[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('SubmitFacility') }}",
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
                                location.reload(true);
                            }
                        });
                }
                if (data.response == "validationFails") {
                    Swal.fire({
                        title: "Failed",
                        text: "Validation error",
                        icon: "error",
                        buttons: false,
                        dangerMode: true,
                    })
                    var message = []
                    $.each(data.error, function(index, value) {
                        $('#' + index + '_error').html(value)

                    })
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
            var facility_id = $(this).data('facility_id');
            var facility_name = $(this).data('facility_name');
            var descriptions = $(this).data('descriptions');

            $('#facility_id').val(facility_id);
            $('#modal_facility_name').val(facility_name);
            $('#modal_descriptions').text(descriptions);

            $.ajax({
                url: "{{ route('FacilityDetails') }}", // Replace with your route
                method: 'GET',
                data: {
                    'facility_id': facility_id
                },
                success: function(response) {
                    if (response.status == 'success') {
                        var div = document.getElementById('editDetails');

                        response.facilityDetails.forEach(item => {

                            var tempDiv = "<div class='col-md-12 mt-2'>" +
                                "<label for='Registration No' class='form-label'>Details</label>" +
                                "<input type='text' class='form-control' name='facility_detail[]' value='" +
                                item.facility_detail + "' disabled>" +
                                "  </div>"
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
            Swal.fire({
                title: "Loading ...",
                html: "Uploading In progress",
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            });
            var formData = new FormData($(this)[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('EditFacility') }}",
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
                                location.reload(true);

                            }
                        });
                }
                if (data.response == "validationFails") {
                    Swal.fire({
                        title: "Failed",
                        text: "Validation error",
                        icon: "error",
                        buttons: false,
                        dangerMode: true,
                    })
                    var message = []
                    $.each(data.error, function(index, value) {
                        $('#' + index + '_edit_error').html(value)
                    })
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
        $(document).on('click', '.change-status', function(e) {
            e.preventDefault();
            var id = $(this).attr('href')
            var status = $(this).data('status');
            Swal.fire({
                title: `Do you sure want ${status==true?'close':'open'} facility status ?`,
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Yes",
                denyButtonText: `No`
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var jsonData = JSON.stringify({
                        'id': id,
                        'type': 'facility',
                        'status': status,
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('changeStatus') }}",
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
                            Swal.fire({
                                    title: "Success",
                                    text: data.message,
                                    icon: "success",
                                    buttons: true,
                                    dangerMode: true,
                                })
                                .then((willStore) => {
                                    if (willStore) {
                                        location.reload(true);
                                    }
                                });
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
                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                }
            });
        })
    });
</script>
