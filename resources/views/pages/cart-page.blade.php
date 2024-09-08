@extends('layout.app')
@section('title','Cart Page')
@section('content')
@include('components.header')
@include('components.cart')
@include('components.footer')
<script>
        (async()=>{
                await category();
                await carts();
                $('.preloader').delay(50).fadeOut(50).addClass('loaded')
    
        })()
</script>
@endsection