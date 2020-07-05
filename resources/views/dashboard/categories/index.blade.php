@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{trans('admin.categories')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/home')}}"><i class="fa fa-dashboard"></i> {{trans('admin.home')}}</a></li>
            <li class="active">{{trans('admin.categories')}}</li>
        </ol>
    </section>
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('admin.categories')}} </h3>  <small>{{ $categories->total() }}</small>
            </div>
            <div class="box-body">
                <form action="{{ url(route('categories.index')) }}" method="get">
                    <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" id="" value="{{ request()->search }}" placeholder="{{trans('admin.search')}}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" style="margin-bottom:10px;" class="btn btn-primary" ><li class="fa fa-search"></li> {{trans('admin.search')}}</button>
                        @if(auth()->user()->hasPermission('create_categories'))
                        <a href="{{url(route('categories.create'))}}" style="margin-bottom:10px;" class="btn btn-primary "><i class="fa fa-plus"></i>  {{trans('admin.add')}}</a>
                            @else
                            <a href="#" style="margin-bottom:10px;" class="btn btn-primary disabled"><i class="fa fa-plus"></i>  {{trans('admin.add')}}</a>
                              @endif
                    </div>
                    </div>
                </form>
                @include('flash::message')
                @if(count($categories))
                    <div class="table-responsive ">
                        <table class="table table-bordered text-center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('admin.name')}}</th>
                                <th >{{trans('admin.products_count')}}</th>
                                <th >{{trans('admin.related_products')}}</th>
                                <th >{{trans('admin.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->products->count()}}</td>
                                    <td> <a href="{{url(route('products.index',['category_id' => $category->id]))}}" class="btn btn-success btn-sm"><li class="fa fa-eye"></li> {{ trans('admin.show') }}</a></td>
                                    <td >
                                        @if(auth()->user()->hasPermission('update_categories'))
                                        <a href="{{url(route('categories.edit',$category->id))}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                                        @endif
                                            @if(auth()->user()->hasPermission('delete_categories'))
                                            {!! Form::open([
                                            'action' => ['Dashboard\CategoryController@destroy',$category->id],
                                            'method' => 'delete',
                                            'style' => 'display: inline-block'
                                        ]) !!}
                                            {{ csrf_field() }}

                                            <button type="Submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash-o"></i> {{trans('admin.delete')}}</button>
                                            @else
                                                <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash-o"></i> {{trans('admin.delete')}}</button>
                                            @endif
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$categories->appends(request()->query())->render()}}

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
