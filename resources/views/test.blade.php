@extends('layouts.app')

@section('content')


<div class="container mx-auto">
    <x-alert></x-alert>
    <div class="flex flex-wrap">
        {{-- @for ($i = 0; $i < 20; $i++) --}}
        <x-product-card class="w-1/3 p-2"></x-product-card>
        <x-product-card class="w-1/3 p-2"></x-product-card>
        <x-product-card class="w-1/3 p-2"></x-product-card>
        {{-- @endfor --}}
    </div>
    
    
</div>

@endsection