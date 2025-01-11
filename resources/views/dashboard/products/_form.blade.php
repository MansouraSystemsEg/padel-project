
<div class="form-group">
    <x-form.input label='Product Name' type="text" name="name"  :value="$product->name"/>
</div>

<div class="form-group">
    <x-form.select label="Category Parent" name="category_id" first_option="Category" :options="$categories"  :selected="$product->category_id"/>
</div>

<div class="form-group">
    <label for="description">Description</label>
    <x-form.textarea name="description" :value='$product->description'/>
</div>

<div class="form-group">
        <x-form.input label="Profile Picture" type="file" class="form-control" id="image" name="image" accept="image/*" onchange="previewImage(event)" />
        @if ($product->image)
            <img id="preview" src="{{ asset($product->image_url) }}" width="100" height="100" style="margin-top: 10px;">
        @else
            <img id="preview" src="#" alt="No Image Selected" style="display: none; margin-top: 10px;" width="100" height="100">
        @endif
    </div>
    

<div class="form-group">
    <x-form.input label='Quantity' type="text" name="quantity"  :value="$product->quantity"/>
</div>
<div class="form-group">
    <x-form.input label='Price' type="text" name="price"  :value="$product->price"/>
</div>

<div class="form-group">
    <x-form.input label='Compare Price' type="text" name="compare_price"  :value="$product->compare_price"/>
</div>


<div class="form-group">
  <x-form.radio-check name="status" :checked="$product->status" :options="$status" />
</div>

<div class="form-group">
<button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save'}}</button>
</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/tagify.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/tagify.js') }}"></script>
    <script src="{{ asset('js/tagify.polyfills.min.js') }}"></script>
    <script>
        var inputElm = document.querySelector('[name=tags]'),
        tagify = new Tagify (inputElm);
    </script>
@endpush