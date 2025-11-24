<div class="card card-danger">
    <div class="card-header">
        <h3 class="card-title">{{ __('Delete Account') }}</h3>
    </div>
    <div class="card-body">
        <p class="small text-secondary">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
        <form method="post" action="{{ route('profile.destroy') }}"
            onsubmit="return confirm('{{ addslashes(__('Are you sure you want to delete your account?')) }}');">
            @csrf
            @method('delete')
            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" name="password" type="password" class="form-control"
                    placeholder="{{ __('Password') }}">
                @error('password')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-3 d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-2"
                    data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="submit" class="btn btn-danger">{{ __('Delete Account') }}</button>
            </div>
        </form>
    </div>
</div>
