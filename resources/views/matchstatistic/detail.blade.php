@extends('wd.admin.main')

@section('content')

    <div class="container top-gap">
        <ul class="nav nav-tabs sub-admin-nav" role="tablist">
            <li role="presentation">
                <a href="javascript:void(0);" aria-controls="index" role="tab" >
                    {{$data["exception"]->title}}
                </a>
            </li>
        </ul>

        <div class="form-group">
            <textarea type="text" class="form-control" disabled="true" contenteditable="false">
                {{$data["exception"]->content}}
            </textarea>
        </div>
        <div class="col-md-12">
            <button type="button" class="btn btn-success btn-lg btn-fill" onclick="history.go(-1);">{{trans('global.back')}}</button>
        </div>
    </div>

@endsection