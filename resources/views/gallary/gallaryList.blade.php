<x-app-layout>
    <style>
        .image-area {
            position: relative;
            width: 50%;
            background: #333;
        }

        .image-area img {
            max-width: 100%;
            height: auto;
        }

        .remove-image {
            display: none;
            position: absolute;
            top: -10px;
            right: -10px;
            border-radius: 10em;
            padding: 2px 6px 3px;
            text-decoration: none;
            font: 700 21px/20px sans-serif;
            background: #555;
            border: 3px solid #fff;
            color: #FFF;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.5), inset 0 2px 4px rgba(0, 0, 0, 0.3);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
            -webkit-transition: background 0.5s;
            transition: background 0.5s;
        }

        .remove-image:hover {
            background: #E54E4E;
            padding: 3px 7px 5px;
            top: -11px;
            right: -11px;
        }

        .remove-image:active {
            background: #E54E4E;
            top: -10px;
            right: -11px;
        }

        .image-area .active {
            background-color: #E54E4E;
        }
    </style>

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
                        <a href="#">Gallary Lists</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6 text-start">
                        <h3>Gallary Lists</h3>
                    </div>
                    <div class="col-6 text-end">
                        <button class="btn btn-danger btn-sm rounded-0" id="delete">Delete Image</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row text-center g-3">
                    @foreach ($gallaryImage as $image)
                        <div class="col-md-3">
                            <div class="image-area">
                                <img src="{{ Storage::url($image->image) }}" alt="Preview">
                                <a class="remove-image select-{{ $image->id }}" href="{{ $image->id }}"
                                    style="display: inline;">&#215;</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $(document).ready(function() {
        var imageIdArray = [];
        $(document).on('click', '.remove-image', function(e) {
            e.preventDefault();
            let imageId = $(this).attr('href');
            if ($(`.select-${imageId}`).hasClass('active')) {
                let indexToRemove = imageIdArray.indexOf(parseInt(
                imageId)); // Find the index of the value
                if (indexToRemove !== -1) { // If the value exists in the array
                    imageIdArray.splice(indexToRemove, 1); // Remove 1 element at the found index
                }
                $(`.select-${imageId}`).removeClass('active');
            } else {
                imageIdArray.push(parseInt(imageId))
                $(`.select-${imageId}`).addClass('active');
            }
        });

        $(document).on('click', '#delete', function(e) {
            e.preventDefault();
            Swal.fire({
                title: "Do you sure want to delete the selected image?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Yes",
                denyButtonText: `No`
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    DeleteImage();

                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                }
            });
        })

        function DeleteImage() {
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

            var jsonData = JSON.stringify({
                'data': imageIdArray
            });

            $.ajax({
                type: "POST",
                url: "{{ route('destroyGallery') }}",
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
                    // var message = []
                    // $.each(data.error, function(index, value) {
                    //     $('#' + index + '_error').html(value)

                    // })
                    // $("#validation_message").html(message)
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
        }
    })
</script>
