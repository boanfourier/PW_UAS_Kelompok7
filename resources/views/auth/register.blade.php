<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
        </x-slot>

        <x-jet-validation-errors class="mb-4" />
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="text-center">Register Akun Baru</h1>
                            <h2 class="text-center">E Service</h2>
        
                            <div class="text-center">
                                <i class="fas fa-user-plus" style="font-size: 9em;"></i>
                                <form class="mt-5 text-left"  method="POST" action="{{ route('register') }}">
                                    @csrf
                    
                                    <div class="form-group">
        
                                        <x-jet-label for="name" value="{{ __('Name') }}" />
                                        <x-jet-input id="name" placeholder="Masukan Nama" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                    </div>
                        
                                    <div class="form-group">
                                        <x-jet-label for="email" value="{{ __('Email') }}" />
                                        <x-jet-input id="email" placeholder="Masukan Email" class="form-control" type="email" name="email" :value="old('email')" required />
                                    </div>
                        
                                    <div class="form-group">
                                        <x-jet-label for="password" value="{{ __('Password') }}" />
                                        <x-jet-input id="password" placeholder="Masukan Password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                                    </div>
                        
                                    <div class="form-group">
                                        <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                        <x-jet-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                                    </div>

                        
                                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                        <div class="mt-4">
                                            <x-jet-label for="terms">
                                                <div class="flex items-center">
                                                    <x-jet-checkbox name="terms" id="terms"/>
                        
                                                    <div class="ml-2">
                                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                                        ]) !!}
                                                    </div>
                                                </div>
                                            </x-jet-label>
                                        </div>
                                    @endif

                                    
                                  

                                    <x-jet-button class="btn btn-dark btn-block mt-3">
                                        <i
                                        class="fa fa-user-plus"></i>
                                        {{ __('Register') }}
                                    </x-jet-button>
                                    <hr>
                        
                                        <a class="btn btn-secondary btn-block" href="/">
                                            <i class="fa fa-user"></i>
                                            {{ __('Sudah punya Akun?') }}
                                        </a>
                        

                                </form>
                            </div>                    
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </x-jet-authentication-card>
</x-guest-layout>
