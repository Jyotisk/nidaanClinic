<x-guest-layout>
    <div style="margin-top: 144px;">
        <section class="page-header">
            <div class="container-fluid">
                <div class="page-header__inner">
                    <div class="page-header__bg" style="background-image: url('images/backgrounds/page-header-bg.jpg');"></div><!-- /.page-header__bg -->
                    <div class="container">
                        <div class="page-header__content">
                            <h2 class="page-header__title">Book an appointment</h2>
                            <ul class="mediox-breadcrumb list-unstyled">
                                <li>
                                    <span class="mediox-breadcrumb__icon"><i class="icon-home"></i></span>
                                    <a href="{{route('index')}}">Home</a>
                                </li>
                                <li><span>Book an Appointment</span></li>
                            </ul><!-- /.mediox-breadcrumb list-unstyled -->
                        </div><!-- /.page-header__content -->
                    </div><!-- /.container -->
                </div><!-- /.page-header__inner -->
            </div><!-- /.container-fluid -->
        </section><!-- /.page-header -->

        <section class="appointment-one appointment-one--page section-space-bottom">
            <div class="appointment-one__bg" style="background-image: url('images/backgrounds/appointment-bg.jpg');">
                <div class="appointment-one__bg__inner" style="background-image: url('images/shapes/appointment-shape-bg.png');"></div>
                <div class="appointment-one__bg__shape">
                    <div class="appointment-one__bg__shape__1">
                        <div class="appointment-one__bg__shape__2"></div><!-- /.appointment-one__bg__shape__2 -->
                    </div><!-- /.appointment-one__bg__shape__1 -->
                </div><!-- /.appointment-one__bg__shape -->
            </div><!-- /.appointment-one__bg -->
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="appointment-one__content">
                            <h3 class="appointment-one__title">Book An Appointment</h3><!-- /.appointment-one__title -->
                            <form class="appointment-one__form contact-form-validated form-one wow fadeInUp"
                            data-wow-duration="1500ms" id="appointmentForm" method="post">
                                @csrf
                                <div class="form-one__group">
                                    <div class="form-one__control">
                                        <input type="text" name="patient_name" placeholder="Full Name*" required>
                                    </div><!-- /.form-one__control -->
                                    <div class="form-one__control">
                                        <input type="text" name="age" placeholder="Age*" required>
                                    </div><!-- /.form-one__control -->
                                    <div class="form-one__control">
                                        <input type="tel" name="phone_no" placeholder="Phone Number*" Maxlength="10" required>
                                    </div><!-- /.form-one__control -->
                                    <div class="form-one__control">
                                        <select class="selectpicker" aria-label="Name a Doctor" name="specialist_id" required>
                                            <option selected>Name a Doctor*</option>
                                            @foreach($speciaLists AS $row)
                                            <option value="{{$row->id}}">{{ $row->doctor_name }}</option>
                                            @endforeach
                                        </select>
                                    </div><!-- /.form-one__control -->
                                    <div class="form-one__control appointment-one__form__date" required>
                                        <input type="text" name="appointment_date" placeholder="Appointment Date*"
                                            id="datepicker" class="mediox-datepicker">
                                        <span class="appointment-one__form__date__arrow">
                                            <i class="icon-caret-down"></i>
                                        </span><!-- /.appointment-one__form__date__arrow -->
                                    </div><!-- /.form-one__control -->
                                    <div class="form-one__control form-one__control--full">
                                        <textarea name="address" placeholder="Address*..." required></textarea>
                                    </div><!-- /.form-one__control -->                               
                                    <div class="form-one__control form-one__control--full">
                                        <textarea name="message" placeholder="Message (If Any)"></textarea>
                                    </div><!-- /.form-one__control -->
                                    <div class="form-one__control form-one__control--full">
                                        <button type="submit" class="mediox-btn">
                                        <span>book appointment</span>
                                        <span class="mediox-btn__icon"><i class="icon-up-right-arrow"></i></span>
                                        </button>
                                    </div><!-- /.form-one__control -->
                                </div><!-- /.form-one__group -->
                            </form><!-- /.form-one -->
                            <div class="result"></div><!-- /.result -->
                        </div><!-- /.appointment-one__content -->
                    </div><!-- /.col-xl-12 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
            <img src="{{asset('images/shapes/appointment-shape-1-1.png')}}" alt="shape" class="appointment-one__shape-1">
            <img src="{{asset('images/shapes/appointment-shape-1-2.png')}}" alt="shape" class="appointment-one__shape-2">
            <img src="{{asset('images/shapes/appointment-shape-1-3.png')}}" alt="shape" class="appointment-one__shape-3">
        </section><!-- /.appointment-one section-space-bottom -->
    </div>
</x-guest-layout>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#appointmentForm').submit(function(e) {
            e.preventDefault(); 
            
            var formData = $(this).serialize();

            $.ajax({
                url: "{{ route('BookAppointment') }}",
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.status == 'success') {
                        $('#appointmentForm :input').attr('disabled', 'disabled');
                        Swal.fire({
                            title: "Thank You!",
                            text: response.message,
                            icon: "success"
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: "Validation Fail!",
                        text: "Please Enter Correct Data",
                        icon: "error"
                    });
                }
            });
        });
    });
</script>