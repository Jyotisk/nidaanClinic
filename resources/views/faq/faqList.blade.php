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
                        <a href="#">Faq Lists</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3>Faq Lists</h3>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table" id="faqTable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">Question</th>
                                        <th scope="col" class="text-center">Answer</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($faqLists AS $index=>$query)
                                    <tr>
                                        <th scope="row">{{$index+1}}</th>
                                        <td>{{$query->question}}</td>
                                        <td>{{$query->answer}}</td>
                                        <td>
                                            @if($query->status==true)
                                            <a href="{{ $query->id }}" id="status" class="btn btn-danger btn-sm rounded-0" data-status="{{$query->status}}">Close</a>
                                        </td>
                                        @else
                                        <a href="{{ $query->id }}" id="status" class="btn btn-success btn-sm rounded-0" data-status="{{$query->status}}">Open</a> </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</x-app-layout>
<script>
    $(document).ready(function() {
        $("#faqTable").DataTable({});

        $(document).on('click', '#status', function(e) {
            e.preventDefault();
            var id = $(this).attr('href')
            var status = $(this).data('status');

            Swal.fire({
                title: `Do you sure want ${status==true?'Publish':'Close'} Faq?`,
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Yes",
                denyButtonText: `No`
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var jsonData = JSON.stringify({
                        'data': id
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('closeFaq') }}",
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
    })
</script>