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
		<div class="panel-heading"><i class="fa fa-lock" aria-hidden="true"></i> Unauthorized Oauth Client</div>
		
    	<div class="form-group center">
    		{{ $errorMSg }}{{ $client_id }}
    	</div>
    </div>
@endsection