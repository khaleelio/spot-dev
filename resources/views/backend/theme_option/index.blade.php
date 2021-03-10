@extends('backend.layouts.app')

@section('style')

@endsection

@section('content')

    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h3">{{ translate('Theme Options') }}</h1>
            </div>
        </div>
    </div>
    <div class="row pad">
        @include('app_settings::_settings')
    </div>

@endsection

@section('modal')

@endsection

@section('script')

@endsection
