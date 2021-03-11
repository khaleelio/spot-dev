@extends('backend.layouts.app')

@section('style')
    <style>
        .green-border{
            border: 1px solid #B9BABC;
            box-shadow: 0 0 0 0.2rem rgba(139, 195, 74, .25);
        }
        .dropdown-menu{
            /* max-height: 100% !important; */
            z-index: 100 !important;
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Aclonica|Allan|Annie+Use+Your+Telescope|Anonymous+Pro|Allerta+Stencil|Allerta|Amaranth|Anton|Archivo|Architects+Daughter|Arimo|Artifika|Arvo|Asset|Astloch|Bangers|Bentham|Bevan|Bigshot+One|Bowlby+One|Bowlby+One+SC|Brawler|Buda%3A300|Cabin|Calligraffitti|Candal|Cantarell|Cardo|Carter+One|Caudex|Cedarville+Cursive|Cherry+Cream+Soda|Chewy|Coda|Coming+Soon|Copse|Corben%3A700|Cousine|Covered+By+Your+Grace|Crafty+Girls|Crimson+Text|Crushed|Cuprum|Damion|Dancing+Script|Dawning+of+a+New+Day|DM+Sans|Didact+Gothic|Droid+Sans|Droid+Sans+Mono|Droid+Serif|EB+Garamond|Expletus+Sans|Fontdiner+Swanky|Forum|Francois+One|Geo|Give+You+Glory|Goblin+One|Goudy+Bookletter+1911|Gravitas+One|Gruppo|Hammersmith+One|Holtwood+One+SC|Homemade+Apple|Inconsolata|Indie+Flower|IM+Fell+DW+Pica|IM+Fell+DW+Pica+SC|IM+Fell+Double+Pica|IM+Fell+Double+Pica+SC|IM+Fell+English|IM+Fell+English+SC|IM+Fell+French+Canon|IM+Fell+French+Canon+SC|IM+Fell+Great+Primer|IM+Fell+Great+Primer+SC|Irish+Grover|Irish+Growler|Istok+Web|Josefin+Sans|Josefin+Slab|Judson|Jura|Jura%3A500|Jura%3A600|Just+Another+Hand|Just+Me+Again+Down+Here|Kameron|Kenia|Kranky|Kreon|Kristi|La+Belle+Aurore|Lato%3A100|Lato%3A100italic|Lato%3A300|Lato|Lato%3Abold|Lato%3A900|League+Script|Lekton|Limelight|Lobster|Lobster+Two|Lora|Love+Ya+Like+A+Sister|Loved+by+the+King|Luckiest+Guy|Maiden+Orange|Mako|Maven+Pro|Maven+Pro%3A500|Maven+Pro%3A700|Maven+Pro%3A900|Meddon|MedievalSharp|Megrim|Merriweather|Metrophobic|Michroma|Miltonian+Tattoo|Miltonian|Modern+Antiqua|Monofett|Molengo|Montserrat|Mountains+of+Christmas|Muli%3A300|Muli|Neucha|Neuton|News+Cycle|Nixie+One|Nobile|Noto+Sans|Nova+Cut|Nova+Flat|Nova+Mono|Nova+Oval|Nova+Round|Nova+Script|Nova+Slim|Nova+Square|Nunito%3Alight|Nunito|Nunito+Sans|OFL+Sorts+Mill+Goudy+TT|Old+Standard+TT|Open+Sans%3A300|Open+Sans|Open+Sans%3A600|Open+Sans%3A800|Open+Sans+Condensed%3A300|Orbitron|Orbitron%3A500|Orbitron%3A700|Orbitron%3A900|Oswald|Over+the+Rainbow|Reenie+Beanie|Pacifico|Patrick+Hand|Paytone+One|Permanent+Marker|Philosopher|Play|Playfair+Display|Podkova|Poppins|PT+Sans|PT+Sans+Narrow|PT+Sans+Narrow%3Aregular%2Cbold|PT+Serif|PT+Serif+Caption|Puritan|Quattrocento|Quattrocento+Sans|Radley|Raleway|Raleway%3A100|Redressed|Rock+Salt|Rokkitt|Roboto|Roboto+Condensed|Roboto+Slab|Ruslan+Display|Schoolbell|Shadows+Into+Light|Shanti|Sigmar+One|Six+Caps|Slackey|Smythe|Sniglet%3A800|Special+Elite|Stardos+Stencil|Sue+Ellen+Francisco|Sunshiney|Swanky+and+Moo+Moo|Syncopate|Tajawal|Tangerine|Tenor+Sans|Terminal+Dosis+Light|The+Girl+Next+Door|Tinos|Ubuntu|Ultra|Unkempt|UnifrakturCook%3Abold|UnifrakturMaguntia|Varela|Varela+Round|Vibur|Vollkorn|VT323|Waiting+for+the+Sunrise|Wallpoet|Walter+Turncoat|Wire+One|Work+Sans|Yanone+Kaffeesatz|Yanone+Kaffeesatz%3A300|Yanone+Kaffeesatz%3A400|Yanone+Kaffeesatz%3A700|Yeseva+One|Zeyada" rel="stylesheet" type="text/css">
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
        <select class="form-control selectpicker" data-live-search="true" tabindex="null">
            <option data-tokens="ketchup mustard">Hot Dog, Fries and a Soda</option>
            <option data-tokens="mustard">Burger, Shake and a Smile</option>
            <option data-tokens="frosting">Sugar, Spice and all things nice</option>
        </select>

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
@endsection
