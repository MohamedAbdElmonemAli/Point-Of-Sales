@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{trans('admin.edituser')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/home')}}"><i class="fa fa-dashboard"></i>{{trans('admin.home')}}</a></li>
            <li class="active">{{trans('admin.edituser')}}</li>
        </ol>
    </section>



    <!-- Main content -->
    <section class="content">
    @include('partials.validationerrors')
    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"> {{trans('admin.edituser')}}</h3>
            </div>
            <div class="box-body">
                {!!Form::model($user,[
                    'action' => ['Dashboard\UserController@update',$user->id],
                    'method' =>'put',
                    'enctype'  => 'multipart/form-data'

                ])!!}

                <div class="form-group">
                    <label for="first_name">{{trans('admin.first_name')}}</label>
                    {!!Form::text('first_name',null,[
                        'class' => 'form-control'
                    ])!!}
                </div>
                <div class="form-group">
                    <label for="last_name">{{trans('admin.last_name')}}</label>
                    {!!Form::text('last_name',null,[
                        'class' => 'form-control'
                    ])!!}
                </div>
                <div class="form-group">
                    <label for="email">{{trans('admin.email')}}</label>
                    {!!Form::text('email',null,[
                        'class' => 'form-control'
                    ])!!}
                </div>
                <div class="form-group">
                    <label for="image">{{trans('admin.image')}}</label>
                    <input type="file" name="image" class="form-control image">
                </div>
                <div class="form-group">
                    <img src="{{$user->image_path}}" style="width: 80px; height:80px;" alt=""
                         class="img-thumbnail image_preview"/>
                </div>

                <div class="form-group">
                    <label>{{ trans('admin.permissions') }}</label>

                    <div class="nav-tabs-custom">
                        @php
                            $models = ['users','categories','products', 'clients','orders'];
                            $maps =['create', 'read', 'update', 'delete'];
                        @endphp
                        <ul class="nav nav-tabs">
                            @foreach($models as $index => $model)
                                <li class="{{ $index == 0 ? 'active' : '' }}"><a href="#{{ $model }}"
                                                                                 data-toggle="tab">{{ trans('admin.'.$model) }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @foreach($models as $index => $model)
                                <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="{{ $model }}">
                                    @foreach($maps as $map)
                                        <label><input type="checkbox" name="permissions[]"
                                                      {{ $user->hasPermission($map.'_'.$model) ? 'checked' : '' }} value="{{$map . '_' . $model }}"> {{ trans('admin.'.$map) }}
                                        </label>
                                    @endforeach
                                </div>
                            @endforeach


                        </div>

                    </div>

                </div>


                <div class="form-group">
                    <button class="btn btn-primary" type="Submit">
                        <li class="fa fa-edit"></li> {{trans('admin.edit')}}</button>
                </div>

                {!!Form::close()!!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
