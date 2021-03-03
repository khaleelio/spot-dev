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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ translate('Edit') }} {{ $category->title }}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard')}}" class="text-muted">{{translate('Dashboard')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.categories.index')}}" class="text-muted">{{ translate('Categories')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted">{{ translate('Edit') }} {{ $category->title }}</a>
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

		<!--begin::Card-->
		<div class="card card-custom gutter-b example example-compact">
			<div class="card-header card-header-tabs-line">
				<div class="card-title">
					<h3 class="card-label">{{ translate('Edit') }} {{ $category->title }}</h3>
				</div>
				<div class="card-toolbar">
					<ul class="nav nav-tabs nav-bold nav-tabs-line">
						
						@foreach (\App\Language::all() as $key => $language)
							<li class="nav-item">
								<a class="nav-link @if ($language->code == $lang) active @endif" href="{{ route('admin.categories.edit', ['id'=>$category->id, 'lang'=> $language->code] ) }}" href="#kt_tab_pane_1_3">
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
		
			<form class="form" action="{{ route('admin.categories.update', $category->id) }}" id="kt_form_1" method="POST" enctype="multipart/form-data">
				@csrf
				<input type="hidden" name="lang" value="{{ $lang }}">
				<div class="card-body">
					<div class="form-group row">
						<label class="col-sm-2 col-from-label" for="name">{{translate('Title')}} <span class="text-danger">*</span></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{ $category->getTranslation('title',$lang) }}" required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-from-label" for="slug">{{translate('Link')}} <span class="text-danger">*</span></label>
						<div class="col-sm-10">
							<div class="input-group">
								<div class="input-group-prepend"><span class="input-group-text">{{ route('home') }}/</span></div>
								<input type="text" class="form-control" id="slug" placeholder="{{ translate('Slug') }}" value="{{ $category->slug }}" name="slug" required>
							</div>
							<small class="form-text text-muted">{{ translate('Use character, number, hypen only') }}</small>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-from-label" for="name">{{translate('Thumbnail')}}</label>
						<div class="col-sm-10">
							<div class="input-group " data-toggle="aizuploader" data-type="image">
									<div class="input-group-prepend">
										<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
									</div>
									<div class="form-control file-amount">{{ translate('Choose File') }}</div>
									<input type="hidden" name="thumb" class="selected-files" value="{{ $category->thumb }}">
							</div>
							<div class="file-preview">
							</div>
						</div>
					</div>

					
					<div class="form-group row">
						<label class="col-sm-2 col-from-label">{{translate('Parent Category')}}</label>
						<div class="col-sm-10">
							<select name="parent_category" class="form-control aiz-selectpicker" data-live-search="true">
								@if ($category->parent_id)
									<option value="">{{translate('Parent Category')}}</option>
									@forelse($categories as $main_category)
										<option value="{{$main_category->id}}"
											@if ($main_category->id == $category->parent_id)
												selected
											@endif
											>{{$main_category->title}}</option>
									@empty
	
									@endforelse
								@else
									<option value="" selected>{{translate('Parent Category')}}</option>
									@forelse($categories as $category)
										<option value="{{$category->id}}">{{$category->title}}</option>
									@empty
	
									@endforelse
								@endif
								
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-from-label">{{translate('Description')}}</label>
						<div class="col-sm-10">
							<textarea name="description" rows="4" class="form-control">{{ $category->getTranslation('description',$lang) }}</textarea>
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
								<input type="text" class="form-control" placeholder="Title" name="meta_title" value="{{ $category->getTranslation('meta_title',$lang) }}">
							</div>
					</div>

					<div class="form-group row">
							<label class="col-sm-2 col-from-label" for="name">{{translate('Meta Description')}}</label>
							<div class="col-sm-10">
								<textarea class="resize-off form-control" placeholder="Description" name="meta_description">{{ $category->getTranslation('meta_description',$lang) }}</textarea>
							</div>
					</div>

					<div class="form-group row">
							<label class="col-sm-2 col-from-label" for="name">{{translate('Keywords')}}</label>
							<div class="col-sm-10">
								<textarea class="resize-off form-control" placeholder="Keyword, Keyword" name="keywords">{{ $category->getTranslation('keywords',$lang) }}</textarea>
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
										<input type="hidden" name="meta_image" class="selected-files" value="{{ $category->meta_image }}">
								</div>
								<div class="file-preview">
								</div>
							</div>
					</div>
				</div>
				<div class="card-footer">
					<button type="submit" class="btn btn-primary mr-2">{{translate('Update')}}</button>
				</div>
			</form>
		</div>
		<!--end::Card-->
    </div>
</div>
@endsection


@section('script')

	<script type="text/javascript">
		FormValidation.formValidation(
			document.getElementById('kt_form_1'),
			{
				fields: {
					title: {
						validators: {
							notEmpty: {
								message: '{{translate("This is required!")}}'
							}
						}
					},

					slug: {
						validators: {
							notEmpty: {
								message: '{{translate("This is required!")}}'
							}
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
	</script>

@endsection