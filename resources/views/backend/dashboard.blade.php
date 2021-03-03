@extends('backend.layouts.app')

@section('content')
    @if(env('MAIL_USERNAME') == null && env('MAIL_PASSWORD') == null)
        <div class="">
            <div class="alert alert-danger" role="alert">
                {{translate('Please Configure SMTP Setting to work all email sending funtionality')}},
                <a class="alert-link" href="{{ route('smtp_settings.index') }}">{{ translate('Configure Now') }}</a>
            </div>
        </div>
    @endif

    


@endsection
@section('script')

@endsection
