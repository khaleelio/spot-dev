@extends('backend.layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-7 mx-auto">
		<!--begin::Advance Table Widget 3-->
		<div class="card card-custom gutter-b">
			<!--begin::Header-->
			<div class="card-header border-0 py-5">
				<h3 class="card-title align-items-start flex-column">
					<span class="card-label font-weight-bolder text-dark">
						<span class="card-icon">
							<i class="flaticon2-document text-primary"></i>
						</span>
						{{ translate('Articles') }}
					</span>
				</h3>
				<div class="card-toolbar">
					<a href="{{ route('admin.articles.create') }}" class="btn btn-primary font-weight-bolder">
						<span class="svg-icon svg-icon-md">
							<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/Flatten.svg-->
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<circle fill="#000000" cx="9" cy="15" r="6" />
									<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
								</g>
							</svg>
							<!--end::Svg Icon-->
						</span>
						{{ translate('Add New Article') }}
					</a>
				</div>
			</div>
			<!--end::Header-->
			<!--begin::Body-->
			<div class="card-body pt-0 pb-3">
				<!--begin::Table-->
				<div class="table-responsive">
					<table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
						<thead>
							<tr class="text-uppercase">
								<th style="min-width: 20px">#</th>
								<th style="min-width: 250px" class="pl-7">
									<span class="text-dark-75">{{translate('Name')}}</span>
								</th>
								<th style="min-width: 120px">{{translate('Published')}}</th>
								<th style="min-width: 120px"></th>
							</tr>
						</thead>
						<tbody>
                			@forelse($articles as $key => $article)
								<tr>
									<td>
										<span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $key+1 }}</span>
									</td>
									<td class="pl-0 py-8">
										<div class="d-flex align-items-center">
											@if($article->featured_image)
											<div class="symbol symbol-50 flex-shrink-0 mr-4">
												<div class="symbol-label" style="background-image: url('{{ uploaded_asset($article->featured_image)}}')"></div>
											</div>
											@endif
											<div>
												<a href="{{route('admin.articles.edit', ['id'=>$article->id, 'lang'=>env('DEFAULT_LANGUAGE')] )}}" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $article->title }}</a>
											</div>
										</div>
									</td>
									<td>	
										<span class="switch switch-success">
											<label>
												<input type="checkbox" <?php if($article->published == 1) echo "checked";?> onchange="publish_status(this, '{{ $article->id }}')" name="published" value="1" />
												<span></span>
											</label>
										</span>
									</td>
									<td class="text-right pr-0">
										<a href="{{route('articles.view', ['slug'=>$article->slug] )}}" class="btn btn-icon btn-light btn-hover-primary btn-sm mr-3">
											<span class="svg-icon svg-icon-md svg-icon-primary">
												<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<polygon points="0 0 24 0 24 24 0 24" />
														<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
														<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
													</g>
												</svg>
												<!--end::Svg Icon-->
											</span>
										</a>
										<a href="{{route('admin.articles.edit', ['id'=>$article->id, 'lang'=>env('DEFAULT_LANGUAGE')] )}}" class="btn btn-icon btn-light btn-hover-primary btn-sm mr-3">
											<span class="svg-icon svg-icon-md svg-icon-primary">
												<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Write.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24"></rect>
														<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"></path>
														<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
													</g>
												</svg>
												<!--end::Svg Icon-->
											</span>
										</a>
										<a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm confirm-delete" data-href="{{ route('admin.articles.destroy', $article->id)}} " title="{{ translate('Delete') }}">
											<span class="svg-icon svg-icon-md svg-icon-primary">
												<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Trash.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24"></rect>
														<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
														<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
													</g>
												</svg>
												<!--end::Svg Icon-->
											</span>
										</a>
									</td>
								</tr>
							@empty
								<tr>
									<td colspan="4">
										<div class="alert alert-custom alert-white alert-shadow fade show gutter-b" role="alert">
											<div class="alert-icon">
												<span class="svg-icon svg-icon-primary svg-icon-xl">
													<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Tools/Compass.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24"></rect>
															<path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3"></path>
															<path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero"></path>
														</g>
													</svg>
													<!--end::Svg Icon-->
												</span>
											</div>
											<div class="alert-text">{{translate('No results!')}}</div>
										</div>
									</td>
								</tr>
							@endforelse
						</tbody>
					</table>
				</div>
				<!--end::Table-->
				<div class="aiz-pagination">
					{{ $articles->appends(request()->input())->links() }}
				</div>
			</div>
			<!--end::Body-->
		</div>
		<!--end::Advance Table Widget 3-->
	</div>
</div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')
    <script type="text/javascript">
        function publish_status(el, id){
            if($(el).is(':checked')){
                var status = 1;
            }
            else{
                var status = 0;
			}
            $.post('{{ route('admin.articles.publish') }}', {_token:'{{ csrf_token() }}', id:id, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Status updated successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
			});
        }
    </script>
@endsection