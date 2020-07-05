@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{trans('admin.clients')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/home')}}"><i class="fa fa-dashboard"></i> {{trans('admin.home')}}</a></li>
            <li class="active">{{trans('admin.clients')}}</li>
        </ol>
    </section>
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('admin.clients')}} </h3>  <small>{{ $clients->total() }}</small>
            </div>
            <div class="box-body">
                <form action="{{ url(route('clients.index')) }}" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" id="" value="{{ request()->search }}"
                                   placeholder="{{trans('admin.search')}}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" style="margin-bottom:10px;" class="btn btn-primary">
                                <li class="fa fa-search"></li> {{trans('admin.search')}}</button>
                            @if(auth()->user()->hasPermission('create_clients'))
                                <a href="{{url(route('clients.create'))}}" style="margin-bottom:10px;"
                                   class="btn btn-primary "><i class="fa fa-plus"></i> {{trans('admin.add')}}</a>
                            @else
                                <a href="#" style="margin-bottom:10px;" class="btn btn-primary disabled"><i
                                        class="fa fa-plus"></i> {{trans('admin.add')}}</a>
                            @endif
                        </div>
                    </div>
                </form>
                @include('flash::message')
                @if(count($clients))
                    <div class="table-responsive ">
                        <table class="table table-bordered text-center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('admin.name')}}</th>
                                <th>{{trans('admin.phone')}}</th>
                                <th>{{trans('admin.address')}}</th>
                                <th>{{trans('admin.add_order')}}</th>
                                <th>{{trans('admin.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$client->name}}</td>
                                    <td>{{is_array($client->phone) ? implode(array_filter($client->phone),'-') : $client->phone }}</td>
                                    <td>{{$client->address}}</td>
                                    <td>
                                        @if(auth()->user()->hasPermission('create_orders'))
                                            <a href="{{url(route('clients.orders.create', $client->id))}}"
                                               class="btn btn-info btn-sm">
                                                <li class="fa fa-plus"></li> {{ trans('admin.add_order') }}</a>
                                        @else
                                            <a href="#"
                                               class="btn btn-info btn-sm disabled">{{ trans('admin.add_order') }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if(auth()->user()->hasPermission('update_clients'))
                                            <a href="{{url(route('clients.edit',$client->id))}}"
                                               class="btn btn-info btn-sm"><i
                                                    class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><i
                                                    class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                                        @endif
                                        @if(auth()->user()->hasPermission('delete_clients'))
                                            {!! Form::open([
                                            'action' => ['Dashboard\ClientController@destroy',$client->id],
                                            'method' => 'delete',
                                            'style' => 'display: inline-block'
                                        ]) !!}
                                            {{ csrf_field() }}

                                            <button type="Submit" class="btn btn-danger delete btn-sm"><i
                                                    class="fa fa-trash-o"></i> {{trans('admin.delete')}}</button>
                                        @else
                                            <button class="btn btn-danger btn-sm disabled"><i
                                                    class="fa fa-trash-o"></i> {{trans('admin.delete')}}</button>
                                        @endif
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$clients->appends(request()->query())->render()}}

                    </div>
                @else
                    <div class="alert alert-danger" role="alert">
                        {{ trans('admin.nodata') }}
                    </div>
                @endif
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
@endsection
