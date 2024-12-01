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
                                                        <img src="{{ Storage::url($query->image) }}"
                                                            alt="Service Images" style="width: 10%" />
                                                    </td>
                                                    <td>{{ \Illuminate\Support\Str::limit($query->descriptions, $limit = 20, $end = '...') }}
                                                    </td>
                                                    <td><button class="btn btn-info btn-sm rounded-0 view"
                                                            data-facility_id="{{ $query->id }}"
                                                            data-facility_name="{{ $query->facility_name }}"
                                                            data-descriptions="{{ $query->descriptions }}">View</button>
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
                                </div>
                                <div class="col-md-12">
                                    <label for="Registration No" class="form-label">Speciality</label>
                                    <select name="department_id" id="department_id" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($departments AS $dept)
                                        <option value="{{$dept->id}}">{{$dept->department_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="facility name" class="form-label">Facility/Service Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="facility_name" name="facility_name" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label for="department name" class="form-label">Description<span
                                            class="text-danger">*</span></label>
                                    <textarea name="descriptions" id="" class="form-control"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="department name" class="form-label">Image<span
                                            class="text-danger">*</span></label>
                                    <input type="file" id="image" name="image" class="form-control"
                                        accept="image/*">
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
                        <button type="button" class="btn btn-info btn-sm rounded-0" id="ediBtn">Edit</button>
                        <form action="" id="editForm" method="post">
                            @csrf
                            <div class="row text-center">
                                <div class="col-md-12">
                                    <label for="facility name" class="form-label">Facility/Service Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="modal_facility_name" name="facility_name" class="form-control" disabled>
                                    <input type="hidden" id="facility_id" name="facility_id" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label for="department name" class="form-label">Description<span
                                            class="text-danger">*</span></label>
                                    <textarea name="descriptions" id="modal_descriptions" class="form-control" disabled></textarea>
                                </div>
                            </div>
                            <div class="row" id="editDetails"></div>
                            <button type="submit" class="btn btn-success btn-sm rounded-0 mt-4" id="editSubmitBtn" style="display: none;">Submit</button>
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

        $(document).on("submit", "#FacilityForm", function(e) {
            e.preventDefault();
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
                                "<input type='text' class='form-control' name='facility_detail[]' value='" + item.facility_detail + "' disabled>" +
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
        });
        $('#editForm').submit(function(e) {
            e.preventDefault(); // Prevent form submission

            // Serialize form data
            var formData = $(this).serialize();

            // Send AJAX request
            $.ajax({
                url: "{{ route('EditFacility') }}", // Replace with your route
                method: 'POST',
                data: formData,
                success: function(res) {
                    if (res.response == 'success') {
                        Swal.fire({
                                title: "Success",
                                text: res.message,
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
                    if (res.response == 'error') {
                        Swal.fire({
                            title: "Failed",
                            text: "Something Went Wrong",
                            icon: "error",
                            buttons: false,
                            dangerMode: true,
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
        });
    });
</script>