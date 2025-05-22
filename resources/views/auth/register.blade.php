<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="tab-container">
            <div class="tab active">Đăng nhập</div>
            <div class="tab">Tạo tài khoản</div>
        </div>

        <div class="form-container">
            <!-- Form đăng nhập với email -->
            <div class="form-left">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                            required autofocus autocomplete="username" placeholder="Email" />
                    </div>
                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="current-password" placeholder="Mật khẩu" />
                    </div>
                    <div class="mt-4">
                        <button class="btn-login" type="submit" disabled>Đăng nhập</button>
                    </div>
                </form>
            </div>

            <!-- Đăng nhập với mạng xã hội -->
            <div class="form-right">
                <div class="social-button facebook"><i class="fab fa-facebook-f"></i> Facebook</div>
                <div class="social-button google"><i class="fab fa-google"></i> Google</div>
                <div class="social-button apple"><i class="fab fa-apple"></i> Apple</div>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>