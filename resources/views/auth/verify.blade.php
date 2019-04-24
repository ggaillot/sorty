@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Vérifier votre Email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un lien vous a été envoyé dans votre boite mail, il vous permettra de terminer l'opération.') }}
                        </div>
                    @endif

                    {{ __('Avant de poursuivre, vérifiez votre boite mail et suivez le lien qui vous a été envoyé.') }}
                    {{ __('Si vous n'avez pas reçu d'email') }}, <a href="{{ route('verification.resend') }}">{{ __('click ici pour une nouvelle demande') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
