@extends('backend.layouts.app')

@section('style')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection

@section('content')

    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">{{translate('Menus')}}</h1>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            {!! Menu::render() !!}
        </div>
    </div>

@endsection

@section('script')
    {!! Menu::scripts() !!}
@endsection
