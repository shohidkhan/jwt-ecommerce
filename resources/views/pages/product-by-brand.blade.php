@extends('layout.app')
@section('title','Product By Brand')

@section('content')
@include('components.header')
@include('components.byBrandList')
@include('components.TopBrands')
@include('components.footer')

<script>
    (async()=>{
        await category();
        await ByBrand();
        $('.preloader').delay(50).fadeOut(50).addClass('loaded')
        await Brands();
    })()
</script>
@endsection