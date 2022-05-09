@extends('layouts.customer_layout')

@section('content')
 <section class="why_section layout_padding">
    <div class="container">
       <div class="row">
          <div class="col-lg-8 offset-lg-2">
             <div class="full">
                <form action="{{ route('contacts.store') }}" method="POST">
                    @csrf
                   <fieldset>
                      <input type="text" placeholder="Enter your full name" name="name" required />
                      @error('name')<div class="text-danger">{{ $message }}</div> @enderror
                      <input type="email" placeholder="Enter your email address" name="email" required />
                      @error('email')<div class="text-danger">{{ $message }}</div> @enderror
                      <input type="text" placeholder="Enter subject" name="subject" required />
                      @error('subject')<div class="text-danger">{{ $message }}</div> @enderror
                      <textarea placeholder="Enter your message" name="message"required></textarea>
                      @error('name')<div class="text-danger">{{ $message }}</div> @enderror
                      <input type="submit" value="Submit" />
                   </fieldset>
                </form>
             </div>
          </div>
       </div>
    </div>
 </section>

 @endsection
