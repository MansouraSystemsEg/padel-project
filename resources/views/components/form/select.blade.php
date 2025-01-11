@props([
   'name', 'options'=>[] , 'selected'=>'', 'first_option' , 'label'=>false
    ])
@if ($label)
    <label for="name">{{ $label }}</label>
@endif
<select class="form-control" name="{{$name}}">
    <option value=""> {{ $first_option }}</option>
        @foreach ($options as $value => $text)
            <option value="{{ $value }}" 
            @selected(old($name , $selected) == $value)> {{ $text }}</option>
        @endforeach
</select>
{{-- 
  @props(['id'=>'' , 'label'=>'' , 'name' ,'options' => [] , 'selected'=>''])

@if (@isset($label))  
<label for="{{ $id }}">{{ $label }}</label>
@endif
  <select  
  name="{{ $name }}" 
  id="{{ $id }}" 
  {{ $attributes->class
  (['form-control', 'is-invalid'=>$errors->has($name)]) }}
  >
      <option></option>

     @foreach ($options as $value => $text)
      <option value="{{ $value }}" @if($value == old($name , $selected)) selected @endif> 
              {{ $text}} </option>
    @endforeach
      
  </select>
  @error('$name')
  <p class="invalid-feedback">{{ $message }}</p>
  @enderror

      --}}
