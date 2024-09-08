@extends('layout.app')
@section('content')
@include('components.header')
@include('components.policyList')
@include('components.TopBrands')
@include('components.footer')

<script>
    (async()=>{
        await category();
        await policy();
        $('.preloader').delay(50).fadeOut(50).addClass('loaded')
        await Brands();
    })()
</script>
@endsection