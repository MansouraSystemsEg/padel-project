
<div class="form-group">
    <x-form.input label='Name' type="text" name="name"  :value="$category->name"/>
</div>

<div class="form-group">
    <x-form.select label="Category Parent" name="parent_id" first_option="Category" :options="$parents->pluck('name' , 'id')" :selected="$category->parent_id"/>
</div>

<div class="form-group">
    <label for="description">Description</label>
    <x-form.textarea name="description" :value='$category->description'/>
</div>

<div class="form-group mb-3">
    <x-form.input label="Profile Picture" type="file" class="form-control" id="image" name="image" accept="image/*" onchange="previewImage(event)" />

    @if ($category->image)
        <img id="preview" src="{{ asset($category->image_url) }}" width="100" height="100" style="margin-top: 10px;">
    @else
        <img id="preview" src="#" alt="No Image Selected" style="display: none; margin-top: 10px;" width="100" height="100">
    @endif
</div>

<div class="form-group">
  <x-form.radio-check name="status" :checked="$category->status" :options="$status" />
</div>

<div class="form-group">
<button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save'}}</button>
</div>
