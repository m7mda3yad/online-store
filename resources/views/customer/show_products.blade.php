@extends('layouts.customer_layout')
@section('content')
<div>
     <section class="product_section layout_padding">
        <div class="container">
            @livewire('show-products', ['SubCategoryId' => $SubCategoryId])
        </div>
     </section>
</div>
@endsection
