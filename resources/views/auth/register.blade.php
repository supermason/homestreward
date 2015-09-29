@extends('app')

@section('content')

<div class="pages navbar-through" >
	<!-- Page, "user-page" contains page name -->
	<div data-page="login" class="page no-toolbar no-swipeback">
		<!-- Scrollable page content -->
		<div class="page-content login-screen-content">
			<div class="login-screen-title">
				欢迎成为JM小管家的一员
			</div>

			@if (count($errors) > 0)
				<div class="error">
					<strong>注册失败！</strong>
					<br>
					<ul>
						@foreach ($errors->all() as $error)
							<li>
								<p>{{ $error }}</p>
							</li>
						@endforeach
					</ul>
				</div>
			@endif

			<form role="form" method="POST" action="{{ url('/auth/register') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="list-block inset">
					<ul>
						<li>
							<div class="item-content">
								<div class="item-media"><i class="icon icon-form-name"></i></div>
								<div class="item-inner">
									<div class="item-input">
										<input type="text" placeholder="请输入名称" required name="name" value="{{ old('name') }}"/>
									</div>
								</div>
							</div>
						</li>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-form-email"></i></div>
                                <div class="item-inner">
                                    <div class="item-input">
                                        <input type="email" placeholder="请输入邮箱" required name="email" value="{{ old('email') }}"/>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-form-password"></i></div>
                                <div class="item-inner">
                                    <div class="item-input">
                                        <input type="password" name="password" placeholder="请输入密码" required pattern="^\S{6,25}$" title="请输入6-25个字" />
                                    </div>
                                </div>
                            </div>
                        </li>
						<li>
							<div class="item-content">
								<div class="item-media"><i class="icon icon-form-password"></i></div>
								<div class="item-inner">
									<div class="item-input">
										<input type="password" name="password_confirmation" placeholder="请确认密码" required pattern="^\S{6,25}$" title="请输入6-25个字" />
									</div>
								</div>
							</div>
						</li>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-form-url"></i></div>
                                <div class="item-inner">
                                    <div class="item-input">
                                        <input type="text" name="inviting_code" placeholder="请输入邀请码" required />
                                    </div>
                                </div>
                            </div>
                        </li>
					</ul>
				</div>
				<div class="content-block">
					<input type="submit" class="button button-big" value="注册"/>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
