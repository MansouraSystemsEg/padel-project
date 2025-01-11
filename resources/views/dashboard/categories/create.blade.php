<x-front_layout title="Cretate Category" >

<x-slot:form_title> 
    Create Category
 </x-slot:form_title>
 
<x-slot:breadcrumb>
        <li class="breadcrumb-item active">New Category</li>
</x-slot:breadcrumb>

    <div class="container">
        <form action="{{ route('dashboard.categories.store') }}" method="post" enctype="multipart/form-data">
            @csrf
          @include('dashboard.categories._form')          
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