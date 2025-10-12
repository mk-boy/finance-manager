@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card bg-dark">
                <div class="card-header">
                    <h3 class="text-white mb-0">
                        <i class="fas fa-envelope me-2"></i>
                        {{ __('Verify Your Email Address') }}
                    </h3>
                </div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    <div class="text-center mb-4">
                        <i class="fas fa-envelope-open text-primary fs-1 mb-3"></i>
                        <p class="text-light">{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                    </div>

                    <div class="text-center">
                        <p class="text-light mb-3">{{ __('If you did not receive the email') }}</p>
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fas fa-paper-plane me-2"></i>
                                {{ __('click here to request another') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
