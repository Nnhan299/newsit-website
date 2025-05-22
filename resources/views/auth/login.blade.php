<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="logo-container">
                <x-authentication-card-logo />
            </div>
        </x-slot>

        <!-- Hiển thị thông báo lỗi và thành công -->
        @if (session('success'))
        <div class="alert alert-success text-green-600 border border-green-600 rounded p-3 mb-4">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger text-red-600 border border-red-600 rounded p-3 mb-4">
            {{ session('error') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger text-red-600 border border-red-600 rounded p-3 mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Tabs -->
        <div class="tab-container flex justify-end border-b border-gray-300 mb-5">
            <div class="tab active" id="login-tab">Đăng nhập</div>
            <div class="tab" id="register-tab">Tạo tài khoản</div>
        </div>

        <!-- Form Container -->
        <div
            class="form-container flex gap-5 p-5 border border-gray-300 rounded-xl bg-gray-50 max-w-2xl mx-auto justify-end">
            <!-- Form Đăng nhập -->
            <div class="form-left active" id="login-form">
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
                        <button class="btn-login" type="submit">Đăng nhập</button>
                    </div>
                </form>
            </div>

            <!-- Form Tạo tài khoản -->
            <div class="form-left hidden" id="register-form">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div>
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                            required autofocus placeholder="Tên của bạn" />
                        @error('name')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                            required placeholder="Email" />
                        @error('email')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <x-label for="phone" value="{{ __('Phone') }}" />
                        <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"
                            required placeholder="Số điện thoại" />
                        @error('phone')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            placeholder="Mật khẩu" />
                        @error('password')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" required placeholder="Xác nhận mật khẩu" />
                        @error('password_confirmation')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <button class="btn-register" type="submit">Tạo tài khoản</button>
                    </div>
                </form>
            </div>

            <!-- Nút mạng xã hội -->
            <div class="social-login">
                <button type="button" class="social-btn facebook">Facebook</button>
                <button type="button" class="social-btn google">Google</button>
                <button type="button" class="social-btn apple">Apple</button>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>