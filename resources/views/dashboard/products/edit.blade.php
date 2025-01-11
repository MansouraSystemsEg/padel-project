<x-front_layout title="Edit Product" >

<x-slot:form_title> 
    Edit Product
 </x-slot:form_title>
 
<x-slot:breadcrumb>
        <li class="breadcrumb-item active">Product</li>
        <li class="breadcrumb-item active">Edit Product</li>
</x-slot:breadcrumb>

    <div class="container">
        <form action="{{ route('dashboard.products.update' , $product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            
            @include('dashboard.products._form' , [
                'button_label' => 'Update'
                ])

        </form>
    </div>
    @push('scripts')
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');
            
            // التحقق من وجود صورة تم اختيارها
            if (input.files && input.files[0]) {
                const reader = new FileReader();
    
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';  // إظهار الصورة
                };
    
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    @endpush
</x-front_layout>
