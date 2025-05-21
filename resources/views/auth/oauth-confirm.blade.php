@extends(config('constants.ACTIVE_THEME'))

@section('title', 'Authorize')

@section('header')
<header>
    	<div class="container">
    		<div class="logo">
    			<a href="{{ url('/home') }}"><img src="{{ URL::asset('images/HGS-OSS_DK.svg') }}"/></a>
    		</div>
    	</div>
    </header>
@endsection

@section('content')
	<div class="panel panel-default login-form-wrapper">
		<div class="panel-heading"><i class="fa fa-lock" aria-hidden="true"></i> Grant Access</div>
		<form id="login-form" role="form" action="{{ url('/oauth/grant-access') }}" method="get">
    		<input type="hidden" name="session_redirect" value="{{ $oauthClt->session_redirect }}"/>
    		{!! csrf_field() !!}
			<div class="form-group">
				<p><b>HgsOss Careers</b> would like to access some of your MyDiversify info.</p>
			</div>
	   		<div class="form-group center">
	   			<button type="submit" class="btn btn-primary">Continue as {{ Auth::user()->first_name.' '.Auth::user()->last_name }}</button>
	   		</div>
    	</form>
    	<div class="form-group center">
    		<a href="{{ $oauthClt->oau_redirect }}" class="btn btn-danger">Cancel</a>
    	</div>
    </div>
@endsection