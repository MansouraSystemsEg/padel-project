<x-front_layout title="Products" >

    <x-slot:form_title> 
         All Products
     </x-slot:form_title>
     
    <x-slot:breadcrumb>
            <li class="breadcrumb-item active">New Product</li>
    </x-slot:breadcrumb>


<div class="mb-5">
    <a href="{{ route('dashboard.products.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
</div>


    <x-flash-message/>

    {{-- <form action="{{ URL::current() }}" method="GET" class='d-flex justify-content-between'>

        <x-form.input name="name" placeholder="Name" class='mx-2' :value="request('name')"/>
        <x-form.select name='status' :options='$status' class='form-control mx-2' first_option="All"/> 
        <button class="btn btn-dark mx-2"> Filter </button>
    </form> --}}

<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Status</th>
            <th>Created At</th>
            <th colspan="2"></th>
        </tr>
    </thead>
    <tbody>
        {{-- @if ($products->count()) --}}
            @forelse ($products as $product)
                
         
        <tr>
            <td>
                <img src="{{ $product->image_url }}"   alt="uploads/default-avatar.png" class="img-thumbnail rounded-circle shadow-sm" style="width: 70px; height: 70px;">
            </td>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name}}</td>
            <td>{{ $product->status }}</td>
            <td>{{ $product->created_at }}</td>
            <td>
                <a href="{{ route('dashboard.products.edit' , $product->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
            </td>
            <td>
                <form action="{{ route('dashboard.products.destroy' , $product->id) }}"  method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete </button>
                </form>
            </td>
        </tr>      
        @empty
             <tr>
                <td colspan="7"> No Products Define </td>
            </tr>   
        @endforelse
        </tbody>
    </table>

{{ $products->withQueryString()->links() }}

</x-front_layout>