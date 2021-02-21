<!-- Blog -->
@if (\App\Addon::where('unique_identifier', 'blog_addon')->first()->activated)
    @if(Auth::user()->user_type == 'admin' || in_array('1001', json_decode(Auth::user()->staff->role->permissions)))
        <li class="menu-item menu-item-submenu  {{ areActiveRoutes(['admin.articles.index','admin.articles.update','admin.articles.create','admin.categories.index','admin.categories.view','admin.categories.update','admin.categories.create','admin.tags.index','admin.tags.view','admin.tags.update','admin.tags.create','admin.comments.index','admin.comments.update'])}}" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
                <i class="menu-icon flaticon2-document"></i>
                <span class="menu-text">{{translate('Blog')}}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{translate('Blog')}}</span>
                        </span>
                    </li>
                    @if(Auth::user()->user_type == 'admin' || in_array('1001', json_decode(Auth::user()->staff->role->permissions)))
                        <li class="menu-item {{ areActiveRoutes(['admin.articles.index','admin.articles.update','admin.articles.create'])}}" aria-haspopup="true">
                            <a href="{{ route('admin.articles.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{translate('Articles')}}</span>
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()->user_type == 'admin' || in_array('1002', json_decode(Auth::user()->staff->role->permissions)))
                        <li class="menu-item {{ areActiveRoutes(['admin.categories.index','admin.categories.view','admin.categories.update','admin.categories.create'])}}" aria-haspopup="true">
                            <a href="{{ route('admin.categories.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{translate('Categories')}}</span>
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()->user_type == 'admin' || in_array('1003', json_decode(Auth::user()->staff->role->permissions)))
                        <li class="menu-item {{ areActiveRoutes(['admin.tags.index','admin.tags.view','admin.tags.update','admin.tags.create'])}}" aria-haspopup="true">
                            <a href="{{ route('admin.tags.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{translate('Tags')}}</span>
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()->user_type == 'admin' || in_array('1004', json_decode(Auth::user()->staff->role->permissions)))
                        <li class="menu-item {{ areActiveRoutes(['admin.comments.index','admin.comments.update'])}}" aria-haspopup="true">
                            <a href="{{ route('admin.comments.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{translate('Comments')}}</span>
                                @if(isset($pending_comments) && $pending_comments > 0)<span class="font-weight-bolder label label-xl label-light-success label-inline px-3 py-5 min-w-45px">{{ $pending_comments }}</span> @endif
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>
    @endif
@endif
