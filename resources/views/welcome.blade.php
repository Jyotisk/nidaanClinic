<x-guest-layout>
    <h1>Base Project</h1>
    {{-- Contact Form --}}
    <!-- <section>
        <div class="contact-form">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="form-wrapper">
                            <div class="row ">
                                <div class="col-xl-12 col-lg-11 col-md-8 col-lg-7 col-sm-9">
                                    <div class="section-tittle mb-30">
                                        <h2>Get a Quote</h2>
                           
                                    </div>
                                </div>
                            </div>
                            <form id="contactForm" action="#" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 col-md-6">
                                        <div class="form-box user-icon mb-15">
                                            <input type="text" name="name" placeholder="Your Name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-6">
                                        <div class="form-box email-icon mb-15">
                                            <input type="email" name="email" placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-6">
                                        <div class="form-box email-icon mb-15">
                                            <input type="text" name="phone_no" placeholder="Phone no." Maxlength="10" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-6">
                                        <div class="form-box email-icon mb-15">
                                            <input type="text" name="subject" placeholder="Subject" Maxlength="10" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-box message-icon mb-15">
                                            <textarea name="message" id="message" placeholder="Message" required></textarea>
                                        </div>
                                        <div class="submit-info">
                                            <button class="submit-btn2" type="submit">Send Message</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-img">
                {{-- <img src="{{ asset('img/gallery/project-bg.jpg') }}" alt=""> --}}
                <img src="{{ asset('img/gallery/cesta-quote.JPG') }}" alt="">
            </div>
        </div>
    </section> -->
    {{-- End of Contact Form --}}
</x-guest-layout>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#contactForm').submit(function(e) {
            e.preventDefault(); // Prevent form submission

            // Serialize form data
            var formData = $(this).serialize();

            // Send AJAX request
            $.ajax({
                url: "{{ route('CustomerQuery') }}", // Replace with your route
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.status == 'success') {
                        $('#contactForm :input').attr('disabled', 'disabled');
                        Swal.fire({
                            title: "Thank You!",
                            text: "Message Sent Successfully",
                            icon: "success"
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // console.error(xhr.responseText);
                    Swal.fire({
                        title: "Validation Fail!",
                        text: "Please Enter Correct Data",
                        icon: "error"
                    });
                }
            });
        });
    });
</script> -->