@extends('layout.app')
@section('title','Wishlist Page')
@section('content')
@include('components.header')
@include('components.wishlist')
@include('components.footer')
<script>
        (async()=>{
                await category();
                await WishList();
                $('.preloader').delay(50).fadeOut(50).addClass('loaded')
    
        })()
</script>
@endsection