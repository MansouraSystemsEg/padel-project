@extends('layouts.dashboard')

@section('title-page', 'Categoies Page')

@section('title', 'All Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">NewCategory</li>
@endsection

@section('content')
    <div class="container">
        <form action="{{ route('dashboard.categories.store') }}" method="post" enctype="multipart/form-data">
            @csrf

          @include('dashboard.categories._form')
          
    </form>
    </div>
@endsection
