@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{trans('admin.addorder')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/home')}}"><i class="fa fa-dashboard"></i>{{trans('admin.home')}}</a></li>
            <li class="active">{{trans('admin.addorder')}}</li>
        </ol>
    </section>



    <!-- Main content -->
    <section class="content">
    @include('partials.validationerrors')
    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"> {{trans('admin.addorder')}}</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <!-- AREA CHART -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{ trans('admin.categories') }}</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body chart-responsive">
                                @foreach($categories as $category)
                                    <div class="panel-group">
                                        <div class="panel-info">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse"
                                                       href="#{{str_replace(' ', '_', $category->name)}}">{{$category->name}}</a>
                                                </h4>
                                            </div>
                                            <div id="{{ str_replace(' ', '_', $category->name) }}"
                                                 class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    @if($category->products->count() > 0)
                                                        <table class="table table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th>{{ trans('admin.name') }}</th>
                                                                <th>{{ trans('admin.stock') }}</th>
                                                                <th>{{ trans('admin.price') }}</th>
                                                                <th>{{ trans('admin.add') }}</th>
                                                            </tr>
                                                            </thead>
                                                            @foreach($category->products as $product)
                                                                <tbody>
                                                                <tr>
                                                                    <td>{{ $product->name }}</td>
                                                                    <td>{{ $product->stock }}</td>
                                                                    <td>{{ $product->sale_price }}</td>
                                                                    <td>
                                                                        <a href=""
                                                                           id="product-{{ $product->id }}"
                                                                           data-name="{{ $product->name }}"
                                                                           data-id="{{ $product->id }}"
                                                                           data-price="{{number_format( $product->sale_price ) }}"
                                                                           class="btn btn-success btn-sm add-product-btn ">
                                                                            <li class="fa fa-plus"></li>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            @endforeach
                                                        </table>
                                                    @else
                                                        <h5>{{ trans('admin.nodata') }}</h5>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->

                    </div>
                    <!-- /.col (LEFT) -->
                    <div class="col-md-6">
                        <!-- LINE CHART -->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{trans('admin.orders')}}</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <form action="{{ url(route('clients.orders.store', $client->id)) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('post') }}
                                    @include('partials.validationerrors')
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>{{ trans('admin.product') }}</th>
                                            <th>{{ trans('admin.quantity') }}</th>
                                            <th>{{ trans('admin.price') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="order-list">

                                        </tbody>


                                    </table>
                                    <h4>{{ trans('admin.total') }} : <span class="total-price">0</span></h4>
                                    <button class="btn btn-primary btn-block disabled" id="add-order-form-btn">
                                        <li class="fa fa-plus"> {{ trans('admin.add_order') }}</li>
                                    </button>

                                </form>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                        @if ($client->orders->count() > 0)

                            <div class="box box-primary">

                                <div class="box-header">

                                    <h3 class="box-title" style="margin-bottom: 10px">{{trans('admin.previous_orders')}}
                                        <small>{{ $orders->total() }}</small>
                                    </h3>

                                </div><!-- end of box header -->

                                <div class="box-body">

                                    @foreach ($orders as $order)

                                        <div class="panel-group">

                                            <div class="panel panel-success">

                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse"
                                                           href="#{{ $order->created_at->format('d-m-Y-s') }}">{{ $order->created_at->toFormattedDateString() }}</a>
                                                    </h4>
                                                </div>

                                                <div id="{{ $order->created_at->format('d-m-Y-s') }}"
                                                     class="panel-collapse collapse">

                                                    <div class="panel-body">

                                                        <ul class="list-group">
                                                            @foreach ($order->products as $product)
                                                                <li class="list-group-item">{{ $product->name }}</li>
                                                            @endforeach
                                                        </ul>

                                                    </div><!-- end of panel body -->

                                                </div><!-- end of panel collapse -->

                                            </div><!-- end of panel primary -->

                                        </div><!-- end of panel group -->

                                    @endforeach

                                    {{ $orders->links() }}

                                </div><!-- end of box body -->

                            </div><!-- end of box -->

                        @endif

                    </div>
                    <!-- /.col (RIGHT) -->
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
