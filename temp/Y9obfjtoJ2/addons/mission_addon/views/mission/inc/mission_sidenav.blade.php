<!-- Client -->
@if (\App\Addon::where('unique_identifier', 'mission_addon')->first()->activated)
    @if(Auth::user()->user_type == 'admin' || in_array('1009', json_decode(Auth::user()->staff->role->permissions)))
        <li class="menu-item menu-item-submenu  {{ areActiveRoutes(['admin.missions.index','admin.missions.update','admin.missions.create'])}} @foreach(\App\Mission::status_info() as $item) {{ areActiveRoutes([$item['route_name']])}} @endforeach " aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
                <i class="menu-icon flaticon2-document"></i>
                <span class="menu-text">{{translate('Missions')}}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{translate('Missions')}}</span>
                        </span>
                    </li>
                  
                    
                    
                    @foreach(\App\Mission::status_info() as $item)
                    
                        @if(Auth::user()->user_type == 'admin' || in_array($item['permissions'], json_decode(Auth::user()->staff->role->permissions)))
                            <li class="menu-item {{ areActiveRoutes([$item['route_name']])}}" aria-haspopup="true">
                                <a href="{{ route($item['route_name'],['status'=>$item['status']]) }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">{{$item['text']}}</span>
                                    
                                </a>
                            </li>
                        @endif
                    @endforeach

                    
                </ul>
            </div>
        </li>
        
    @endif
@endif
