@extends('backend.layouts.app')

@section('style')

@endsection

@section('content')

    <div class="content pt-0 d-flex flex-column flex-column-fluid">
        {{-- $settingsUI = $appSettings->loadConfig(config('app_settings', []));
        foreach ($settingsUI['sections'] as $section => $value) {
            return $value;
        }
        // return $settingsUI['sections']; --}}
        <div class="aiz-titlebar text-left mt-2 mb-3">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="h3">{{ translate('Theme Options') }}</h1>
                </div>
            </div>
        </div>

        <!--begin::Card-->
        <div class="card mb-8" style="min-height: 320px;">
            <!--begin::Body-->
            <div class="card-body p-10">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-lg-3">
                        <!--begin::Navigation-->
                        <ul class="navi navi-link-rounded navi-accent navi-hover navi-active nav flex-column mb-8 mb-lg-0" role="tablist">
                            @forelse ($settings as $key => $section)
                                <!--begin::Nav Item-->
                                <li class="navi-item mb-2">
                                    @if($loop->first)
                                        <a class="navi-link active" data-toggle="tab" href="#{{$key}}">
                                    @else
                                        <a class="navi-link" data-toggle="tab" href="#{{$key}}">
                                    @endif
                                        <span class="navi-text text-dark-50 font-size-h5 font-weight-bold">{{$section['title'] ?? $section['name']}}</span>
                                    </a>
                                </li>
                                <!--end::Nav Item-->
                            @empty

                            @endforelse
                        </ul>
                        <!--end::Navigation-->
                    </div>
                    <div class="col-lg-9">
                        <!--begin::Tab Content-->
                        <div class="tab-content">
                            <!--begin::Accordion-->
                            <div class="accordion accordion-light accordion-light-borderless accordion-svg-toggle" id="faq">
                                <form method="post" action="{{ route('website.theme.option.store') }}" class="form-horizontal mb-3" enctype="multipart/form-data" role="form"  id="kt_form">
                                    {!! csrf_field() !!}
                                    <div class="tab-content">
                                        @forelse ($settings as $key => $section)
                                            <!--begin::Tab-->
                                            @if($loop->first)
                                                <div class="tab-pane show px-7 active" id="{{$key}}" role="tabpanel">
                                            @else
                                                <div class="tab-pane show px-7" id="{{$key}}" role="tabpanel">
                                            @endif
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <div class="col-xl-2"></div>
                                                    <div class="col-xl-7 my-2">
                                                        @forelse ($section['inputs'] as $field)
                                                            <!--begin::Group-->
                                                            @if(!view()->exists('app_settings::fields.' . $field['type']))
                                                                <div style="background-color: #f7ecb5; box-shadow: inset 2px 2px 7px #e0c492; border-radius: 0.3rem; padding: 1rem; margin-bottom: 1rem">
                                                                    Defined setting <strong>{{ $field['name'] }}</strong> with
                                                                    type <code>{{ $field['type'] }}</code> field is not supported. <br>
                                                                    You can create a <code>fields/{{ $field['type'] }}.balde.php</code> to render this input however you want.
                                                                </div>
                                                            @endif
                                                            @includeIf('app_settings::fields.' . $field['type'] )
                                                            <!--end::Group-->
                                                        @empty
                                                            
                                                        @endforelse
                                                    </div>
                                                </div>
                                                <!--end::Row-->
                                            </div>
                                            <!--end::Tab-->
                                        @empty

                                        @endforelse
                                    </div>

                                    <div class="row m-b-md text-right">
                                        <div class="col-md-12">
                                            <button class="btn-primary btn">
                                                {{ Arr::get($settings, 'submit_btn_text', 'Save Settings') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--end::Accordion-->
                        </div>
                        <!--end::Tab Content-->
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Item-->
        
        <div class="row pad">
            {{-- @include('app_settings::_settings') --}}
        </div>
    </div>

@endsection

@section('modal')

@endsection

@section('script')
    <script>
        var select = document.getElementById('primary_font_test');
        // console.log(select.length);
        // console.log(select.options[0].value);
        // console.log(select.options[0].innerHTML);
        // var text = '';
        // for (let index = 0; index < select.length; index++) {
        //     text += "'" + select.options[index].value + "' => '" + select.options[index].value + "'," ;
            
        // }
        // console.log(text);
    </script>
@endsection
