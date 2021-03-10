@extends('backend.layouts.app')

@section('style')

@endsection

@section('content')

    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h3">{{ translate('Themes') }}</h1>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="row pad">
            @forelse ($themes as $theme)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="thumbnail">
                        <div class="caption">
                            <div class="col-12" style="background: #eee; padding: 15px;">
                                <div style="word-break: break-all">
                                    <h4>{{$theme->name}}</h4>
                                </div>
                                <div class="clearfix"></div>
                                <div>
                                    @if ($theme->active == 1)
                                        <button class="btn btn-info" disabled="disabled">
                                            <i class="fa fa-check"></i>
                                            {{ translate('Activated') }}
                                        </button>
                                    @else
                                        <form action="{{ route('website.theme.update.active') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$theme->id}}">
                                            <button class="btn btn-info">
                                                <i class="fa fa-check"></i>
                                                {{ translate('Inactivated') }}
                                            </button>
                                        </form>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                
            @endforelse
        </div>
    </div>

@endsection

@section('modal')

@endsection

@section('script')

@endsection
