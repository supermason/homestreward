@extends('wd.admin.main')

@section('content')

    <div class="container top-gap">
        <ul class="nav nav-tabs sub-admin-nav" role="tablist">
            <li role="presentation" class="active">
                <a href="javascript:void(0);" aria-controls="index" role="tab" >
                    {{trans('adminTip.products.productList.title')}}
                </a>
            </li>
            <li role="presentation">
                <a href="{{url('/wd/admin/products/create')}}" aria-controls="create" role="tab" >
                    {{trans('adminTip.products.addNewProduct.title')}}
                </a>
            </li>
            <li role="presentation">
                <a href="javascript:void(0);" aria-controls="edit" role="tab" >
                    {{trans('adminTip.products.editProduct.title')}}
                </a>
            </li>
        </ul>
        <div class="product-content">
            @if (count($data['products']) == 0)
                no items.
            @else
                @foreach ($data['products'] as $product)
                    <div class="product-box col-md-3">
                        <img src="{{App\Util\WdUtil::getProductImgUrl($product->category_id, $product->thumbnail)}}" class="thumbnail img-responsive" />
                        <div class="product-box-content">
                            <h2>{{$product->name}}</h2>
                            <p class="color-gray">{{$product->subtitle}}</p>
                            <p>{{trans('tip.pList.priceTitle')}}<span class="normal-price">300.00</span><span class="discount">220.00</span></p>
                            <div class="product-box-content-footer">
                                <a href="#" class="link">{{trans('adminTip.products.productList.edit')}}</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            @endif
        </div>
        {!! $data['products']->render() !!}
    </div>

@endsection