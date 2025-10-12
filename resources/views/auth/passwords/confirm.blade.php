@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card bg-dark">
                <div class="card-header">
                    <h3 class="text-white mb-0">
                        <i class="fas fa-shield-alt me-2"></i>
                        {{ __('Confirm Password') }}
                    </h3>
                </div>

                <div class="card-body">
                    <div class="text-center mb-4">
                        <i class="fas fa-lock text-warning fs-1 mb-3"></i>
                        <p class="text-light">{{ __('Please confirm your password before continuing.') }}</p>
                    </div>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="password" class="form-label text-white">
                                <i class="fas fa-key me-2"></i>
                                {{ __('Password') }}
                            </label>
                            <input id="password" 
                                   type="password" 
                                   class="form-control text-white @error('password') is-invalid @enderror" 
                                   name="password" 
                                   required 
                                   autocomplete="current-password">

                            @error('password')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fas fa-check me-2"></i>
                                {{ __('Confirm Password') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-outline-light" href="{{ route('password.request') }}">
                                    <i class="fas fa-question-circle me-2"></i>
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
