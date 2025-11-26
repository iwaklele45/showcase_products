<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ __('Profile Information') }}</h3>
    </div>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>

    <form method="post" action="{{ route('profile.update') }}" class="">
        @csrf
        @method('patch')
        <div class="card-body">
            <div class="form-group">
                <label for="username">{{ __('Username') }}</label>
                <input @if (Auth::user()->role == 'seller') readonly @endif id="username" name="username" type="text"
                    class="form-control" value="{{ old('username', $user->username) }}" required autofocus
                    autocomplete="username">
                @error('username')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input id="name" name="name" type="text" class="form-control"
                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                @error('name')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <input id="email" name="email" type="email" class="form-control" readonly
                    value="{{ old('email', $user->email) }}" required autocomplete="username">
                @error('email')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <p class="mt-2 mb-0 small text-secondary">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification"
                            class="btn btn-link p-0 ms-1">{{ __('Click here to re-send the verification email.') }}</button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-success small">
                            {{ __('A new verification link has been sent to your email address.') }}</p>
                    @endif
                @endif
            </div>
        </div>
        <div class="card-footer d-flex align-items-center gap-2">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            @if (session('status') === 'profile-updated')
                <span class="text-success small ms-2">{{ __('Saved.') }}</span>
            @endif
        </div>
    </form>
</div>
