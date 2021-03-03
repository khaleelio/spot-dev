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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ translate('Add New Category') }}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard') }}" class="text-muted">{{ translate('Dashboard') }}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.articles.index') }}"
                                class="text-muted">{{ translate('Articles') }}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted">{{ translate('Add New Article') }}</a>
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


@section('content')

    <div class="row">
        <div class="col-lg-7 mx-auto">
            <div class="card card-custom gutter-b example example-compact">
                <form class="form" action="{{ route('admin.articles.store') }}" id="kt_form_1" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h6 class="fw-600 mb-0">{{ translate('Add New Article') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">{{ translate('Title') }} <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" placeholder="Title" name="title"
                                    value="{{ old('title') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="slug">{{ translate('Link') }} <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span
                                            class="input-group-text">{{ route('home') }}/[{{ translate('Category Name') }}]/</span>
                                    </div>
                                    <input type="text" class="form-control" id="slug"
                                        placeholder="{{ translate('Slug') }}" value="{{ old('slug') }}" name="slug"
                                        required>
                                </div>
                                <small
                                    class="form-text text-muted">{{ translate('Use character, number, hypen only') }}</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 col-from-label" for="type">{{ translate('Format') }}</label>
                            <div class="col-lg-10">
                                <div class="aiz-radio-inline" id="type">
                                    <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip"
                                        data-title="{{ translate('Article') }}">
                                        <input type="radio" name="type" value="article" checked>
                                        <span
                                            class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                            <i class="las la-file la-flip-horizontal la-2x"></i>
                                        </span>
                                    </label>
                                    <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip"
                                        data-title="{{ translate('Video') }}">
                                        <input type="radio" name="type" value="video">
                                        <span
                                            class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                            <i class="las la-video la-flip-horizontal la-2x"></i>
                                        </span>
                                    </label>
                                    <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip"
                                        data-title="{{ translate('Audio') }}">
                                        <input type="radio" name="type" value="audio">
                                        <span
                                            class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                            <i class="las la-audio-description la-flip-horizontal la-2x"></i>
                                        </span>
                                    </label>
                                    <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip"
                                        data-title="{{ translate('Gallery') }}">
                                        <input type="radio" name="type" value="gallery">
                                        <span
                                            class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                            <i class="las la-images la-flip-horizontal la-2x"></i>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">{{ translate('Category') }}</label>
                            <div class="col-sm-10">
                                <div class="widget meta-boxes">
                                    <div class="widget-body">
                                        <div class="form-group form-group-no-margin ">
                                            <div class="multi-choices-widget list-item-checkbox mCustomScrollbar _mCS_1 mCS-autoHide mCS_no_scrollbar"
                                                style="position: relative; overflow: visible; padding: 0px;">
                                                <div id="mCSB_1"
                                                    class="mCustomScrollBox mCS-minimal-dark mCSB_vertical_horizontal mCSB_outside"
                                                    style="max-height: 320px;" tabindex="0">
                                                    <div id="mCSB_1_container"
                                                        class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y mCS_x_hidden mCS_no_scrollbar_x"
                                                        style="position: relative; top: 0px; left: 0px;max-height: 250px;overflow: auto;"
                                                        dir="ltr">
                                                        <ul style="list-style: none;">
                                                            @forelse($categories as $key => $category)
                                                                <li value="{{$key}}">
                                                                    <label>
                                                                        <input type="checkbox" value="{{$category->id}}" name="categories[]">
                                                                        {{$category->title}}
                                                                    </label>
                                                                    @if(count($category->children))
                                                                        @include('blog.backend.articles.sub_category_list',['subcategories' => $category->children])
                                                                    @endif
                                                                </li>
                                                            @empty

                                                            @endforelse
                                                            {{-- <li value="2">
                                                                <label>
                                                                    <input type="checkbox" value="2" name="categories[]">
                                                                    Travel
                                                                </label>
                                                                <ul>
                                                                    <li value="3">
                                                                        <label>
                                                                            <input type="checkbox" value="3"
                                                                                name="categories[]">
                                                                            Guides
                                                                        </label>
                                                                    </li>
                                                                </ul>
                                                            </li> --}}
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div id="mCSB_1_scrollbar_vertical"
                                                    class="mCSB_scrollTools mCSB_1_scrollbar mCS-minimal-dark mCSB_scrollTools_vertical"
                                                    style="display: none;">
                                                    <div class="mCSB_draggerContainer">
                                                        <div id="mCSB_1_dragger_vertical" class="mCSB_dragger"
                                                            style="position: absolute; min-height: 50px; height: 0px; top: 0px;"
                                                            oncontextmenu="return false;">
                                                            <div class="mCSB_dragger_bar" style="line-height: 50px;"></div>
                                                            <div class="mCSB_draggerRail"></div>
                                                        </div>
                                                        <div id="mCSB_1_scrollbar_horizontal"
                                                            class="mCSB_scrollTools mCSB_1_scrollbar mCS-minimal-dark mCSB_scrollTools_horizontal"
                                                            style="display: none;">
                                                            <div class="mCSB_draggerContainer">
                                                                <div id="mCSB_1_dragger_horizontal" class="mCSB_dragger"
                                                                    style="position: absolute; min-width: 50px; width: 0px; left: 0px;"
                                                                    oncontextmenu="return false;">
                                                                    <div class="mCSB_dragger_bar"></div>
                                                                    <div class="mCSB_draggerRail"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">{{ translate('Tags') }}</label>
                            <div class="col-sm-10">
                                <input id="kt_tagify_2" name="tags[]" class="form-control tagify" placeholder='type...'
                                    value='' data-blacklist='.NET,PHP' />
                                <div class="mt-3 text-muted">In this example, the field is pre-occupied with 3 tags, and
                                    last tag is not included in the whitelist, and will be removed because the enforce
                                    whitelist option flag is set to true</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">{{ translate('Featured Image') }}</label>
                            <div class="col-sm-10">
                                <div class="input-group " data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ translate('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="featured_image" class="selected-files"
                                        value="{{ old('featured_image') }}">
                                </div>
                                <div class="file-preview">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row d-none article_type" id="video_type">
                            <label class="col-sm-2 col-from-label" for="video_link">{{ translate('Video Link') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Video Link"
                                    value="{{ old('video_link') }}" name="video_link" required>
                            </div>
                        </div>

                        <div class="form-group row d-none article_type" id="audio_type">
                            <label class="col-sm-2 col-from-label" for="voice_link">{{ translate('Voice Link') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Voice Link"
                                    value="{{ old('voice_link') }}" name="voice_link" required>
                            </div>
                        </div>

                        <div class="form-group row d-none article_type" id="gallery_type">
                            <label class="col-sm-2 col-from-label" for="name">{{ translate('Gallery') }}</label>
                            <div class="col-sm-10">
                                <div class="input-group " data-toggle="aizuploader" data-type="image" data-multiple="true">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ translate('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="gallery" class="selected-files"
                                        value="{{ old('gallery') }}">
                                </div>
                                <div class="file-preview">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label">{{ translate('Excerpt') }}</label>
                            <div class="col-sm-10">
                                <textarea name="excerpt" rows="8" class="form-control">{{ old('excerpt') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">{{ translate('Article Content') }} <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea class="aiz-text-editor form-control"
                                    data-buttons='[["font", ["bold", "underline", "italic", "clear"]],["para", ["ul", "ol", "paragraph"]],["style", ["style"]],["color", ["color"]],["table", ["table"]],["insert", ["link", "picture", "video"]],["view", ["fullscreen", "codeview", "undo", "redo"]]]'
                                    placeholder="Content.." data-min-height="300" name="content"
                                    required>{{ old('content') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="voice_link">{{ translate('Publish') }}</label>
                            <div class="col-sm-10">
                                <span class="switch switch-success">
                                    <label>
                                        <input type="checkbox" checked="checked" name="published" value="1" checked />
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card-header">
                        <h6 class="fw-600 mb-0">{{ translate('Seo Fields') }}</h6>
                    </div>
                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">{{ translate('Meta Title') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Title" name="meta_title"
                                    value="{{ old('meta_title') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">{{ translate('Meta Description') }}</label>
                            <div class="col-sm-10">
                                <textarea class="resize-off form-control" placeholder="Description"
                                    name="meta_description">{{ old('meta_description') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">{{ translate('Keywords') }}</label>
                            <div class="col-sm-10">
                                <textarea class="resize-off form-control" placeholder="Keyword, Keyword"
                                    name="keywords">{{ old('keywords') }}</textarea>
                                <small class="text-muted">{{ translate('Separate with coma') }}</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label" for="name">{{ translate('Meta Image') }}</label>
                            <div class="col-sm-10">
                                <div class="input-group " data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ translate('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="meta_image" class="selected-files">
                                </div>
                                <div class="file-preview">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">{{ translate('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script type="text/javascript">
        $(document).ready(function() {
            $('#type label').on('click', function() {
                $('.article_type').addClass('d-none');
                var type = $(this).find('input').val();
                switch (type) {
                    case 'video':
                        $('#video_type').removeClass('d-none');
                        break;
                    case 'audio':
                        $('#audio_type').removeClass('d-none');
                        break;
                    case 'gallery':
                        $('#gallery_type').removeClass('d-none');
                        break;

                    default:
                        break;
                }
            });

            $('#title').on('change', function() {
                $('#slug').attr('disabled', true);
                $.get('{{ route('admin.articles.checkslug') }}', {
                        'title': $(this).val()
                    },
                    function(data) {
                        $('#slug').val(data.slug);
                        $('#slug').attr('disabled', false);
                    }
                );
            });
            $('#kt_multipleselectsplitter_2').multiselectsplitter();
        });
        FormValidation.formValidation(
            document.getElementById('kt_form_1'), {
                fields: {
                    title: {
                        validators: {
                            notEmpty: {
                                message: '{{ translate('This is required!') }}'
                            }
                        }
                    },

                    slug: {
                        validators: {
                            notEmpty: {
                                message: '{{ translate('This is required!') }}'
                            }
                        }
                    },
                    content: {
                        validators: {
                            notEmpty: {
                                message: '{{ translate('This is required!') }}'
                            },
                            stringLength: {
                                min: 100,
                                message: '{{ translate('This must have at least 100 characters!') }}'
                            },
                        }
                    },
                },

                plugins: {
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                    // Validate fields when clicking the Submit button
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    // Submit the form when all fields are valid
                    defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                    icon: new FormValidation.plugins.Icon({
                        valid: 'fa fa-check',
                        invalid: 'fa fa-times',
                        validating: 'fa fa-refresh',
                    }),
                }
            }
        );

        var e = document.getElementById("kt_tagify_2");
        new Tagify(e, {
            enforceWhitelist: false,
            whitelist: [
                @forelse($tags as $tag)
                    {"value":"{{$tag->title}}", "id":"{{$tag->id}}"},
                @empty
                    ""
                @endforelse
            ],
            callbacks: {
                add: console.log,
                remove: console.log
            }
        });

    </script>

@endsection
