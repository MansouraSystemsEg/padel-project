<x-front_layout title="Category's Products" >

    <x-slot:form_title> 
       {{$category->name}}
     </x-slot:form_title>
     
    <x-slot:breadcrumb>
            <li class="breadcrumb-item active">{{ $category->name }}</li>
    </x-slot:breadcrumb>

    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $products = $category->products()->latest()->paginate(5);
                @endphp
                    @forelse ($products as $product)
                <tr>
                    <td>
                        <img src="{{ $product->image_url }}"   alt="uploads/default-avatar.png" class="img-thumbnail rounded-circle shadow-sm" style="width: 70px; height: 70px;">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
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

</x-front_layout>
