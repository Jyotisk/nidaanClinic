<x-app-layout>
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="{{route('dashboard')}}">
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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSpecialist">
                            Add Doctor
                        </button>
                    </div>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>

        <div class="modal fade" id="addSpecialist" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                    <label for="department name" class="form-label">Department Name <span class="text-danger">*</span></label>
                                    <input type="text" id="department_name" name="department_name" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label for="department name" class="form-label">Doctor Name<span class="text-danger">*</span></label>
                                    <input type="text" id="doctor_name" name="doctor_name" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label for="department name" class="form-label">Facebook Link</label>
                                    <input type="text" id="facebook_link" name="facebook_link" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label for="department name" class="form-label">Instagram Link</label>
                                    <input type="text" id="instagram_link" name="instagram_link" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label for="department name" class="form-label">Twitter Link</label>
                                    <input type="text" id="twitter_link" name="twitter_link" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label for="department name" class="form-label">LinkedIn Link</label>
                                    <input type="text" id="linked_in_link" name="linked_in_link" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label for="department name" class="form-label">Doctor Image<span class="text-danger">*</span></label>
                                    <input type="file" id="doctor_image" name="doctor_image" class="form-control" accept="image/*">
                                </div>
                                <div class="col-md-12">
                                    <label for="department name" class="form-label">Description<span class="text-danger">*</span></label>
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
                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
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
                url: "{{route('SubmitSpecialist')}}",
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

    });
</script>