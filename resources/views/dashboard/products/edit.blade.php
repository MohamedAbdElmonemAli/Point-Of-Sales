@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{trans('admin.editproduct')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('admin/home')}}"><i class="fa fa-dashboard"></i>{{trans('admin.home')}}</a></li>
            <li class="active">{{trans('admin.editproduct')}}</li>
        </ol>
    </section>



    <!-- Main content -->
    <section class="content">
    @include('partials.validationerrors')
    <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"> {{trans('admin.editproduct')}}</h3>
            </div>
            <div class="box-body">
                <form action="{{url(route('products.update',$product->id))}}" method="post"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}

                    <div class="form-group">
                        <label for="category">{{trans('admin.categories')}}</label>
                        <select name="category_id" class="form-control">
                            <option value="">{{ trans('admin.choosecategory') }}</option>
                            @foreach($categories as $category)
                                <option
                                    value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected' : ''}}>
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @foreach (config('translatable.locales') as $locale)
                        <div class="form-group">
                            <label for="{{$locale}}[name]">{{trans('admin.'.$locale.'.name')}}</label>
                            <input type="text" name="{{ $locale }}[name]" class="form-control"
                                   value="{{ $product->translate($locale)->name }}">
                        </div>

                        <div class="form-group">
                            <label for="{{$locale}}[description]">{{trans('admin.'.$locale.'.description')}}</label>
                            <textarea name="{{ $locale }}[description]"
                                      class="form-control ckeditor">{{ $product->translate($locale)->description }}</textarea>
                        </div>
                    @endforeach


                    <div class="form-group">
                        <label for="image">{{trans('admin.image')}}</label>
                        <input type="file" name="image" class="form-control image">
                    </div>
                    <div class="form-group">
                        <img src="{{$product->image_path}}" style="width: 80px; height:80px;" alt=""
                             class="img-thumbnail image_preview"/>
                    </div>
                    <div class="form-group">
                        <label for="purchase_price">{{trans('admin.purchase_price')}}</label>
                        <input type="number" name="purchase_price" step="0.01" class="form-control"
                               value="{{ $product->purchase_price }}">
                    </div>
                    <div class="form-group">
                        <label for="sale_price">{{trans('admin.sale_price')}}</label>
                        <input type="number" name="sale_price" step="0.01" class="form-control"
                               value="{{ $product->sale_price }}">
                    </div>
                    <div class="form-group">
                        <label for="stock">{{trans('admin.stock')}}</label>
                        <input type="text" name="stock" class="form-control" value="{{ $product->stock }}">
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
