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
                        <a href="#">Edit Sub Menu Item</a>
                    </li>
                </ul>
            </div>
            <div class="card">
            <div class="card-header">
                    <div class="card-title">Edit Sub Menu Item</div>
                </div>
                <div class="card-body">
                    <form id="menuForm">
                        @csrf
                        <div class="row g-2">
                            <div class="col-md-4">
                                <label for="Registration No" class="form-label">Category</label>
                                <select name="category" id="category" class="form-control" required>
                                    <option value="">Select Category</option>
                                    @foreach($menu_item AS $item)
                                    <option value="{{$item->id}}">{{$item->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="Registration No" class="form-label">Sub Category</label>
                                <select id="subcategory" name="subcategory" class="form-control" required>
                                    <option value="">Select Subcategory</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="inputPassword5" class="form-label">Menu Category Name</label>
                                <input type="hidden" id="menu_id" name="menu_id" class="form-control" aria-describedby="passwordHelpBlock" required>
                                <input type="text" id="title" name="title" class="form-control" aria-describedby="passwordHelpBlock" required>
                            </div>
                            <div class="col-md-12">
                                <label for="inputPassword5" class="form-label">Url</label>
                                <input type="text" id="url" name="url" class="form-control" aria-describedby="passwordHelpBlock" required>
                            </div>
                            <!-- <div class="col-md-12">
                                <label for="inputPassword5" class="form-label">Image</label>
                                <p id="imageView"></p>
                                <input type="file" id="image" name="image" class="form-control" aria-describedby="passwordHelpBlock" required>
                            </div> -->
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
        $('#category').change(function() {
            var parent_id = $(this).val();
            $.ajax({
                url: "{{ route('getDropdownData') }}",
                type: 'GET',
                data: {
                    parent_id: parent_id
                },
                success: function(response) {
                    var subcategories = response.subcategories;
                    $('#subcategory').empty();
                    $('#subcategory').append('<option value="">Select Subcategory</option>');
                    $.each(subcategories, function(key, value) {
                        $('#subcategory').append('<option value="' + value.id + '">' + value.title + '</option>');
                    });
                }
            });
        });
        $('#subcategory').change(function() {
            var menu_id = $(this).val();
            $.ajax({
                url: "{{ route('getMeuSubItmDetail') }}",
                type: 'GET',
                data: {
                    menu_id: menu_id
                },
                success: function(response) {
                    if (response.response == 'success') {
                        // $('#imageView').empty();
                        let menuDetail = response.menuDetail;
                        $('#menu_id').val(menuDetail.id);
                        $('#title').val(menuDetail.title);
                        $('#url').val(menuDetail.url);
                        // $('#imageView').append(`<img src="/storage/${menuDetail.image}" alt="Service Images" style="width:100%;>`);

                    }

                }
            });
        });
        $(document).on("submit", "#menuForm", function(e) {
            e.preventDefault();
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
                url: "{{route('EditMenuItem')}}",
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
                    Swal.fire({
                        title: "Failed",
                        text: "Validation error",
                        icon: "error",
                        buttons: false,
                        dangerMode: true,
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
    });
</script>