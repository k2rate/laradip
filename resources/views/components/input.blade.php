@props(['id', 'class', 'type' => 'text', 'name' => '', 'required' => false])

@php
    use Illuminate\Support\Str;
    
    if (isset($id)) {
        $inputId = $id;
    } else {
        $rstr = Str::random(6);
        $inputId = $name . '-' . $rstr;
        $required = $required ? true : false;
    }
    
    if (!isset($class)) {
        $class = '';
    }
    
@endphp

<div class="mb-3">

    @if (strlen(trim($slot)) != 0)
        <label for="{{ $inputId }}">{{ $slot }}</label>
    @endif

    <input id="{{ $inputId }}" type="{{ $type }}"
        class="form-control @error($inputId) is-invalid @enderror {{ $class }}" name="{{ $name }}"
        value="{{ old($name) }}" @if ($required) required @endif {{ $attributes }}>

    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
