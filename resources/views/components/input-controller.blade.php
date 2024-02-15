<div class="form-group">

    <label for="">{{ $label }}</label>
    @if ($type === 'password')
        <p class="input-container">
            <input type="{{ $type }}" name="{{ $name }}" class="form-control custom-input password-input"
                id="{{ $name }}">
            <i class="bi bi-eye-slash toggle-password" id="togglePassword"></i>
        </p>
    @else
        <input type="{{ $type }}" name="{{ $name }}" class="form-control custom-input"
            id="{{ $name }}" value="{{ old($name) }}">
    @endif


    {{-- shows validation message --}}
    <span class="text-danger">
        @error($name)
            {{ $message }}
        @enderror
    </span>
</div>




{{-- value="{{ old($name)}} old data remains if any other fields facing validation error  --}}
{{-- $message shows validation error message --}}
