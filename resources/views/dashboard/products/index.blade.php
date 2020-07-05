@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{trans('admin.products')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/home')}}"><i class="fa fa-dashboard"></i> {{trans('admin.home')}}</a></li>
            <li class="active">{{trans('admin.products')}}</li>
        </ol>
    </section>
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('admin.products')}} </h3>  <small>{{ $products->total() }}</small>
            </div>
            <div class="box-body">
                <form action="{{ url(route('products.index')) }}" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" id="" value="{{ request()->search }}"
                                   placeholder="{{trans('admin.search')}}">
                        </div>
                        <div class="col-md-4">
                            <select name="category_id" class="form-control">
                                <option value="">{{ trans('admin.choosecategory') }}</option>
                                @foreach($categories as $category)
                                    <option
                                        value="{{$category->id}}" {{request()->category_id == $category->id ? 'selected' : ''}}>
                                        {{$category->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <button type="submit" style="margin-bottom:10px;" class="btn btn-primary">
                                <li class="fa fa-search"></li> {{trans('admin.search')}}</button>
                            @if(auth()->user()->hasPermission('create_products'))
                                <a href="{{url(route('products.create'))}}" style="margin-bottom:10px;"
                                   class="btn btn-primary "><i class="fa fa-plus"></i> {{trans('admin.add')}}</a>
                            @else
                                <a href="#" style="margin-bottom:10px;" class="btn btn-primary disabled"><i
                                        class="fa fa-plus"></i> {{trans('admin.add')}}</a>
                            @endif
                        </div>
                    </div>
                </form>
                @include('flash::message')
                @if(count($products))
                    <div class="table-responsive ">
                        <table class="table table-bordered text-center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('admin.name')}}</th>
                                <th>{{trans('admin.description')}}</th>
                                <th>{{trans('admin.image')}}</th>
                                <th>{{trans('admin.category')}}</th>
                                <th>{{trans('admin.purchase_price')}}</th>
                                <th>{{trans('admin.sale_price')}}</th>
                                <th>{{trans('admin.profit_percent')}}</th>
                                <th>{{trans('admin.stock')}}</th>
                                <th>{{trans('admin.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $index=>$product)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{!! $product->description !!}</td>
                                    <td><img src="{{$product->image_path}}" style="width: 80px; height:80px;" alt=""
                                             class="img-thumbnail"/></td>
                                    <td>{{optional($product->category)->name}}</td>
                                    <td>{{$product->purchase_price}}</td>
                                    <td>{{$product->sale_price}}</td>
                                    <td>{{$product->profit_percent}} %</td>
                                    <td>{{$product->stock}}</td>
                                    <td>
                                        @if(auth()->user()->hasPermission('update_products'))
                                            <a href="{{url(route('products.edit',$product->id))}}"
                                               class="btn btn-info btn-sm"><i
                                                    class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><i
                                                    class="fa fa-edit"></i> {{trans('admin.edit')}}</a>
                                        @endif
                                        @if(auth()->user()->hasPermission('delete_products'))
                                            {!! Form::open([
                                            'action' => ['Dashboard\ProductController@destroy',$product->id],
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
                        {{$products->appends(request()->query())->render()}}

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
