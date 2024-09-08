@extends('layout.app')
@section('title','Verify')
@section('content')
@include('components.header')
@include('components.verification')
@include('components.footer')
<script>
        (async()=>{
                await category();
                $('.preloader').delay(50).fadeOut(50).addClass('loaded')
    
        })()
</script>
@endsection