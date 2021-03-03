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
        <div class="row p-5">
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
        <div class="parent card-body row">
            @forelse ($widgets as $widget)
                @widget('mainWidget',['widget'=>$widget])
            @empty
                
            @endforelse
        </div>
    </div>

@endsection

@section('modal')
    @include('modals.add_widget_item_modal')
    @include('modals.delete_modal')
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
                // console.log(el);
                // console.log(container);
                // console.log(handle);
                return handle.classList.contains('handle');
            }
        }).on('drop', function (el, container) {
            var item_devs = container.getElementsByTagName('div');
            var items_order = [];
            for (let index = 0; index < item_devs.length; index++) {
                items_order.push( item_devs[index].dataset.itemId );
            }
            // console.log(items_order);
            // console.log(container.dataset.widgetId);
            $.post('{{ route('website.widget.item.position') }}', { _token: AIZ.data.csrf, items:items_order, widget_id:container.dataset.widgetId}, function(data){
                console.log(data);
            });
        });

    </script>
@endsection
