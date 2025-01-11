@extends('layouts.dashboard')

@section('title-page', $category->name)

@section('title', $category->name)

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">{{ $category->name }}</li>
@endsection

@section('content')
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Store</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                {{-- @if ($categories->count()) --}}
                @php
                    $products = $category->products()->with('store')->latest()->paginate(5);
                @endphp
                    @forelse ($products as $product)
                <tr>
                    <td><img src="{{ asset('uploads/' . $category->image) }}" height="100" alt=""></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->store->name }}</td>
                    <td>{{ $product->status }}</td>
                    <td>{{ $product->created_at }}</td>
                </tr>      
                @empty
                     <tr>
                        <td colspan="5"> No Product Define </td>
                    </tr>   
                @endforelse
                </tbody>
            </table>
        
        {{ $products->links() }}
        
    </div>
@endsection
