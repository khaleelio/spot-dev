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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ translate('Edit Page Information') }}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm mr-5">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard')}}" class="text-muted">{{translate('Dashboard')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('website.pages')}}" class="text-muted">{{translate('Website Pages')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted">{{ translate('Edit Page Information') }}</a>
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

	<div class="card card-custom">
		<div class="card-header card-header-tabs-line">
			<div class="card-toolbar">
				<ul class="nav nav-tabs nav-bold nav-tabs-line">
					@foreach (\App\Language::all() as $key => $language)
						<li class="nav-item">
							<a class="nav-link  @if ($language->code == $lang) active @endif" href="{{ route('custom-pages.edit', ['id'=>$page->slug, 'lang'=> $language->code] ) }}">
								<span class="nav-icon">
									<img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" height="11" class="mr-1">
								</span>
								<span class="nav-text">{{$language->name}}</span>
							</a>
						</li>
					@endforeach
				</ul>
			</div>
		</div>

		<form class="p-4" action="{{ route('custom-pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
			@csrf
			<input type="hidden" name="_method" value="PATCH">
			<input type="hidden" name="lang" value="{{ $lang }}">
			<div class="card-body">
				<div class="tab-content">
					<div class="tab-pane fade show active" role="tabpanel">
					
						<div class="card-header">
							<h6 class="fw-600 mb-0">{{ translate('Page Content') }}</h6>
						</div>
						<div class="card-body">
							<div class="form-group row">
								<label class="col-sm-2 col-from-label" for="name">{{translate('Title')}} <span class="text-danger">*</span> <i class="las la-language text-danger" title="{{translate('Translatable')}}"></i></label>
								<div class="col-sm-10">
									<input type="text" class="form-control" placeholder="Title" name="title" value="{{ $page->getTranslation('title',$lang) }}" required>
								</div>
							</div>


							<div class="form-group row">
								<label class="col-sm-2 col-from-label" for="name">{{translate('Link')}} <span class="text-danger">*</span></label>
								<div class="col-sm-10">
									<div class="input-group">
										@if($page->type == 'custom_page')
											<div class="input-group-prepend"><span class="input-group-text">{{ route('home') }}/</span></div>
											<input type="text" class="form-control" placeholder="{{ translate('Slug') }}" name="slug" value="{{ $page->slug }}">
										@else
											<input class="form-control" value="{{ route('home') }}/{{ $page->slug }}" disabled>
										@endif
									</div>
									<small class="form-text text-muted">{{ translate('Use character, number, hypen only') }}</small>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-2 col-from-label" for="name">{{translate('Add Content')}} <span class="text-danger">*</span></label>
								<div class="col-sm-10">
									<textarea
										class="aiz-text-editor form-control"
										placeholder="Content.."
										data-buttons='[["font", ["bold", "underline", "italic", "clear"]],["para", ["ul", "ol", "paragraph"]],["style", ["style"]],["color", ["color"]],["table", ["table"]],["insert", ["link", "picture", "video"]],["view", ["fullscreen", "codeview", "undo", "redo"]]]'
										data-min-height="300"
										name="content"
										required
									>@php echo $page->getTranslation('content',$lang); @endphp</textarea>
								</div>
							</div>
						</div>

						<div class="card-header">
							<h6 class="fw-600 mb-0">{{ translate('Seo Fields') }}</h6>
						</div>
						<div class="card-body">

							<div class="form-group row">
								<label class="col-sm-2 col-from-label" for="name">{{translate('Meta Title')}}</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" placeholder="Title" name="meta_title" value="{{ $page->meta_title }}">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-2 col-from-label" for="name">{{translate('Meta Description')}}</label>
								<div class="col-sm-10">
									<textarea class="resize-off form-control" placeholder="Description" name="meta_description">
										@php
											echo $page->meta_description
										@endphp
									</textarea>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-2 col-from-label" for="name">{{translate('Keywords')}}</label>
								<div class="col-sm-10">
									<textarea class="resize-off form-control" placeholder="Keyword, Keyword" name="keywords">
										@php
											echo $page->keywords
										@endphp
									</textarea>
									<small class="text-muted">{{ translate('Separate with coma') }}</small>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-2 col-from-label" for="name">{{translate('Meta Image')}}</label>
								<div class="col-sm-10">
									<div class="input-group " data-toggle="aizuploader" data-type="image">
											<div class="input-group-prepend">
													<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
											</div>
											<div class="form-control file-amount">{{ translate('Choose File') }}</div>
											<input type="hidden" name="meta_image" class="selected-files" value="{{ $page->meta_image }}">
									</div>
									<div class="file-preview">
									</div>
								</div>
							</div>

							<div class="text-right">
								<button type="submit" class="btn btn-primary">{{ translate('Update Page') }}</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
@endsection
