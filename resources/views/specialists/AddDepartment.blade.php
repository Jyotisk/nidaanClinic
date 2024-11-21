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
                        <a href="#">Department Lists</a>
                    </li>
                </ul>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addSpecialist">
                            Add Department
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Department Lists</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="basic-datatables" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-center">#</th>
                                                    <th scope="col" class="text-center">Department Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($departments as $index => $query)
                                                <tr>
                                                    <th>{{ $index + 1 }}</th>
                                                    <td>{{ $query->department_name }}</td>
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
         add department modal
         ============================= --}}
        <div class="modal fade" id="addSpecialist" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="serviceName">Add Department</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="departmentForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-2">
                                <div class="col-md-12">
                                    <label for="department name" class="form-label">Department Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="department_name" name="department_name"
                                        class="form-control">
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
    
    </div>

</x-app-layout>

<script>
    $(document).ready(function() {
        $(document).on("submit", "#departmentForm", function(e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('storeDepartment') }}",
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
    });
</script>