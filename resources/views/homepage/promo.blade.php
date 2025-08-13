@extends('layouts.main')

@section('title', 'Promo Toyota Signature')

@section('content')


<div class="max-w-5xl mx-auto py-12 px-4">
    <h1 class="text-3xl font-bold mb-6 text-center">
        PROMO BULAN {{ strtoupper(\Carbon\Carbon::now()->translatedFormat('F Y')) }}
    </h1>

    <div class="grid md:grid-cols-1 gap-8">
        <img src="{{ asset('images/brio.png') }}" alt="Promo 1" class="w-full h-auto rounded-lg">
        <img src="{{ asset('images/banner-honda-en1.jpg') }}" alt="Promo 2" class="w-full h-auto rounded-lg">
    </div>
</div>


@endsection
