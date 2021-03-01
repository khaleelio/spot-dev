
<!--begin::Aside-->
<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">

    <!--begin::Brand-->
    <div class="brand flex-column-auto" id="kt_brand">

        <!--begin::Logo-->
        <a href="{{ route('admin.dashboard') }}" class="brand-logo">
            @if(get_setting('system_logo_white') != null)
                <img src="{{ uploaded_asset(get_setting('system_logo_white')) }}" alt="{{ get_setting('site_name') }}">
            @else
                <img src="{{ static_asset('assets/img/logo.svg') }}" alt="{{ get_setting('site_name') }}">
            @endif
        </a>

        <!--end::Logo-->
    </div>

    <!--end::Brand-->

    <!--begin::Aside Menu-->
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">

        <!--begin::Menu Container-->
        <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
            data-menu-dropdown-timeout="500">

            <!--begin::Menu Nav-->
            <ul class="menu-nav">
                <li class="menu-item {{ areActiveRoutes(['admin.dashboard'])}}" aria-haspopup="true">
                    <a href="{{ route('admin.dashboard') }}" class="menu-link">
                        <i class="menu-icon flaticon-home"></i>
                        <span class="menu-text">{{translate('Dashboard')}}</span>
                    </a>
                </li>
                @if (\App\Addon::where('activated', 1)->count() > 0)
                    <li class="menu-section">
                        <h4 class="menu-text">{{translate('Addons')}}</h4>
                        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                    </li>

                    @foreach(\File::files(base_path('resources/views/backend/inc/addons/')) as $path)
                        @include('backend.inc.addons.'.str_replace('.blade','',pathinfo($path)['filename']))
                    @endforeach
                @endif

                <li class="menu-section">
                    <h4 class="menu-text">{{translate('Administration')}}</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>

                <li class="menu-item {{ areActiveRoutes(['uploaded-files.index', 'uploaded-files.info', 'uploaded-files.create'])}}">
                    <a href="{{ route('uploaded-files.index') }}" class="menu-link">
                        <i class="menu-icon flaticon2-image-file"></i>
                        <span class="menu-text">{{ translate('Media') }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                </li>

                @if(Auth::user()->user_type == 'admin' || in_array('12', json_decode(Auth::user()->staff->role->permissions)))
                    <li class="menu-item menu-item-submenu  {{ areActiveRoutes(['support_ticket.admin_index','support_ticket.admin_show'])}}" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <i class="menu-icon flaticon-support"></i>
                            <span class="menu-text">{{translate('Support')}}</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item menu-item-parent" aria-haspopup="true">
                                    <span class="menu-link">
                                        <span class="menu-text">{{translate('Support')}}</span>
                                    </span>
                                </li>
                                @if(Auth::user()->user_type == 'admin' || in_array('13', json_decode(Auth::user()->staff->role->permissions)))
                                    @php
                                        $support_ticket = DB::table('tickets')
                                                    ->where('viewed', 0)
                                                    ->select('id')
                                                    ->count();
                                    @endphp
                                    <li class="menu-item   {{ areActiveRoutes(['support_ticket.admin_index','support_ticket.admin_show'])}}" aria-haspopup="true">
                                        <a href="{{ route('support_ticket.admin_index') }}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">{{translate('Ticket')}}</span>
                                            @if($support_ticket > 0)<span class="font-weight-bolder label label-xl label-light-success label-inline px-3 py-5 min-w-45px">{{ $support_ticket }}</span>@endif
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif

                @if(Auth::user()->user_type == 'admin' || in_array('13', json_decode(Auth::user()->staff->role->permissions)))
                    <li class="menu-item menu-item-submenu   {{ areActiveRoutes(['support_ticket.admin_index','website.header','website.footer','website.pages','website.appearance','website.menu.index','website.widget.index'])}}" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <i class="menu-icon flaticon2-website"></i>
                            <span class="menu-text">{{translate('Website')}}</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item menu-item-parent" aria-haspopup="true">
                                    <span class="menu-link">
                                        <span class="menu-text">{{translate('Website')}}</span>
                                    </span>
                                </li>
                                <li class="menu-item {{ areActiveRoutes(['website.header'])}}" aria-haspopup="true">
                                    <a href="{{ route('website.header') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{translate('Header')}}</span>
                                    </a>
                                </li>
                                <li class="menu-item {{ areActiveRoutes(['website.footer'])}}" aria-haspopup="true">
                                    <a href="{{ route('website.footer') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{translate('Footer')}}</span>
                                    </a>
                                </li>
                                <li class="menu-item  {{ areActiveRoutes(['website.pages'])}}" aria-haspopup="true">
                                    <a href="{{ route('website.pages') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{translate('Pages')}}</span>
                                    </a>
                                </li>
                                <li class="menu-item  {{ areActiveRoutes(['website.appearance'])}}" aria-haspopup="true">
                                    <a href="{{ route('website.appearance') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{translate('Appearance')}}</span>
                                    </a>
                                </li>
                                <li class="menu-item  {{ areActiveRoutes(['website.menu.index'])}}" aria-haspopup="true">
                                    <a href="{{ route('website.menu.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{translate('Menus')}}</span>
                                    </a>
                                </li>
                                <li class="menu-item  {{ areActiveRoutes(['website.widget.index'])}}" aria-haspopup="true">
                                    <a href="{{ route('website.widget.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{translate('Widget')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

                @if(Auth::user()->user_type == 'admin' || in_array('14', json_decode(Auth::user()->staff->role->permissions)))
                    <li class="menu-item menu-item-submenu {{ areActiveRoutes(['general_setting.index','activation.index','smtp_settings.index','languages.index', 'languages.create', 'languages.store', 'languages.show', 'languages.edit','file_system.index','google_analytics.index','facebook_chat.index','google_recaptcha.index'])}}" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <i class="menu-icon flaticon2-gear"></i>
                            <span class="menu-text">{{translate('Settings')}}</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item menu-item-parent" aria-haspopup="true">
                                    <span class="menu-link">
                                        <span class="menu-text">{{translate('Settings')}}</span>
                                    </span>
                                </li>
                                <li class="menu-item {{ areActiveRoutes(['general_setting.index'])}}" aria-haspopup="true">
                                    <a href="{{ route('general_setting.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{translate('General Settings')}}</span>
                                    </a>
                                </li>
                                <li class="menu-item {{ areActiveRoutes(['activation.index'])}}" aria-haspopup="true">
                                    <a href="{{ route('activation.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{translate('Features activation')}}</span>
                                    </a>
                                </li>
                                <li class="menu-item  {{ areActiveRoutes(['languages.index', 'languages.create', 'languages.store', 'languages.show', 'languages.edit'])}}" aria-haspopup="true">
                                    <a href="{{ route('languages.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{translate('Languages')}}</span>
                                    </a>
                                </li>
                                <li class="menu-item {{ areActiveRoutes(['smtp_settings.index'])}}" aria-haspopup="true">
                                    <a href="{{ route('smtp_settings.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{translate('SMTP Settings')}}</span>
                                    </a>
                                </li>
                                <li class="menu-item {{ areActiveRoutes(['file_system.index'])}}" aria-haspopup="true">
                                    <a href="{{ route('file_system.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{translate('File System Configuration')}}</span>
                                    </a>
                                </li>
                                <li class="menu-item {{ areActiveRoutes(['google_analytics.index'])}}" aria-haspopup="true">
                                    <a href="{{ route('google_analytics.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{translate('Analytics Tools')}}</span>
                                    </a>
                                </li>
                                <li class="menu-item {{ areActiveRoutes(['facebook_chat.index'])}}" aria-haspopup="true">
                                    <a href="{{ route('facebook_chat.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{translate('Facebook Chat')}}</span>
                                    </a>
                                </li>
                                <li class="menu-item {{ areActiveRoutes(['google_recaptcha.index'])}}" aria-haspopup="true">
                                    <a href="{{ route('google_recaptcha.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{translate('Google reCAPTCHA')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

                @if(Auth::user()->user_type == 'admin' || in_array('20', json_decode(Auth::user()->staff->role->permissions)))
                    <li class="menu-item menu-item-submenu  {{ areActiveRoutes(['staffs.index', 'staffs.create', 'staffs.edit','roles.index', 'roles.create', 'roles.edit'])}}" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <i class="menu-icon flaticon-users"></i>
                            <span class="menu-text">{{translate('Users')}}</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item menu-item-parent" aria-haspopup="true">
                                    <span class="menu-link">
                                        <span class="menu-text">{{translate('Users')}}</span>
                                    </span>
                                </li>
                                <li class="menu-item {{ areActiveRoutes(['staffs.index', 'staffs.create', 'staffs.edit'])}}" aria-haspopup="true">
                                    <a href="{{ route('staffs.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{translate('All Users')}}</span>
                                    </a>
                                </li>
                                <li class="menu-item {{ areActiveRoutes(['roles.index', 'roles.create', 'roles.edit'])}}" aria-haspopup="true">
                                    <a href="{{ route('roles.index') }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{translate('Users permissions')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

                <li class="menu-item menu-item-submenu {{ areActiveRoutes(['system_update', 'system_server'])}}" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <i class="menu-icon flaticon-information"></i>
                        <span class="menu-text">{{translate('System')}}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">{{translate('System')}}</span>
                                </span>
                            </li>
                            <li class="menu-item {{ areActiveRoutes(['system_update'])}}" aria-haspopup="true">
                                <a href="{{ route('system_update') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">{{translate('Update')}}</span>
                                </a>
                            </li>
                            <li class="menu-item {{ areActiveRoutes(['system_server'])}}" aria-haspopup="true">
                                <a href="{{ route('system_server') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">{{translate('Server status')}}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                @if(Auth::user()->user_type == 'admin' || in_array('21', json_decode(Auth::user()->staff->role->permissions)))
                    <li class="menu-item  {{ areActiveRoutes(['addons.index', 'addons.create'])}}" aria-haspopup="true">
                        <a href="{{ route('addons.index') }}" class="menu-link">
                            <i class="menu-icon flaticon2-cube"></i>
                            <span class="menu-text">{{translate('Addon Manager')}}</span>
                        </a>
                    </li>
                @endif
            </ul>

            <!--end::Menu Nav-->
        </div>

        <!--end::Menu Container-->
    </div>

    <!--end::Aside Menu-->
</div>
<!--end::Aside-->

        


