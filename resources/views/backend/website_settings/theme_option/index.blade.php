@extends('backend.layouts.app')



@section('subheader')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ translate('Theme Options') }}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm mr-5">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard')}}" class="text-muted">{{translate('Dashboard')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted">{{ translate('Theme Options') }}</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
@endsection

@section('style')
    {{-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" /> --}}
    <style>
        .green-border{
            border: 1px solid #B9BABC;
            box-shadow: 0 0 0 0.2rem rgba(139, 195, 74, .25);
        }
        .dropdown-menu{
            /* max-height: 100% !important; */
            z-index: 100 !important;
        }
        .social-links{
            font-family: fontAwesome
        }
        .button-add-icon >button{
            color: #ffffff;
            background-color: #0BB7AF;
            border-color: #0BB7AF;
            transition: color 0.15s ease, background-color 0.15s ease, border-color 0.15s ease, box-shadow 0.15s ease, -webkit-box-shadow 0.15s ease;
            box-shadow: none;
            cursor: pointer;
            text-decoration: none;
            outline: none !important;
            vertical-align: middle;
            display: inline-block;
            font-weight: normal;
            border: 1px solid transparent;
            padding: 0.65rem 1rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.42rem;
            user-select: none;
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Aclonica|Allan|Annie+Use+Your+Telescope|Anonymous+Pro|Allerta+Stencil|Allerta|Amaranth|Anton|Archivo|Architects+Daughter|Arimo|Artifika|Arvo|Asset|Astloch|Bangers|Bentham|Bevan|Bigshot+One|Bowlby+One|Bowlby+One+SC|Brawler|Buda%3A300|Cabin|Calligraffitti|Candal|Cantarell|Cardo|Carter+One|Caudex|Cedarville+Cursive|Cherry+Cream+Soda|Chewy|Coda|Coming+Soon|Copse|Corben%3A700|Cousine|Covered+By+Your+Grace|Crafty+Girls|Crimson+Text|Crushed|Cuprum|Damion|Dancing+Script|Dawning+of+a+New+Day|DM+Sans|Didact+Gothic|Droid+Sans|Droid+Sans+Mono|Droid+Serif|EB+Garamond|Expletus+Sans|Fontdiner+Swanky|Forum|Francois+One|Geo|Give+You+Glory|Goblin+One|Goudy+Bookletter+1911|Gravitas+One|Gruppo|Hammersmith+One|Holtwood+One+SC|Homemade+Apple|Inconsolata|Indie+Flower|IM+Fell+DW+Pica|IM+Fell+DW+Pica+SC|IM+Fell+Double+Pica|IM+Fell+Double+Pica+SC|IM+Fell+English|IM+Fell+English+SC|IM+Fell+French+Canon|IM+Fell+French+Canon+SC|IM+Fell+Great+Primer|IM+Fell+Great+Primer+SC|Irish+Grover|Irish+Growler|Istok+Web|Josefin+Sans|Josefin+Slab|Judson|Jura|Jura%3A500|Jura%3A600|Just+Another+Hand|Just+Me+Again+Down+Here|Kameron|Kenia|Kranky|Kreon|Kristi|La+Belle+Aurore|Lato%3A100|Lato%3A100italic|Lato%3A300|Lato|Lato%3Abold|Lato%3A900|League+Script|Lekton|Limelight|Lobster|Lobster+Two|Lora|Love+Ya+Like+A+Sister|Loved+by+the+King|Luckiest+Guy|Maiden+Orange|Mako|Maven+Pro|Maven+Pro%3A500|Maven+Pro%3A700|Maven+Pro%3A900|Meddon|MedievalSharp|Megrim|Merriweather|Metrophobic|Michroma|Miltonian+Tattoo|Miltonian|Modern+Antiqua|Monofett|Molengo|Montserrat|Mountains+of+Christmas|Muli%3A300|Muli|Neucha|Neuton|News+Cycle|Nixie+One|Nobile|Noto+Sans|Nova+Cut|Nova+Flat|Nova+Mono|Nova+Oval|Nova+Round|Nova+Script|Nova+Slim|Nova+Square|Nunito%3Alight|Nunito|Nunito+Sans|OFL+Sorts+Mill+Goudy+TT|Old+Standard+TT|Open+Sans%3A300|Open+Sans|Open+Sans%3A600|Open+Sans%3A800|Open+Sans+Condensed%3A300|Orbitron|Orbitron%3A500|Orbitron%3A700|Orbitron%3A900|Oswald|Over+the+Rainbow|Reenie+Beanie|Pacifico|Patrick+Hand|Paytone+One|Permanent+Marker|Philosopher|Play|Playfair+Display|Podkova|Poppins|PT+Sans|PT+Sans+Narrow|PT+Sans+Narrow%3Aregular%2Cbold|PT+Serif|PT+Serif+Caption|Puritan|Quattrocento|Quattrocento+Sans|Radley|Raleway|Raleway%3A100|Redressed|Rock+Salt|Rokkitt|Roboto|Roboto+Condensed|Roboto+Slab|Ruslan+Display|Schoolbell|Shadows+Into+Light|Shanti|Sigmar+One|Six+Caps|Slackey|Smythe|Sniglet%3A800|Special+Elite|Stardos+Stencil|Sue+Ellen+Francisco|Sunshiney|Swanky+and+Moo+Moo|Syncopate|Tajawal|Tangerine|Tenor+Sans|Terminal+Dosis+Light|The+Girl+Next+Door|Tinos|Ubuntu|Ultra|Unkempt|UnifrakturCook%3Abold|UnifrakturMaguntia|Varela|Varela+Round|Vibur|Vollkorn|VT323|Waiting+for+the+Sunrise|Wallpoet|Walter+Turncoat|Wire+One|Work+Sans|Yanone+Kaffeesatz|Yanone+Kaffeesatz%3A300|Yanone+Kaffeesatz%3A400|Yanone+Kaffeesatz%3A700|Yeseva+One|Zeyada" rel="stylesheet" type="text/css">
    <link href="{{ static_asset('assets/colorpicker/dist/css/bootstrap-colorpicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ static_asset('assets/iconpicker/dist/fontawesome-5.11.2/css/all.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ static_asset('assets/iconpicker/dist/iconpicker-1.5.0.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <div class="content pt-0 d-flex flex-column flex-column-fluid">
        {{-- $settingsUI = $appSettings->loadConfig(config('app_settings', []));
        foreach ($settingsUI['sections'] as $section => $value) {
            return $value;
        }
        // return $settingsUI['sections']; --}}

        <!--begin::Card-->
        <div class="card mb-8" style="min-height: 320px;">
            <!--begin::Body-->
            <div class="card-body p-10">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6 col-md-3 col-lg-2">
                        <!--begin::Navigation-->
                        <ul class="navi navi-link-rounded navi-accent navi-hover navi-active nav flex-column mb-8 mb-lg-0" role="tablist">
                            @php
                                $counter = 0;
                            @endphp
                            @forelse ($settings as $key => $section)
                                @if ($active_theme != $section['theme'])
                                    @continue
                                @endif
                                <!--begin::Nav Item-->
                                <li class="navi-item mb-2">
                                    <a class="navi-link @if($counter == 0) active @endif" data-toggle="tab" href="#{{$key}}">
                                        <span class="navi-text text-dark-50 font-size-h5 font-weight-bold">{{$section['title'] ?? $section['name']}}</span>
                                    </a>
                                </li>
                                <!--end::Nav Item-->
                                @php
                                    $counter++;
                                @endphp
                            @empty

                            @endforelse
                        </ul>
                        <!--end::Navigation-->
                    </div>
                    <div class="col-sm-6 col-md-9 col-lg-10">
                        <!--begin::Tab Content-->
                        <div class="tab-content">
                            <!--begin::Accordion-->
                            <div class="accordion accordion-light accordion-light-borderless accordion-svg-toggle" id="faq">
                                <form method="post" action="{{ url(config('app_settings.url')) }}" class="form-horizontal mb-3" enctype="multipart/form-data" role="form"  id="kt_form">
                                    {!! csrf_field() !!}
                                    <div class="tab-content">
                                        @php
                                            $counter = 0;
                                        @endphp
                                        @forelse ($settings as $key => $section)
                                            @if ($active_theme != $section['theme'])
                                                @continue
                                            @endif
                                            <!--begin::Tab-->
                                            @if($counter == 0)
                                                <div class="tab-pane show px-7 active" id="{{$key}}" role="tabpanel">
                                            @else
                                                <div class="tab-pane show px-7" id="{{$key}}" role="tabpanel">
                                            @endif
                                                <!--begin::Row-->
                                                <div class="row">
                                                    <div class="col-xl-12 my-2">
                                                        @forelse ($section['inputs'] as $field)
                                                            <!--begin::Group-->
                                                            {{-- @if(!view()->exists('app_settings::fields.' . $field['type']))
                                                                <div style="background-color: #f7ecb5; box-shadow: inset 2px 2px 7px #e0c492; border-radius: 0.3rem; padding: 1rem; margin-bottom: 1rem">
                                                                    Defined setting <strong>{{ $field['name'] }}</strong> with
                                                                    type <code>{{ $field['type'] }}</code> field is not supported. <br>
                                                                    You can create a <code>fields/{{ $field['type'] }}.balde.php</code> to render this input however you want.
                                                                </div>
                                                            @endif --}}
                                                            @includeIf('app_settings::fields.' . $field['type'] )
                                                            <!--end::Group-->
                                                        @empty
                                                            
                                                        @endforelse
                                                    </div>
                                                </div>
                                                <!--end::Row-->
                                            </div>
                                            <!--end::Tab-->
                                            @php
                                                $counter++;
                                            @endphp
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
            {{-- <!-- Button tag -->
            <button class="btn btn-secondary" role="iconpicker"></button>
            <!-- Div tag -->
            <div role="iconpicker"></div> --}}
            {{-- <button class="btn btn-secondary iconpicker dropdown-toggle" role="iconpicker">
                <i class="empty"></i>
                <input type="hidden" value="empty">
                <span class="caret"></span>
            </button> --}}
       </div>
    </div>

@endsection

@section('modal')

@endsection

@section('script')
    <script>
        // var select = document.getElementById('primary_font_test');
        // console.log(select.length);
        // console.log(select.options[0].value);
        // console.log(select.options[0].innerHTML);
        // var text = '';
        // for (let index = 0; index < select.length; index++) {
        //     text += "'" + select.options[index].value + "' => '" + select.options[index].value + "'," ;
            
        // }
        // console.log(text);
    </script>
    <script src="{{ static_asset('assets/iconpicker/dist/iconpicker-1.5.0.js') }}" ></script>
    <script src="{{ static_asset('assets/colorpicker/dist/js/bootstrap-colorpicker.js') }}" ></script>
    <script>
        $(function () {
            var input_colors = document.getElementsByClassName('color-picker-input');
            var text = '';
            for (let index = 0; index < input_colors.length; index++) {
                text += '#'+ input_colors[index].id + "-div, ";
            }
            text = text.substring(0, text.length-2);
            $(text).colorpicker({
                autoInputFallback: false
            });
        });

        IconPicker.Init({
            jsonUrl: '{{ static_asset('assets/iconpicker/dist/iconpicker-1.5.0.json') }}',
        });
        var iconpicker_ids = [];
        function iconpicker(){
            var icon_buttons = document.getElementsByClassName('icon-picker');
            for (let index = 0; index < icon_buttons.length; index++) {
                IconPicker.Run('#'+icon_buttons[index].id);
                iconpicker_ids.push(icon_buttons[index].id);
            }
            console.log('function iconpicker():');
            console.log(iconpicker_ids);
        }
        iconpicker();

        function add_row(){
            var values = [];
            var x = document.getElementsByClassName("{{$active_theme}}_social_links_name");
            for (let index = 0; index < x.length; index++) {
                values.push(x[index].value ?? "");
            }

            var content = document.getElementById('content_rows');
            var count = iconpicker_ids.length +1 ;
            content.innerHTML += row_content(count);
            for (let index = 0; index < x.length; index++) {
                x[index].value = values[index] ?? "";
            }

            iconpicker_ids.push('GetIconPicker-'+count);
            for (let index = 0; index < iconpicker_ids.length; index++) {
                if(document.getElementById(iconpicker_ids[index])){
                    IconPicker.Run('#'+iconpicker_ids[index]);
                }
            }
            console.log(iconpicker_ids);
        }

        function row_content(id) {
            var row= `<div class="row gutters-5">
                    <div class="col-5">
                        <div class="form-group">
                            <input type="text" class="form-control {{$active_theme}}_social_links_name" placeholder="https://" name="{{$active_theme}}_social_links_name[]">
                        </div>
                    </div>
                    <div class="col-3 button-add-icon">
                        <button type="button" id="GetIconPicker-`+id+`" data-iconpicker-input="#MyIconInput-`+id+`" data-iconpicker-preview="#MyIconPreview-`+id+`" class="icon-picker">Select Icon</button>
                        <input type="hidden" name="{{$active_theme}}_social_links_icon[]" id="MyIconInput-`+id+`">
                    </div>
                    <div class="col-2">
                        <i id="MyIconPreview-`+id+`" style="font-size: 35px;color: black;"></i>
                    </div>
                    <div class="col-2">
                        <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-03-11-144509/theme/html/demo1/dist/../src/media/svg/icons/Code/Error-circle.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                    <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>
                                </g>
                            </svg><!--end::Svg Icon--></span>
                        </button>
                    </div>
                </div>`;  
            return row;
            
        }
        
    </script>
@endsection
