@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{trans('admin.editcategory')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/home')}}"><i class="fa fa-dashboard"></i>{{trans('admin.home')}}</a></li>
            <li class="active">{{trans('admin.editcategory')}}</li>
        </ol>
    </section>



    <!-- Main content -->
    <section class="content">
    @include('partials.validationerrors')
    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"> {{trans('admin.editcategory')}}</h3>
            </div>
            <div class="box-body">
                <form action="{{url(route('categories.update',$category->id))}}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    @foreach (config('translatable.locales') as $locale)
                        <div class="form-group">
                            <label for="{{$locale}}[name]">{{trans('admin.'.$locale.'.name')}}</label>
                            <input type="text" name="{{ $locale }}[name]" class="form-control" value="{{ $category->translate($locale)->name}}">
                        </div>
                    @endforeach
                    <div class="form-group">
                        <button class="btn btn-success" type="Submit"><li class="fa fa-save"></li> {{trans('admin.edit')}}</button>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
