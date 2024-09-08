@extends('layout.app')
@section('title','Product By Category')
@section('content')
@include('components.header')
@include('components.byCategoryList')
@include('components.topBrands')
@include('components.footer')
<script>
    (async () => {
         await category();
        await ByCategory();
        $(".preloader").delay(90).fadeOut(100).addClass('loaded');

        await Brands();
    })()
</script>
@endsection