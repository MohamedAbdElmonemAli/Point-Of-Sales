@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{trans('admin.users')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/home')}}"><i class="fa fa-dashboard"></i> {{trans('admin.home')}}</a></li>
            <li class="active">{{trans('admin.users')}}</li>
        </ol>
    </section>
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('admin.users')}} </h3>  <small>{{ $rules->total() }}</small>
            </div>
            <div class="box-body">
                <form action="{{ url(route('users.index')) }}" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" id="" value="{{ request()->search }}"
                                   placeholder="{{trans('admin.search')}}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" style="margin-bottom:10px;" class="btn btn-primary">
                                <li class="fa fa-search"></li> {{trans('admin.search')}}</button>
                            @if(auth()->user()->hasPermission('create_users'))
                                <a href="{{url(route('users.create'))}}" style="margin-bottom:10px;"
                                   class="btn btn-primary "><i class="fa fa-plus"></i> {{trans('admin.add')}}</a>
                            @else
                                <a href="#" style="margin-bottom:10px;" class="btn btn-primary disabled"><i
                                        class="fa fa-plus"></i> {{trans('admin.add')}}</a>
                            @endif
                        </div>
                    </div>
                </form>
                @include('flash::message')
                @if(count($rules))
                    <div class="table-responsive ">
                        <table class="table table-bordered text-center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('admin.first_name')}}</th>
                                <th>{{trans('admin.last_name')}}</th>
                                <th>{{trans('admin.email')}}</th>
                                <th>{{trans('admin.image')}}</th>
                                <th>{{trans('admin.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rules as $rule)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$rule->first_name}}</td>
                                    <td>{{$rule->last_name}}</td>
                                    <td>{{$rule->email}}</td>
                                    <td><img src="{{$rule->image_path}}" style="width: 80px; height:80px;" alt=""
                                             class="img-thumbnail"/></td>
                                    <td>
                                        @if(auth()->user()->hasPermission('update_users'))
                                            <a href="{{url(route('users.edit',$rule->id))}}"
                                               class="btn btn-info btn-sm"><i
                                                    class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><i
                                                    class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                                        @endif
                                        @if(auth()->user()->hasPermission('delete_users'))
                                            {!! Form::open([
                                            'action' => ['Dashboard\UserController@destroy',$rule->id],
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
                        {{$rules->appends(request()->query())->render()}}

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
