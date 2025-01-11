@extends('layouts.dashboard')

@section('title-page', 'Edit Profile')

@section('title', 'Edit Profile')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit Profile</li>
@endsection

@section('content')
    <div class="container">
        <form action="{{ route('dashboard.profile.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')

            @include('dashboard.profile._form')
    
          
        </form>
    </div>
    @endsection
