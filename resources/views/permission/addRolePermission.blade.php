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
                        <a href="#">Add Role And Permission</a>
                    </li>
                </ul>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add Role</div>
                </div>
                <div class="card-body">
                    <form id="roleForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-2">
                            <div class="col-md-12">
                                <input type="text" id="inputPassword5" name="role[]" class="form-control" multiple accept="image/*">
                            </div>
                            <div id="newinput">
                            </div>
                            <div class="col-md-4 mt-3">
                                <button id="rowRoleAdder" type="button" class="btn btn-dark btn-sm rounded-0">
                                    <span class="bi bi-plus-square-dotted">
                                    </span> ADD MORE
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success btn-sm rounded-0 mt-2">Submit</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add Permission</div>
                </div>
                <div class="card-body">
                    <form id="permissionForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-2">
                            <div class="col-md-12">
                                <input type="text" id="inputPassword5" name="permission[]" class="form-control" multiple accept="image/*">
                            </div>
                            <div id="newinputPermission">
                            </div>
                            <div class="col-md-4 mt-3">
                                <button id="permissionRoleAdder" type="button" class="btn btn-dark btn-sm rounded-0">
                                    <span class="bi bi-plus-square-dotted">
                                    </span> ADD MORE
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success btn-sm rounded-0 mt-2">Submit</button>
                    </form>
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
                '<div class="col-md-12"><input type="text" id="inputPassword5" name="role[]" class="form-control" multiple accept="image/*" required>' +
                '<div class="col-md-4"><button class="btn btn-danger mt-4 btn-sm rounded-0" id="DeleteRoleRow" type="button"><i class="bi bi-trash"></i> Delete</button>' +
                '</div></div></div>';

            $('#newinput').append(newRowAdd);
        });

        $("body").on("click", "#DeleteRoleRow", function() {
            $(this).parents("#roleRow").remove();
        });

        $("#permissionRoleAdder").click(function() {
            newRowAdd =
                '<div class="row mt-2" id="permissionRow">' +
                '<div class="col-md-12"><input type="text" id="inputPassword5" name="permission[]" class="form-control" multiple accept="image/*" required>' +
                '<div class="col-md-4"><button class="btn btn-danger mt-4 btn-sm rounded-0" id="DeletePermissionRow" type="button"><i class="bi bi-trash"></i> Delete</button>' +
                '</div></div></div>';

            $('#newinputPermission').append(newRowAdd);
        });

        $("body").on("click", "#DeletePermissionRow", function() {
            $(this).parents("#permissionRow").remove();
        });

        $(document).on("submit", "#roleForm", function(e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                type: "POST",
                url: "{{route('addRole')}}",
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
        $(document).on("submit", "#permissionForm", function(e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                type: "POST",
                url: "{{route('addPermission')}}",
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