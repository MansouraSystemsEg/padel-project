@extends('layouts.dashboard')

@section('title-page' , 'Trash Categoies ')

@section('title' , 'Trash Categories')

@section('breadcrumb')
    @parent
        <li class="breadcrumb-item ">Categories</li>
        <li class="breadcrumb-item active">Trash</li>
@endsection

@section('content')

<div class="mb-5">
    <a href="{{ route('dashboard.categories.index') }}" class="btn btn-sm btn-outline-primary ">Back</a>
</div>


    <x-flash-message/>

    <form action="{{ URL::current() }}" method="GET" class='d-flex justify-content-between'>

        <x-form.input name="name" placeholder="Name" class='mx-2' />
        <x-form.select name='status' :options='$status' class='form-control mx-2' first_option="All"/>
        <button class="btn btn-dark mx-2"> Filter </button>
    </form>

<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th>Deleted At</th>
            <th colspan="2"></th>
        </tr>
    </thead>
    <tbody>
        {{-- @if ($categories->count()) --}}
            @forelse ($categories as $category)
                
         
        <tr>
            <td><img src="{{ asset('uploads/' . $category->image) }}" height="100" alt=""></td>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->status }}</td>
            <td>{{ $category->deleted_at }}</td>
            <td>
                <form action="{{ route('dashboard.categories.restore' , $category->id) }}"  method="post">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-sm btn-outline-info">Restore </button>
                </form>
            </td>
            <td>
                <form action="{{ route('dashboard.categories.force-delete' , $category->id) }}"  method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-outline-danger"> Force Delete </button>
                </form>
            </td>
        </tr>      
        @empty
             <tr>
                <td colspan="7"> No Categories Define </td>
            </tr>   
        @endforelse
        </tbody>
    </table>

{{ $categories->withQueryString()->links() }}


@endsection