@extends('layout.app')
@section('title', 'Home')
@section('content')
@include('components.header')
@include('components.banner')
@include('components.TopCategories')
@include('components.exclusiveProducts')
@include('components.TopBrands')
@include('components.facilities')
@include('components.newsletter')
@include('components.footer')

<script>
    (async()=>{
        await category();
        await Hero();
        await TopCategory();
        $('.preloader').delay(50).fadeOut(50).addClass('loaded')
        await popular();
        await newProduct();
        await topProduct();
        await specialProduct();
        await trendProduct();
        await regularProduct();
        await Brands();
    })()
</script>
@endsection