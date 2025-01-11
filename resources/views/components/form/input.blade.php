@props([
    'type'=>'text','name','value'=>'', 'label'=>false
])

@if ($label)
<label for="">{{ $label }}</label>
@endif

<input type="{{ $type }}" name="{{ $name }}" 
{{ $attributes->class([
"form-control" , 
    'is-invalid' => $errors->has($name)
            ]) }}
 value="{{ old($name, $value) }}">
    @error($name)
        {{ $message }}
    @enderror