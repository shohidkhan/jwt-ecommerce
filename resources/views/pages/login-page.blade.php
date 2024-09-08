@extends('layout.app')
@section('title','Login')
@section('content')
@include('components.header')
@include('components.login')
@include('components.footer')

<script>
    (async()=>{
        await category();
       
        $('.preloader').delay(50).fadeOut(50).addClass('loaded')
  
    })()
</script>
@endsection