@extends('backend.layouts.app')

@section('style')
    <link href="{{asset('public/assets/dragula/dragula.css')}}" rel="stylesheet">
@endsection

@section('content')

    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">{{ translate('Widgets') }}</h1>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-3">
            <div class="bg-white rounded p-3 dragula-container ng-isolate-scope col-lg-12" id="source">
                @forelse ($widgets as $widget)
                    <div class="card card-custom card-fit card-border card-collapsed widget mb-2" data-card="true" id="widget-{{$widget->id}}" data-widget-id="{{$widget->id}}">
                        <div class="card-header p-2">
                            <div class="card-title">
                                <h3 class="card-label">{{$widget->title}}</h3>
                            </div>
                            <div class="card-toolbar">
                                <a href="#" class="btn btn-xs btn-icon btn-danger mr-2 confirm-delete" data-href="{{ route('website.widget.container.destroy', '')}}" title="{{ translate('Delete') }}" style="display: none">
                                    <i class="las la-trash"></i>
                                </a>
                                <a href="#" class="btn btn-xs btn-icon btn-success toggle" data-card-tool="toggle" style="display: none">
                                    <i class="flaticon2-gear"></i>
                                </a>
                            </div>
                        </div>
                        <form class="form" action="{{ route('website.widget.container.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="" class="id">
                            <div class="card-body p-2">
                                @if($widget->type)
                                    {!! json_decode($widget->object)->form !!}
                                @else
                                    <div class="form-group">
                                        <label>{{ translate('Title') }}</label>
                                        <input type="text" class="form-control" placeholder="title" name="title" value="{{$widget->title}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ translate('Value') }}</label>
                                        <textarea class="form-control" name="value" cols="30" rows="4">{{$widget->value}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ translate('Link') }}</label>
                                        <input type="text" class="form-control" placeholder="link" name="link" value="{{$widget->link}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ translate('Class') }}</label>
                                        <input type="text" class="form-control" placeholder="class" name="class" value="{{$widget->class}}"/>
                                    </div>
                                @endif
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-success">{{ translate('Submit') }}</button>
                            </div>
                        </form>
                    </div>
                @empty
                    
                @endforelse
            </div>
        </div>
        @forelse ($containers as $container)
            <div class="col-lg-3">
                <div class="card-header p-0 m-0">
                    <div class="card-title m-0 px-5 pt-5 pb-3">
                        <h3 class="card-label font-weight-bolder">{{$container->name}}</h3>
                    </div>
                </div>
                <div class="bg-white rounded-bottom p-5 dragula-container ng-isolate-scope col-lg-12" id="source">
                    <div class="dragula-container ng-isolate-scope">
                        <div id="container-{{$container->id}}" data-container-id="{{$container->id}}" style="min-height: 300px;">
                            @forelse ($container->container_widget as $container_widget)
                                @widget('mainWidget',['container_widget'=>$container_widget])
                            @empty
        
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        @empty
            
        @endforelse
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
                console.log(container_widgets_order);
                $.ajax({
                url:'{{ route("website.widget.clone") }}',
                type:'POST',
                data:  { _token: AIZ.data.csrf, container_widgets:container_widgets_order, container_id:container.dataset.containerId, widget_id:el.dataset.widgetId, source:source.dataset.containerId},
                dataTy:'json',
                success:function(response){
                    if(source.id == 'source'){
                        // console.log(response);
                        el.dataset.containerWidgetId = response.id;
                        var btn_delete = el.getElementsByClassName('confirm-delete')[0];
                        btn_delete.style.display = "";
                        btn_delete.dataset.href += "/" + response.id + " ";
                        $(btn_delete).click(function (e) {
                            e.preventDefault();
                            $("#delete-modal").modal("show");
                            $("#delete-link").attr("href", btn_delete.dataset.href);
                        });
                        var btn_toggle = el.getElementsByClassName('toggle')[0];
                        btn_toggle.style.display = "";
                        KTApp.init(KTAppSettings);
                        
                        var id_input = el.getElementsByClassName('id')[0];
                        id_input.value = response.id;
                    }
                },
                error: function(returnval) {
                    // console.log(returnval);
                }
            });
            }
        });

    </script>
@endsection
