<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3>Admin Dashboard</h3>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5>Total Visitor</h5>
                            </div>
                            <div class="card-body">
                                {{ $totaVisitor }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5>Unique Visitor</h5>
                            </div>
                            <div class="card-body">
                                {{ $totaUniqueVisitor }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5>Todays Visitor</h5>
                            </div>
                            <div class="card-body">
                                {{ $todaysVisitor }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row text-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Customer Queries</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="customerQueryTable">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center">#</th>
                                                <th scope="col" class="text-center">Name</th>
                                                <th scope="col" class="text-center">Email</th>
                                                <th scope="col" class="text-center">Phone No</th>
                                                <th scope="col" class="text-center">Date</th>
                                                <th scope="col" class="text-center">Message</th>
                                                <th scope="col" class="text-center">Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($customer_query AS $index=>$query)
                                            <tr>
                                                <th scope="row">{{$index+1}}</th>
                                                <td>{{$query->name}}</td>
                                                <td>{{$query->email}}</td>
                                                <td>{{$query->phone_no}}</td>
                                                <td>{{$query->date}}</td>
                                                <td>{{ \Illuminate\Support\Str::limit($query->message, $limit = 20, $end = '...') }}</td>
                                                <td ><button class="btn btn-info btn-sm rounded-0 view"  data-name="{{$query->name}}" data-email="{{$query->email}}" data-phone="{{$query->phone_no}}" data-date="{{$query->date}}" data-message="{{$query->message}}">view</button></td>
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

         <!-- Modal -->
    <div class="modal fade" id="detailModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceName">Customer Query Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div class="row text-center">
                            <div class="col-md-4">
                                <label for="Registration No" class="form-label">Name</label>
                                <p id="modal_name"></p>
                            </div>
                            <div class="col-md-4">
                                <label for="Registration No" class="form-label">Email</label>
                                <p id="modal_email"></p>
                            </div>
                            <div class="col-md-4">
                                <label for="Registration No" class="form-label">Phone No</label>
                                <p id="modal_phone"></p>
                            </div>
                            <div class="col-md-4">
                                <label for="Registration No" class="form-label">Date</label>
                                <p id="modal_date"></p>
                            </div>
                            <div class="col-md-12">
                                <label for="Registration No" class="form-label">Message</label>
                                <p id="modal_message"></p>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
<script>
    $(document).ready(function(){
        let table = new DataTable('#customerQueryTable');
       
        $(document).on('click','.view',function(e){
            e.preventDefault();
            var name = $(this).data('name');
            var email = $(this).data('email');
            var phone = $(this).data('phone');
            var date = $(this).data('date');
            var message = $(this).data('message');

            $('#modal_name').text(name);
            $('#modal_email').text(email);
            $('#modal_phone').text(phone);
            $('#modal_date').text(date);
            $('#modal_message').text(message);
            $('#detailModal').modal('show')
        })
    })
</script>