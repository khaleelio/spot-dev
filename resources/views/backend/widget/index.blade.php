@extends('backend.layouts.app')

@section('style')
    <link href="{{asset('public/assets/dragula/dragula.css')}}" rel="stylesheet">
    <style>
        .widget {
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
                <h1 class="h3">{{ translate('Widget') }}</h1>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header my-3 row">
            <div class="col-lg-6">
                <h5 class="card-title">{{ translate('Add New Widget') }}</h5>
                <form class="form-inline" action="{{ route('website.widget.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="inputPassword2" class="sr-only">{{ translate('Title') }}</label>
                        <input type="text" class="form-control" id="" placeholder="title" name="title" required>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">{{ translate('Save') }}</button>
                </form>
            </div>
            @if (count($widgets) > 0)
                <div class="col-lg-6 text-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">{{ translate('Add New Item') }}</button>
                </div>
            @endif
        </div>
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
        <div class="parent row">
            @forelse ($widgets as $widget)
                <div class="dragula-container ng-isolate-scope col-lg-4 p-3" id="widget-{{$widget->id}}">
                    <h2>{{$widget->title}}</h2>
                    @forelse ($widget->item as $item)
                        <div id="item-{{$item->id}}">
                            <span class="handle">+</span>
                            <h3>{{$item->title}}</h3>
                            <p>{{$item->body}}</p>
                        </div>
                    @empty
                        
                    @endforelse
                </div>
            @empty
                
            @endforelse
        </div>

    </div>

    {{-- Add New Item --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('website.widget.item.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ translate('New Item') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">{{ translate('Title') }}*:</label>
                                <input type="text" class="form-control" id="recipient-name" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">{{ translate('Body') }}*:</label>
                                <textarea class="form-control" id="message-text" name="body" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">{{ translate('Link') }}:</label>
                                <input type="text" class="form-control" id="recipient-name" name="link">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">{{ translate('Widget') }}:</label>
                                <select class="form-control form-control-sm" aria-label="Default select example"
                                    name="widget_id">
                                    @foreach ($widgets as $widget)
                                        <option value="{{ $widget->id }}">{{ $widget->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ translate('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ translate('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{asset('public/assets/dragula/dragula.js')}}" type="text/javascript"></script>
    <script>
        'use strict';
        var widgets = [
            @forelse ($widgets as $widget)
                document.getElementById('widget-{{$widget->id}}'),
            @empty
                
            @endforelse
        ];

        dragula(widgets, {
            moves: function (el, container, handle) {
                console.log(el);
                console.log(container);
                // console.log(handle);
                return handle.classList.contains('handle');
            }
        });
        
    </script>
@endsection
