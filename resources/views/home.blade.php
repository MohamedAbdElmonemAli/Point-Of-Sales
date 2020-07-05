@extends('layouts.app')
@inject('user','App\User')
@inject('category','App\Category')
@inject('product','App\Product')
@inject('client','App\Client')
@section('content')
    <section class="content-header">
        <h1>
            {{trans('admin.home')}}
        </h1>
        <ol class="breadcrumb pull-left">
            <li><a href="{{url('admin/home')}}"><i class="fa fa-dashboard"></i> {{trans('admin.home')}}</a></li>
            <li class="active">{{trans('admin.dashboard')}}</li>
        </ol>
    </section>
    <section class="content" style="margin-top: 10px;">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{($user->whereRoleIs('admin')->count())}}</h3>

                        <p>{{trans('admin.users')}}</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="{{url(route('users.index'))}}" class="small-box-footer">{{ trans('admin.more') }} <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{($category->count())}}</h3>

                        <p>{{trans('admin.categories')}}</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bars"></i>
                    </div>
                    <a href="{{url(route('categories.index'))}}" class="small-box-footer">{{trans('admin.more')}} <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{($product->count())}}</h3>

                        <p>{{trans('admin.products')}}</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-list"></i>
                    </div>
                    <a href="{{url(route('products.index'))}}" class="small-box-footer">{{trans('admin.more')}} <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{($client->count())}}</h3>

                        <p>{{trans('admin.clients')}}</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-plus"></i>
                    </div>
                    <a href="{{url(route('clients.index'))}}" class="small-box-footer">{{trans('admin.more')}} <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>


        <div class="box box-solid">

            <div class="box-header">
                <h3 class="box-title">Sales Graph</h3>
            </div>
            <div class="box-body border-radius-none">
                <div class="chart" id="line-chart" style="height: 250px;"></div>
            </div>
            <!-- /.box-body -->
        </div>




        <div class="card">
            <div class="card-body">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="box">
                    @if (direction() == 'ltr' )
                        <div class="box-tools pull-right">
                            @else
                                <div class="box-tools pull-left">
                                    @endif
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"
                                            data-toggle="tooltip"
                                            title="Collapse">
                                        <i class="fa fa-minus"></i></button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"
                                            data-toggle="tooltip" title="Remove">
                                        <i class="fa fa-times"></i></button>
                                </div>

                                <div class="box-body">
                                    {{trans('admin.loginsuccessfully')}}
                                </div>

                        </div>

                </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')

    <script>

        //line chart
        var line = new Morris.Line({
            element: 'line-chart',
            resize: true,
            data: [
                    @foreach ($sales_data as $data)
                {
                    ym: "{{ $data->year }}-{{ $data->month }}", sum: "{{ $data->sum }}"
                },
                @endforeach
            ],
            xkey: 'ym',
            ykeys: ['sum'],
            labels: ['{{trans('admin.total')}}'],
            lineWidth: 2,
            hideHover: 'auto',
            gridStrokeWidth: 0.4,
            pointSize: 4,
            gridTextFamily: 'Open Sans',
            gridTextSize: 10
        });
    </script>

@endpush
