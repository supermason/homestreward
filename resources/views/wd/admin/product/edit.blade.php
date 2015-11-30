@extends('wd.admin.main')

@section('content')

    <div class="container top-gap">
        <ul class="nav nav-tabs sub-admin-nav" role="tablist">
            <li role="presentation">
                <a href="{{url('/wd/admin/products/')}}" aria-controls="index" role="tab" >
                    {{trans('adminTip.products.productList.title')}}
                </a>
            </li>
            <li role="presentation">
                <a href="{{url('/wd/admin/products/create')}}" aria-controls="create" role="tab" >
                    {{trans('adminTip.products.addNewProduct.title')}}
                </a>
            </li>
            <li role="presentation" class="active">
                <a href="javascript:void(0);" aria-controls="edit" role="tab" >
                    {{trans('adminTip.products.editProduct.title')}}
                </a>
            </li>
        </ul>

        <div class="common-form-container">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong>{{ trans('products.addNewProduct.errors.title') }}
                    <br/>
                    <br/>
                    <ul>
                        @foreach ($errors->all as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="form-horizontal" action="{{url('/wd/admin/products/update')}}">
                <div class="form-group">
                    <label for="name" class="col-md-1 control-label">{{trans('adminTip.products.addNewProduct.form.pName')}}</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="name" name="name" placeholder="{{trans('adminTip.products.addNewProduct.form.pNameTip')}}" required value="{{$data["product"]->name}}">
                    </div>
                    <div class="col-md-2">
                        <h3><span class="danger-left-arrow"></span><span class="label label-danger">{{trans('adminTip.products.form.mustFill')}}</span></h3>
                    </div>
                </div>
                <div class="form-group">
                    <label for="subtitle" class="col-md-1 control-label">{{trans('adminTip.products.addNewProduct.form.pSubtitle')}}</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="{{trans('adminTip.products.addNewProduct.form.pSubtitleTip')}}" value="{{$data["product"]->subtitle}}">
                    </div>
                    <div class="col-md-2">
                        <h3><span class="warning-left-arrow"></span><span class="label label-warning">{{trans('adminTip.products.form.recommend')}}</span></h3>
                    </div>
                </div>
                <div class="form-group">
                    <label for="curImg" class="col-md-1 control-label">{{trans('adminTip.products.editProduct.form.pCurImg')}}</label>
                    <div class="col-md-9">
                        <img src="{{1}}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="productImg" class="col-md-1 control-label">{{trans('adminTip.products.addNewProduct.form.pImg')}}</label>
                    <div class="col-md-9">
                        <input type="file" id="productImg" name="productImg" required accept="image/*">
                    </div>
                    <div class="col-md-2">
                        <h3><span class="danger-left-arrow"></span><span class="label label-danger">{{trans('adminTip.products.form.mustSelect')}}</span></h3>
                    </div>
                </div>
                <div class="form-group">
                    <label for="category" class="col-md-1 control-label">{{trans('adminTip.products.addNewProduct.form.pCategory')}}</label>
                    <div class="col-md-9">
                        <select class="form-control" id="category" name="category">
                            {!! $data["options"] !!}
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="price" class="col-md-1 control-label">{{trans('adminTip.products.addNewProduct.form.pPrice')}}</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="price" name="price" placeholder="{{trans('adminTip.products.addNewProduct.form.pPriceTip')}}" required value="{{$data["product"]->retail_price}}">
                    </div>
                    <div class="col-md-2">
                        <h3><span class="danger-left-arrow"></span><span class="label label-danger">{{trans('adminTip.products.form.mustFill')}}</span></h3>
                    </div>
                </div>
                <div class="form-group">
                    <label for="wholesalePrice" class="col-md-1 control-label">{{trans('adminTip.products.addNewProduct.form.pWholesalePrice')}}</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="wholesalePrice" name="wholesalePrice" placeholder="{{trans('adminTip.products.addNewProduct.form.pWholesalePriceTip')}}" required value="{{$data["product"]->wholesale_price}}">
                    </div>
                    <div class="col-md-2">
                        <h3><span class="danger-left-arrow"></span><span class="label label-danger">{{trans('adminTip.products.form.mustFill')}}</span></h3>
                    </div>
                </div>
                <div class="form-group">
                    <label for="count" class="col-md-1 control-label">{{trans('adminTip.products.addNewProduct.form.pCount')}}</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="count" name="count" placeholder="{{trans('adminTip.products.addNewProduct.form.pCountTip')}}" value="{{$data["product"]->count}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-md-1 control-label">{{trans('adminTip.products.addNewProduct.form.pDescription')}}</label>
                    <div class="col-md-9">
                        <textarea type="text" class="form-control" id="description" name="description" placeholder="{{trans('adminTip.products.addNewProduct.form.pDescriptionTip')}}" rows="4" required value="{{$data["product"]->description}}"></textarea>
                    </div>
                    <div class="col-md-2">
                        <h3><span class="danger-left-arrow"></span><span class="label label-danger">{{trans('adminTip.products.form.mustFill')}}</span></h3>
                    </div>
                </div>
                <div class="col-md-offset-1 col-md-9">
                    <button type="submit" class="btn btn-success btn-lg btn-fill">{{trans('adminTip.products.editProduct.form.pEdit')}}</button>
                </div>
            </form>
        </div>
    </div>

@endsection