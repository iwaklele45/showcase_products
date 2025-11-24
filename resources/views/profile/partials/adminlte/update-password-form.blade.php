<div class="card card-warning">
    <div class="card-header">
        <h3 class="card-title">{{ __('Update Password') }}</h3>
    </div>
    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')
        <div class="card-body">
            <div class="form-group">
                <label for="update_password_current_password">{{ __('Current Password') }}</label>
                <input id="update_password_current_password" name="current_password" type="password" class="form-control"
                    autocomplete="current-password">
                @error('current_password')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="update_password_password">{{ __('New Password') }}</label>
                <input id="update_password_password" name="password" type="password" class="form-control"
                    autocomplete="new-password">
                @error('password')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="update_password_password_confirmation">{{ __('Confirm Password') }}</label>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                    class="form-control" autocomplete="new-password">
                @error('password_confirmation')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="card-footer d-flex align-items-center gap-2">
            <button type="submit" class="btn btn-warning">{{ __('Save') }}</button>
            @if (session('status') === 'password-updated')
                <span class="text-success small ms-2">{{ __('Saved.') }}</span>
            @endif
        </div>
    </form>
</div>
