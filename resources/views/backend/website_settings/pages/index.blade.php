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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ translate('Website Pages') }}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm mr-5">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard')}}" class="text-muted">{{translate('Dashboard')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted">{{ translate('Website Pages') }}</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
					<!--begin::Actions-->
					<a href="{{ route('custom-pages.create') }}" class="btn btn-light-primary font-weight-bolder btn-sm"><i class="flaticon2-add-1"></i> {{translate('Add New Page')}}</a>
					<!--end::Actions-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
@endsection

@section('content')

<div class="card">
	<div class="card-body">
		<table class="table aiz-table mb-0">
        <thead>
            <tr>
                <th>#</th>
                <th>{{translate('Name')}}</th>
                <th data-breakpoints="md">{{translate('URL')}}</th>
                <th class="text-right">{{translate('Actions')}}</th>
            </tr>
        </thead>
        <tbody>
        	@foreach (\App\Page::all() as $key => $page)
        	<tr>
        		<td>{{ $key+2 }}</td>
        		<td><a href="{{ route('custom-pages.show_custom_page', $page->slug) }}" class="text-reset">{{ $page->title }}</a></td>
        		<td>
							@if($page->type == 'home_page')
								{{ route('home') }}
							@else
								{{ route('home') }}/{{ $page->slug }}
							@endif
							</td>
        		<td class="text-right">
								@if($page->type == 'home_page')
									<a href="{{route('custom-pages.edit', ['id'=>$page->slug, 'lang'=>env('DEFAULT_LANGUAGE'), 'page'=>'home'] )}}" class="btn btn-icon btn-circle btn-sm btn-soft-primary" title="Edit">
										<i class="las la-pen"></i>
									</a>
								@else
	          			<a href="{{route('custom-pages.edit', ['id'=>$page->slug, 'lang'=>env('DEFAULT_LANGUAGE')] )}}" class="btn btn-icon btn-circle btn-sm btn-soft-primary" title="Edit">
	    							<i class="las la-pen"></i>
	    						</a>
								@endif
								@if($page->type == 'custom_page')
          				<a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('custom-pages.destroy', $page->id)}} " title="{{ translate('Delete') }}">
          					<i class="las la-trash"></i>
          				</a>
								@endif
        		</td>
        	</tr>
        	@endforeach
        </tbody>
    </table>
	</div>
</div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
