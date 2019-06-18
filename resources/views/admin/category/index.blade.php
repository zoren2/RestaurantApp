@extends('layouts.app')

@section('title', ' - Categories')

@section('content')
    <h1>Categories</h1>
    <div>
        <category-manager :categories="{{$categories}}"></category-manager>
    </div>
    <div>
        <example-component></example-component>
    </div>
@endsection