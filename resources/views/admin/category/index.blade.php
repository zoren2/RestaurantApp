@extends('layouts.app')

@section('title', ' - Categories')

@section('content')
    <h1>Categories</h1>
    <div>
        <category-manager :initial-categories="{{$categories}}"></category-manager>
    </div>
@endsection