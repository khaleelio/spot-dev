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
        <div class="parent card-body row">
            <div class="dragula-container ng-isolate-scope col-lg-3 p-3" id="source">
                @forelse ($widgets as $widget)
                    <div class="widget" id="widget-{{$widget->id}}" data-widget-id="{{$widget->id}}">
                        <span class="handle">+</span>
                        <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('website.widget.container.destroy', '')}}" title="{{ translate('Delete') }}" style="display: none">
                            <i class="las la-trash"></i>
                        </a>
                        <h3>{{$widget->title}}</h3>
                        <div>{!!$widget->value!!}</div>
                    </div>
                @empty
                    
                @endforelse
            </div>
            @forelse ($containers as $container)
                @widget('mainWidget',['container'=>$container])
            @empty
                
            @endforelse
        </div>
    </div>

@endsection

@section('modal')
    @include('modals.add_widget_modal')
    @include('modals.delete_modal')
@endsection

@section('script')
    <script src="{{asset('public/assets/dragula/dragula.js')}}" type="text/javascript"></script>
    <script>
        'use strict';
        var containers = [
            document.getElementById('source'),
            @forelse ($containers as $container)
                document.getElementById('container-{{$container->id}}'),
            @empty
                
            @endforelse
        ];

        dragula(containers, {
            copy: function (el, source) {
                return source.id === 'source';
            },
            accepts: function (el, target, source) {
                return target.id !== 'source';
            }
        }).on('drop', function (el, container, source) {
            if(container){
                var container_devs = container.getElementsByClassName('widget');
                var container_widgets_order = [];
                for (let index = 0; index < container_devs.length; index++) {
                    if(container_devs[index].dataset.containerWidgetId){
                        container_widgets_order.push(container_devs[index].dataset.containerWidgetId);
                    }else{
                        container_widgets_order.push('0');
                    }
                }
                $.ajax({
                url:'{{ route("website.widget.clone") }}',
                type:'POST',
                data:  { _token: AIZ.data.csrf, container_widgets:container_widgets_order, container_id:container.dataset.containerId, widget_id:el.dataset.widgetId, source:source.dataset.containerId},
                dataTy:'json',
                success:function(response){
                    if(source.id == 'source'){
                        el.dataset.containerWidgetId = response.id;
                        var btn_delete = el.getElementsByClassName('confirm-delete')[0];
                        btn_delete.style.display = "";
                        btn_delete.dataset.href += "/" + response.id + " ";
                        // console.log(btn_delete);
                    }
                },
                error: function(returnval) {
                    console.log(returnval);
                }
            });
            }
        });

    </script>
@endsection
