<x-front_layout title="Categories" >

    <x-slot:form_title> 
         All Categories
     </x-slot:form_title>
     
    <x-slot:breadcrumb>
            <li class="breadcrumb-item active">New Category</li>
    </x-slot:breadcrumb>
    


<div class="mb-5">
    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
    {{-- <a href="{{ route('dashboard.categories.trash') }}" class="btn btn-sm btn-outline-dark">Trash</a> --}}
</div>


    <x-flash-message/>

    {{-- <form action="{{ URL::current() }}" method="GET" class='d-flex justify-content-between'>

        <x-form.input name="name" placeholder="Name" class='mx-2' id='name' :value="request('name')" />
        <x-form.select name='status' :options='$status' class='form-control mx-2' :selected="request('status')" first_option="All"/>
        <button class="btn btn-dark mx-2"> Filter </button>
    </form> --}}

<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Products #</th>
            <th>Status</th>
            <th>Created At</th>
            <th colspan="2"></th>
        </tr>
    </thead>
    <tbody>
        {{-- @if ($categories->count()) --}}
            @forelse ($categories as $category)
        
        <tr>
            <td>
                <img src="{{ $category->image_url }}"   alt="uploads/default-avatar.png" class="img-thumbnail rounded-circle shadow-sm" style="width: 70px; height: 70px;">
            </td>
            <td>{{ $category->id }}</td>
            <td><a href="{{ route('dashboard.categories.show' , $category->id) }}"> {{ $category->name }}</a></td>
            <td>{{ $category->parent->name }}</td>
            <td>{{ $category->products_count }}</td>
            <td>{{ $category->status }}</td>
            <td>{{ $category->created_at }}</td>
            <td>
                <a href="{{ route('dashboard.categories.edit' , $category->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
            </td>
            <td>
                <form action="{{ route('dashboard.categories.destroy' , $category->id) }}"  method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete </button>
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


</x-front_layout>