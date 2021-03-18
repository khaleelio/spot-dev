@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h1 class="h3">{{translate('All Captains')}}</h1>
		</div>
		<div class="col-md-6 text-md-right">
			<a href="{{ route('admin.captains.create') }}" class="btn btn-circle btn-info">
				<span>{{translate('Add New Captains')}}</span>
			</a>
		</div>
	</div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{translate('Captains')}}</h5>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th  width="3%">#</th>
                    <th >{{translate('Name')}}</th>
                  
                    <th >{{translate('Phone')}}</th>
                    <th >{{translate('Missions Type')}}</th>
                    <th >{{translate('Branch')}}</th>
                    
                    <th  width="10%" class="text-center">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($captains as $key => $captain)
                    
                        <tr>
                            <td  width="3%">{{ ($key+1) + ($captains->currentPage() - 1)*$captains->perPage() }}</td>
                            <td width="20%">{{$captain->name}}</td>
                            
                            <td width="20%">{{$captain->responsible_mobile}}</td>
                            <td width="20%">{{$captain->type}}</td>
                            <td><a href="{{route('admin.branchs.show',$captain->branch_id)}}">{{$captain->branch->name}}</a></td>
                           
                            <td class="text-center">
                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('admin.captains.show', $captain->id)}}" title="{{ translate('Show') }}">
		                                <i class="las la-eye"></i>
		                            </a>
		                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('admin.captains.edit', $captain->id)}}" title="{{ translate('Edit') }}">
		                                <i class="las la-edit"></i>
		                            </a>
		                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('admin.captains.delete-captain', ['captain'=>$captain->id])}}" title="{{ translate('Delete') }}">
		                                <i class="las la-trash"></i>
		                            </a>
		                        </td>
                        </tr>
               
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $captains->appends(request()->input())->links() }}
        </div>
    </div>
</div>
{!! hookView('captain_addon',$currentView) !!}

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
