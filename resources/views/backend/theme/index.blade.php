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
    <div class="row pad">
        @forelse ($themes as $theme)
            <div class="col-sm-6 col-md-4 col-lg-3">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$theme->title ?? $theme->name}}</h5>
                        <p class="card-text">{{$theme->description ?? ''}}</p>
                        @if ($theme->active == 1)
                                    <button class="btn btn-primary" disabled="disabled">
                                        <i class="fa fa-check"></i>
                                        {{ translate('Activated') }}
                                    </button>
                        @else
                            <form action="{{ route('website.theme.update.active') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$theme->id}}">
                                <button class="btn btn-primary">
                                    <i class="fas fa-times"></i>
                                    {{ translate('Inactivated') }}
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            
        @endforelse
    </div>

@endsection

@section('modal')

@endsection

@section('script')

@endsection
