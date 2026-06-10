@props(['roles', 'selected' => []])

<div class="row g-2">
    @foreach ($roles as $role)
        <div class="col-md-4">
            <div class="form-check">
                <input type="checkbox" name="roles[]" value="{{ $role->name }}" id="role-{{ $role->id }}"
                    class="form-check-input @error('roles') is-invalid @enderror"
                    @checked(in_array($role->name, old('roles', $selected), true))>
                <label class="form-check-label" for="role-{{ $role->id }}">{{ $role->name }}</label>
            </div>
        </div>
    @endforeach
</div>
@error('roles') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
