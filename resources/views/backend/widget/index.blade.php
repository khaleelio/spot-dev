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
                    @widget('mainWidget',['container_widget'=>$widget,'type'=>'widget'])
                @empty
                    
                @endforelse
            </div>
        </div>
        @forelse ($containers as $container)
            <div class="col-lg-3">
                <div class="card-header p-0 m-0">
                    <div class="card-title m-0 px-5 pt-5 pb-3">
                        <h3 class="card-label font-weight-bolder">{{$container->title}}</h3>
                    </div>
                </div>
                <div class="bg-white rounded-bottom p-5 dragula-container ng-isolate-scope col-lg-12" id="source">
                    <div class="dragula-container ng-isolate-scope">
                        <div id="container-{{$container->id}}" data-container-id="{{$container->id}}" style="min-height: 300px;">
                            @forelse ($container->container_widget as $container_widget)
                                @widget('mainWidget',['container_widget'=>$container_widget,'type'=>'container_widget'])
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
