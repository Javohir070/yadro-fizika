@props(['permissions', 'selected' => []])

@foreach ($permissions as $group => $items)
    @if ($items->isNotEmpty())
        <div class="mb-3">
            <h6 class="fw-semibold mb-2">{{ $group }}</h6>
            <div class="row g-2">
                @foreach ($items as $permission)
                    <div class="col-md-6 col-lg-4">
                        <div class="form-check">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                id="permission-{{ $permission->id }}"
                                class="form-check-input @error('permissions') is-invalid @enderror"
                                @checked(in_array($permission->name, old('permissions', $selected), true))>
                            <label class="form-check-label" for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endforeach
@error('permissions') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
