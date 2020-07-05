@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{trans('admin.editclient')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/home')}}"><i class="fa fa-dashboard"></i>{{trans('admin.home')}}</a></li>
            <li class="active">{{trans('admin.editclient')}}</li>
        </ol>
    </section>



    <!-- Main content -->
    <section class="content">
    @include('partials.validationerrors')
    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"> {{trans('admin.editclient')}}</h3>
            </div>
            <div class="box-body">
                <form action="{{url(route('clients.update',$client->id))}}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="form-group">
                        <label for="name">{{trans('admin.name')}}</label>
                        <input type="text" name="name" class="form-control" value="{{ $client->name }}">
                    </div>

                    @for($i = 0; $i < 2; $i++)

                        <div class="form-group">
                            <label for="phone">{{trans('admin.phone')}}</label>
                            <input type="text" name="phone[]" class="form-control"
                                   value="{{ $client->phone[$i] ?? '' }}">
                        </div>

                    @endfor

                    <div class="form-group">
                        <label for="address">{{trans('admin.address')}}</label>
                        <textarea name="address" class="form-control">{{ $client->address }}</textarea>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-success" type="Submit">
                            <li class="fa fa-save"></li> {{trans('admin.edit')}}</button>
                    </div>
                </form>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
