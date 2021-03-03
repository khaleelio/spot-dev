<div class="dragula-container ng-isolate-scope col-lg-3 p-3">
  <h2>{{$config['container']->name}}</h2>
  <div id="container-{{$config['container']->id}}" data-container-id="{{$config['container']->id}}" style="min-height: 300px;">
    @forelse ($config['container']->container_widget as $container_widget)
        <div class="widget" id="widget-{{$container_widget->id}}" data-widget-id="{{$container_widget->widget_id}}" data-container-widget-id="{{$container_widget->id}}">
            <span class="handle">+</span>
            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('website.widget.container.destroy', $container_widget->id)}} " title="{{ translate('Delete') }}" style="">
              <i class="las la-trash"></i>
            </a>
            <h3>{{$container_widget->title}}</h3>
            <div>{!!$container_widget->value!!}</div>
        </div>
    @empty
        
    @endforelse
  </div>
</div>