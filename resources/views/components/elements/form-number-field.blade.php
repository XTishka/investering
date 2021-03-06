@props(['disabled'=>false])

<div class="form-group row">
    <label for="{{ $id }}" class="col-sm-3 col-form-label">{{ __($label) }}</label>
    <div class="col-sm-9">
        <input type="number" class="form-control  @error('{{ $name }}') is-invalid @enderror"
            id="{{ $id }}" name="{{ $name }}" placeholder="{{ __($placeholder) }}" value="{{ $value }}"
            min="{{ $min }}" max="{{ $max }}"  {{ $disabled == 'true' ? ' disabled' :'' }}>
    </div>

    @error('{{ $name }}')
        <span class="invalid-feedback" role="alert">
            <strong>{{ __($message) }}</strong>
        </span>
    @enderror
</div>
