<div class="dragula-container ng-isolate-scope">
  <div id="container-{{$config['container']->id}}" data-container-id="{{$config['container']->id}}" style="min-height: 300px;">
    @forelse ($config['container']->container_widget as $container_widget)
        <div class="card card-custom card-fit card-border card-collapsed widget mb-2" data-card="true" id="widget-{{$container_widget->id}}" data-widget-id="{{$container_widget->id}}">
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
          <form class="form">
              <div class="card-body p-2">
                  <div class="form-group form-group-last">
                      <div class="alert alert-custom alert-default" role="alert">
                          <div class="alert-icon">
                              <span class="svg-icon svg-icon-primary svg-icon-xl">
                                  <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Tools/Compass.svg-->
                                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                          <rect x="0" y="0" width="24" height="24" />
                                          <path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3" />
                                          <path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero" />
                                      </g>
                                  </svg>
                                  <!--end::Svg Icon-->
                              </span>
                          </div>
                          <div class="alert-text">Set heights using classes like 
                          <code>.form-control-lg</code>, and set widths using grid column classes like 
                          <code>.col-lg-*</code></div>
                      </div>
                  </div>
                  <div class="form-group">
                      <label>Large Input</label>
                      <input type="email" class="form-control form-control-lg" placeholder="Large input" />
                  </div>
                  <div class="form-group">
                      <label>Default Input</label>
                      <input type="email" class="form-control" placeholder="Large input" />
                  </div>
                  <div class="form-group">
                      <label>Small Input</label>
                      <input type="email" class="form-control form-control-sm" placeholder="Large input" />
                  </div>
                  <div class="form-group">
                      <label for="exampleSelectl">Large Select</label>
                      <select class="form-control form-control-lg" id="exampleSelectl">
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="exampleSelectd">Default Select</label>
                      <select class="form-control" id="exampleSelectd">
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="exampleSelects">Small Select</label>
                      <select class="form-control form-control-sm" id="exampleSelects">
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                      </select>
                  </div>
              </div>
              <div class="card-footer">
                  <button type="reset" class="btn btn-success mr-2">Submit</button>
                  <button type="reset" class="btn btn-secondary">Cancel</button>
              </div>
          </form>
      </div>
    @empty
        
    @endforelse
  </div>
</div>