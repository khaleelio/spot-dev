<!-- Client -->
@if (\App\Addon::where('unique_identifier', 'branch_addon')->first()->activated)
    @if(Auth::user()->user_type == 'admin' || in_array('1001', json_decode(Auth::user()->staff->role->permissions)))
        <li class="menu-item menu-item-submenu  {{ areActiveRoutes(['admin.clients.index','admin.branchs.update','admin.branchs.create'])}}" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
                <i class="menu-icon flaticon2-document"></i>
                <span class="menu-text">{{translate('Branches')}}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{translate('Branches')}}</span>
                        </span>
                    </li>
                  
                    @if(Auth::user()->user_type == 'admin' || in_array('1005', json_decode(Auth::user()->staff->role->permissions)))
                        <li class="menu-item {{ areActiveRoutes(['admin.branchs.index','admin.branchs.update'])}}" aria-haspopup="true">
                            <a href="{{ route('admin.branchs.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{translate('All Branches')}}</span>
                                
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>
    @endif
@endif
