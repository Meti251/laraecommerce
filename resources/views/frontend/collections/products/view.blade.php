@extends('layouts.app')
@section('title')
{{$product->meta_title}}
@endsection()
@section('meta-keyword')
{{$product->meta_keyword}}
@endsection()
@section('meta-description')
{{$product->meta_description}}
@endsection()
@section('content')

<div>
    <livewire:frontend.product.view :category="$category" :product="$product"/>
</div>
@endsection()
