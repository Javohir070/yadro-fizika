@props([
    'name',
    'label' => null,
    'value' => '',
    'rows' => 8,
    'height' => 480,
    'id' => null,
    'required' => true,
])

@php
    $inputId = $id ?? 'summernote-' . \Illuminate\Support\Str::slug(str_replace(['[', ']'], '-', $name));
@endphp

<div {{ $attributes->class('col-md-12') }}>
    @if ($label)
        <label class="form-label" for="{{ $inputId }}">{{ $label }}@if ($required)
                *
            @endif
        </label>
    @endif
    <textarea name="{{ $name }}" id="{{ $inputId }}" rows="{{ (int) $rows }}"
        data-editor-height="{{ (int) $height }}"
        class="form-control js-admin-summernote @error($name) is-invalid @enderror">{{ old($name, $value) }}</textarea>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
