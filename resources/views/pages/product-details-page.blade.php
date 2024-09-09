@extends('layout.app')
@section('title','Product Details')
@section('content')
@include('components.header')
@include('components.productDetails')
@include('components.reviews')
@include('components.TopBrands')
@include('components.footer')

<script>
    (async()=>{
        await category();
        // await productDetails();
        await ProductDetails();
        await productReview();
        $('.preloader').delay(50).fadeOut(50).addClass('loaded')
        await Brands();
    })()
</script>
@endsection