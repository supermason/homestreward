@extends('wd.admin.main')

@section('content')

    <div class="container main-container">
        <div class="main-title">
            <h2>{{trans('adminTip.index.title')}}</h2>
        </div>
        <div class="row">
            <div class="col-md-offset-3 col-md-3 admin-grid">
                <a href="#">
                    <p>{{trans('adminTip.nav.leftNav.product')}}</p>
                    <p>{{trans('adminTip.index.productAdminInfo')}}</p>
                </a>
            </div>
            <div class="col-md-3 admin-grid">
                <a href="#">
                    <p>{{trans('adminTip.nav.leftNav.activities')}}</p>
                    <p>{{trans('adminTip.index.activityAdminInfo')}}</p>
                </a>
            </div>
        </div>
    </div>

@endsection