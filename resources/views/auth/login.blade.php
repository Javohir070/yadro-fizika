<x-guest-layout>
    <style>
        .auth-page {
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: linear-gradient(135deg, #eef2ff 0%, #f8fafc 45%, #e0f2fe 100%);
            font-family: Arial, Helvetica, sans-serif;
        }

        .auth-card {
            width: 100%;
            max-width: 430px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            box-shadow: 0 14px 40px rgba(15, 23, 42, 0.14);
            padding: 30px 26px;
        }

        .auth-title {
            margin: 0;
            font-size: 32px;
            line-height: 1.2;
            color: #0f172a;
            text-align: center;
        }

        .auth-subtitle {
            margin: 8px 0 22px;
            text-align: center;
            color: #64748b;
            font-size: 15px;
        }

        .auth-status {
            margin-bottom: 14px;
            padding: 10px 12px;
            border: 1px solid #86efac;
            border-radius: 10px;
            background: #f0fdf4;
            color: #166534;
            font-size: 14px;
        }

        .auth-field {
            margin-bottom: 14px;
        }

        .auth-label {
            display: block;
            margin-bottom: 6px;
            color: #334155;
            font-size: 14px;
            font-weight: 600;
        }

        .auth-input {
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #cbd5e1;
            border-radius: 11px;
            padding: 11px 12px;
            font-size: 15px;
            color: #0f172a;
            transition: all 0.2s ease;
        }

        .auth-input:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.18);
        }

        .auth-error {
            margin-top: 6px;
            color: #b91c1c;
            font-size: 13px;
        }

        .auth-row {
            margin: 4px 0 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .auth-remember {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #475569;
            font-size: 14px;
        }

        .auth-link {
            color: #4f46e5;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .auth-link:hover {
            text-decoration: underline;
        }

        .auth-button {
            width: 100%;
            border: 0;
            border-radius: 11px;
            background: #4f46e5;
            color: #ffffff;
            padding: 12px 14px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.05s ease;
        }

        .auth-button:hover {
            background: #4338ca;
        }

        .auth-button:active {
            transform: translateY(1px);
        }
    </style>

    <div class="auth-page">
        <div class="auth-card">
            <div>
                <h1 class="auth-title">{{ __('Welcome back') }}</h1>
                <p class="auth-subtitle">{{ __('Sign in to continue') }}</p>
            </div>

            @if (session('status'))
                <div class="auth-status">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="auth-field">
                    <label for="email" class="auth-label">{{ __('Email') }}</label>
                    <input id="email" class="auth-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                    @error('email')
                        <div class="auth-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="auth-field">
                    <label for="password" class="auth-label">{{ __('Password') }}</label>
                    <input id="password" class="auth-input"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password" />
                    @error('password')
                        <div class="auth-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="auth-row">
                    <label for="remember_me" class="auth-remember">
                        <input id="remember_me" type="checkbox" name="remember">
                        <span>{{ __('Remember me') }}</span>
                    </label>

                    {{-- @if (Route::has('password.request'))
                        <a class="auth-link" href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif --}}
                </div>

                <button type="submit" class="auth-button">
                    Login
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
