@extends('layouts.customer_layout')
@section('content')
<div >

     <section class="">
        <div class="container">
            @livewire('show-product', ['product' => $product])
        </div>
     </section>
    </div>
    @endsection
