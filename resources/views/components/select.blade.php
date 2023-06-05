@props(['id', 'label', 'placeholder', 'name' => ''])

@php
    use Illuminate\Support\Str;

    if (!isset($id)) {
        $rstr = Str::random(6);
        $inputId = $name . '-' . $rstr;
    }
    else {
        $inputId = $id;
    }
    
    if(!isset($label))
        $label = false;
    if(!isset($placeholder))
        $placeholder = false;

    $label = $label ? $label : false;
    $placeholder = $placeholder ? $placeholder : false;
@endphp

<div class="mb-3">
    @if ($label)
        <label for="{{ $inputId }}">{{ $label }}</label>
    @endif

    <select id="{{ $inputId }}" class="form-select @error($name) is-invalid @enderror"
        name="{{ $name }}">

        @if ($placeholder)
            <option selected>{{ $placeholder }}</option>
        @endif

        {{ $slot }}
    </select>
    @error($name)
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror

</div>
