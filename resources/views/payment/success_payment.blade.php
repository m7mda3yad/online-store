@extends('home_layout')
@section('content')

<style>
    .payment
    {
        border:1px solid rgb(0,209,178);
        height:280px;
        border-radius:20px;
        background:#fff;
    }
   .payment_header
   {
       background:rgb(0,209,178);
       padding:20px;
       border-radius:20px 20px 0px 0px;

   }

   .check
   {
       margin:0px auto;
       width:50px;
       height:50px;
       border-radius:100%;
       background:#fff;
       text-align:center;
   }

   .check i
   {
       vertical-align:middle;
       line-height:50px;
       font-size:30px;
   }

    .content
    {
        text-align:center;
    }


</style>
<div class="">
    <div class="row">
       <div class="col-md-6 mx-auto mt-5">
          <div class="payment">
             <div class="payment_header">
                <div class="check">
                <i class="fa fa-check-circle-o big" aria-hidden="true"></i></div>
             </div>
             <div class="content">
                <h1>Succesful Payment</h1>
                <br><br>
                <a href="#">check your profile</a>
             </div>

          </div>
       </div>
    </div>
 </div>

 @endsection

