@extends('backend.layouts.app')
    
@section('style')   
    <style>
        .widget{
            padding: 5px;
            border: 2px solid deepskyblue;
            border-radius: 5px;
            background-color: honeydew;
        }
    </style>
@endsection

@section('content')

    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">{{translate('Widget')}}</h1>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body row">
            <div class="col-lg-3">
                @widget('mainWidget')
            </div>
            <div class="col-lg-3">
                @widget('mainWidget')
            </div>
            <div class="col-lg-3">
                @widget('mainWidget')
            </div>
            <div class="col-lg-3">
                @widget('mainWidget')
            </div>
        </div>
    </div>

@endsection

@section('script')
    {!! Menu::scripts() !!}
@endsection
