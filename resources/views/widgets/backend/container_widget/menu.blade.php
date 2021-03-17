<div class="card card-custom card-fit card-border card-collapsed widget mb-2" data-card="true" id="widget-{{$container_widget->id}}" data-widget-id="{{$container_widget->widget_id}}" data-container-widget-id="{{$container_widget->id}}">
    <div class="card-header p-2">
        <div class="card-title">
            <h3 class="card-label">{{$container_widget->title}}</h3>
        </div>
        <div class="card-toolbar">
            <a href="#" class="btn btn-xs btn-icon btn-danger mr-2 confirm-delete" data-href="{{ route('website.widget.container.destroy', $container_widget->id)}}" title="{{ translate('Delete') }}" style="">
                <i class="las la-trash"></i>
            </a>
            <a href="#" class="btn btn-xs btn-icon btn-success toggle" data-card-tool="toggle" style="">
                <i class="flaticon2-gear"></i>
            </a>
        </div>
    </div>
    <form class="form" action="{{ route('website.widget.container.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$container_widget->id}}">
        <div class="card-body p-2">
            <div class="form-group">
                <label>{{ translate('Title') }}</label>
                <input type="text" class="form-control" placeholder="title" name="title" value="{{$container_widget->title}}"/>
            </div>
            <div class="form-group">
                <label>{{ translate('Select Menu') }}</label>
                <select class="form-control" name="menu">
                    <option selected>{{ translate('Choose Menu') }}...</option>
                    @foreach ($menus as $menu)
                        <option data-tokens="{{$menu->name}}" value="{{$menu->id}}" @if($menu_id == $menu->id) selected @endif>{{$menu->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-success">{{ translate('Submit') }}</button>
        </div>
    </form>
</div>
    