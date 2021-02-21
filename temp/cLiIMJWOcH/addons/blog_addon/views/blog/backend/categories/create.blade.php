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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ translate('Add New Category')}}</h5>
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
                            <a href="#" class="text-muted">{{ translate('Add New Category')}}</a>
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
			<form class="form" action="{{ route('admin.categories.store') }}" id="kt_form_1" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="card-header">
					<h6 class="fw-600 mb-0">{{ translate('Add New Category') }}</h6>
				</div>
				<div class="card-body">
					<div class="form-group row">
						<label class="col-sm-2 col-from-label" for="name">{{translate('Title')}} <span class="text-danger">*</span></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{ old('title') }}" required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-from-label" for="slug">{{translate('Link')}} <span class="text-danger">*</span></label>
						<div class="col-sm-10">
							<div class="input-group">
								<div class="input-group-prepend"><span class="input-group-text">{{ route('home') }}/</span></div>
								<input type="text" class="form-control" id="slug" placeholder="{{ translate('Slug') }}" value="{{ old('slug') }}" name="slug" required>
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
									<input type="hidden" name="thumb" class="selected-files" value="{{old('thumb')}}">
							</div>
							<div class="file-preview">
							</div>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-from-label">{{translate('Description')}}</label>
						<div class="col-sm-10">
							<textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
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
								<input type="text" class="form-control" placeholder="Title" name="meta_title" value="{{ old('meta_title') }}">
							</div>
					</div>

					<div class="form-group row">
							<label class="col-sm-2 col-from-label" for="name">{{translate('Meta Description')}}</label>
							<div class="col-sm-10">
								<textarea class="resize-off form-control" placeholder="Description" name="meta_description">{{ old('meta_description') }}</textarea>
							</div>
					</div>

					<div class="form-group row">
							<label class="col-sm-2 col-from-label" for="name">{{translate('Keywords')}}</label>
							<div class="col-sm-10">
								<textarea class="resize-off form-control" placeholder="Keyword, Keyword" name="keywords">{{ old('keywords') }}</textarea>
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
										<input type="hidden" name="meta_image" class="selected-files">
								</div>
								<div class="file-preview">
								</div>
							</div>
					</div>
				</div>
				<div class="card-footer">
					<button type="submit" class="btn btn-primary mr-2">{{translate('Save')}}</button>
				</div>
			</form>
		</div>
    </div>
</div>

@endsection

@section('script')

	<script type="text/javascript">
   		$(document).ready(function(){
			$('#title').on('change', function(){
				$('#slug').attr('disabled',true);
				$.get('{{route('admin.categories.checkslug')}}',
					{'title': $(this).val()},
					function( data ) {
						$('#slug').val(data.slug);
						$('#slug').attr('disabled',false);
					}
				);
			});
		});
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