<div class="dragula-container ng-isolate-scope col-lg-3 p-3" id="widget-{{$config['widget']->id}}" data-widget-id="{{$config['widget']->id}}">
  <h2>{{$config['widget']->title}}
    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('website.widget.destroy', $config['widget']->id)}} " title="{{ translate('Delete') }}">
      <i class="las la-trash"></i>
    </a>
  </h2>
  @forelse ($config['widget']->item as $item)
      <div id="item-{{$item->id}}" data-item-id="{{$item->id}}">
          <span class="handle">+</span>
          <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('website.widget.item.destroy', $item->id)}} " title="{{ translate('Delete') }}">
            <i class="las la-trash"></i>
          </a>
          <h3>{{$item->title}}</h3>
          <p>{{$item->body}}</p>
      </div>
  @empty
      
  @endforelse
</div>