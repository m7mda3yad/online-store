@extends('layouts.customers_layout')
@section('header')
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Contact Us</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('index') }}">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Contact</p>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Contact For Any Queries</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col-lg-7 mb-5">
            <div class="contact-form">
                <div id="success"></div>
                <form action="{{ route('contacts.store') }}" method="POST">
                    @csrf
                    <div class="control-group">
                        <input type="text" class="form-control" name="name" placeholder="Your Name"required>
                        @error('name')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <br>
                    <div class="control-group">
                        <input type="email" class="form-control" name="email" placeholder="Your Email"required>
                        @error('email')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <br>
                    <div class="control-group">
                        <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                        @error('subject')<div class="text-danger">{{ $message }}</div> @enderror

                    </div>
                    <br>
                    <div class="control-group">
                        <textarea class="form-control" rows="6" name="message"  placeholder="Message"
                            required></textarea>
                        @error('message')<div class="text-danger">{{ $message }}</div> @enderror

                    </div>
                    <br>
                    <div>
                        <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-5 mb-5">
            <h5 class="font-weight-semi-bold mb-3">Get In Touch</h5>
            <p>Justo sed diam ut sed amet duo amet lorem amet stet sea ipsum, sed duo amet et. Est elitr dolor elitr erat sit sit. Dolor diam et erat clita ipsum justo sed.</p>
            <div class="d-flex flex-column mb-3">
                <h5 class="font-weight-semi-bold mb-3">Store 1</h5>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="d-flex flex-column">
                <h5 class="font-weight-semi-bold mb-3">Store 2</h5>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
        </div>
    </div>
</div>
@endsection
