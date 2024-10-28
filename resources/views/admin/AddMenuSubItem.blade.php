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
                        <a href="#">Add Sub Menu Item</a>
                    </li>
                </ul>
            </div>
        <div class="card">
        <div class="card-header">
                    <div class="card-title">Add Sub Menu Item</div>
                </div>
            <div class="card-body">
                <form id="batch_form" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label for="Registration No" class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="" disabled>Select</option>
                                @foreach($menu_item AS $item)
                                <option value="{{$item->id}}">{{$item->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="inputPassword5" class="form-label">Sub-Category Name</label>
                            <input type="text" id="inputPassword5" name="sub_item_name[]" class="form-control" aria-describedby="passwordHelpBlock" required>
                        </div>
                        <div class="col-md-12">
                            <label for="inputPassword5" class="form-label">Url</label>
                            <input type="text" id="inputPassword5" name="url[]" class="form-control" aria-describedby="passwordHelpBlock" required>
                        </div>
                        <!-- <div class="col-md-12">
                            <label for="inputPassword5" class="form-label">Image</label>
                            <input type="file" id="inputPassword5" name="image[]" class="form-control" aria-describedby="passwordHelpBlock">
                        </div> -->
                    </div>

                    <div id="newinput">
                    </div>
                    <div class="col-md-4 mt-3">
                        <button id="rowAdder" type="button" class="btn btn-dark btn-sm rounded-0">
                            <span class="bi bi-plus-square-dotted">
                            </span> ADD MORE
                        </button>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm rounded-0 mt-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
    </div>

</x-app-layout>
<script>
    $(document).on("submit", "#batch_form", function(e) {
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
            url: "{{route('AddMenuSubItem')}}",
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
    $("#rowAdder").click(function() {
        newRowAdd =
            '<div class="row" id="row">' +
            '<div class="col-md-12"><label for="inputPassword5" class="form-label">Category Name</label>' +
            '<input type="text" id="inputPassword5" name="sub_item_name[]" class="form-control" aria-describedby="passwordHelpBlock">' +
            '</div>' +
            '<div class="col-md-4"><button class="btn btn-danger mt-4 btn-sm rounded-0" id="DeleteRow" type="button"><i class="bi bi-trash"></i> Delete</button>' +
            '</div>' +
            '<div class="col-md-12">' +
            '<label for="inputPassword5" class="form-label">Url</label>' +
            '<input type="text" id="inputPassword5" name="url[]" class="form-control" aria-describedby="passwordHelpBlock">' +
            '</div>' +
            '<div class="col-md-12">' +
            // '<label for="inputPassword5" class="form-label">Image</label>' +
            // '<input type="file" id="inputPassword5" name="image[]" class="form-control" aria-describedby="passwordHelpBlock">' +
            '</div></div>';

        $('#newinput').append(newRowAdd);
    });

    $("body").on("click", "#DeleteRow", function() {
        $(this).parents("#row").remove();
    })
</script>