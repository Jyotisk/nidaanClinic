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
                        <a href="#">Add Testimonials</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3>Add Testimonials</h3>
            </div>
            <div class="card-body">
                <form id="testimonial_form" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-2">
                        <div class="col-md-12">
                            <label for="inputPassword5" class="form-label">Name</label>
                            <input type="text" id="inputPassword5" name="name" class="form-control" required>
                            <span class="text-warning" id="name_error"></span>
                        </div>                 
                        <div class="col-md-12">
                            <label for="inputPassword5" class="form-label">Profession</label>
                            <input type="text" id="inputPassword5" name="profession" class="form-control" required>
                            <span class="text-warning" id="profession_error"></span>
                        </div>               
                        <div class="col-md-12">
                            <label for="inputPassword5" class="form-label">Description</label>
                           <textarea name="description" id="" class="form-control" required></textarea>
                            <span class="text-warning" id="description_error"></span>
                        </div>                
                    </div>

                    <button type="submit" class="btn btn-success btn-sm rounded-0 mt-2">Submit</button>
                </form>
            </div>
        </div>
    </div>


</x-app-layout>
<script>
    $(document).ready(function() {
     
        $(document).on("submit", "#testimonial_form", function(e) {
            e.preventDefault();

            // Disable the submit button to prevent multiple submissions
            $('#submit_button').prop('disabled', true);

            let timerInterval;
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
                url: "{{ route('AddTestimonials') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                cache: false,
                processData: false,
                contentType: false
            }).done(function(data) {
                $('#submit_button').prop('disabled', false);
                if (data.response == 'success') {
                    Swal.fire({
                        title: "Success",
                        text: data.message,
                        icon: "success",
                        buttons: true,
                        dangerMode: true,
                    }).then((willStore) => {
                        if (willStore) {
                            // Redirect or perform other actions after success
                            location.reload();
                        }
                    });
                } else if (data.response == "validationFails") {
                    Swal.fire({
                        title: "Validation Error",
                        text: "Please Provide Valid Data",
                        icon: "error",
                        buttons: false,
                        dangerMode: true,
                    });
                } else {
                    // Handle other error scenarios here
                    Swal.fire({
                        title: "Failed",
                        text: "Something Went Wrong",
                        icon: "error",
                        buttons: false,
                        dangerMode: true,
                    });
                }
            })
        });
    });
</script>