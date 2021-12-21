<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center">Login</h1>
                        <div class="text-center">
                            <form class="mt-5" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="input-group mb-3">
                                    <x-jet-input placeholder="Email" id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
                                </div>
                    
                                <div class="input-group mb-3">
                                    <x-jet-input placeholder="Password" id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                                </div>

                                <x-jet-button class="btn btn-dark btn-block">
                                    {{ __('Log in') }}
                                </x-jet-button>
                    
                                <div class="block mt-4">
                                    <label for="remember_me" class="flex items-center">
                                        <x-jet-checkbox id="remember_me" name="remember" />
                                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                    </label>
                                </div>
                    
                                <div class="flex items-center justify-end mt-4">
                                    @if (Route::has('password.request'))
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    @endif
                    
                                  
                                </div>

                                <hr />

                            </form>
                            <a href="register"  class="btn btn-secondary btn-block">
                                Register
                             </a>
                 
                        </div>
                    </div>
            
                </div>
        
            </div>
    
        </div>
     </x-jet-authentication-card>
</x-guest-layout>

