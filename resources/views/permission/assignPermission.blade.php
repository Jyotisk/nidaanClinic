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
                        <a href="#">Assign Permission</a>
                    </li>
                </ul>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Assign Permission</div>
                </div>
                <div class="card-body">
                    <form id="roleForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label for="inputPassword5" class="form-label">Role</label>
                                <select name="role" id="select_role" class="form-control">
                                    <option value="">Select Role</option>
                                    @foreach($role AS $row)
                                    <option value="{{$row->name}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mt-4" id="permissionList">
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
        $(document).on("submit", "#roleForm", function(e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                type: "POST",
                url: "{{route('AssignPermission')}}",
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
        $(document).on('change', '#select_role', function(e) {
            e.preventDefault();
            let id = $(this).val();
            $.ajax({
                type: "GET",
                url: `{{url('dashboard/ajax-permission-lists')}}/${id}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                processData: false,
                contentType: false
                // dataType: "json",
                // encode: true,
            }).done(function(data) {
                if (data.response == 'success') {
                    $('#permissionList').empty();
                    $.each(data.details, function(index, value) {
                        $('#permissionList')
                            .append(`<div class="form-check">
                                <input class="form-check-input" type="checkbox" value="${value.name}" id="flexCheckDefault" name="permission[]" ${value.status==true?"checked":" "}>
                                <label class="form-check-label" for="flexCheckDefault">
                                ${value.name}</label>
                                </div>`);
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
        });

    });
</script>