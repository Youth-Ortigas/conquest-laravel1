@extends(config('constants.ACTIVE_GUEST_THEME'))

@section('title', 'Reset Password')
@section('content')
<div class="panel panel-default reset-password-form-wrapper card border-primary rounded shadow">
    <div class="panel-heading card-header">Reset Password</div>

    <div class="panel-body card-body">
        <form id="login-form" class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}" onsubmit="return doValidateBeforeSubmit()">
            {!! csrf_field() !!}

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				<div class="label">E-Mail Address <span class="required-indicator">*</span></div>
                <input type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" style="max-width: none;">
                @if ($errors->has('email'))
                    <span class="help-block error-msg">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            	<div class="label">Password <span class="required-indicator">*</span></div>
                <div id="password-field">
                    <input type="password" class="form-control" name="password" style="max-width: none;">
					<div class="description">At least 8 character combination of uppercase, lowercase, number and special character.</div>
                    @if ($errors->has('password'))
                        <span id="password-error" class="help-block error-msg">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            	<div class="label">Confirm Password <span class="required-indicator">*</span></div>
                <div id="confirm-password-field">
                    <input type="password" class="form-control" name="password_confirmation" style="max-width: none;">
                    @if ($errors->has('password_confirmation'))
                        <span id="confirm-password-error" class="help-block error-msg">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-refresh"></i>Reset Password
                </button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
<!--
function doValidateBeforeSubmit(){

	var password = $("input[name=password]").val();

	$("#password-error").empty();
	$("#confirm-password-error").empty();
	
	if(password != ''){
		if(checkStrongPassword( password )){
			
			if(password == $("input[name=password_confirmation]").val()){
				$("input[name=password]").val($.sha1(password));
				$("input[name=password_confirmation]").val( $.sha1( $("input[name=password_confirmation]").val() ) );
				return true;
			}else{
				displayFieldError('#confirm-password-field','confirm-password-error','The password confirmation does not match.');
				return false;
			}
			
		}else{

			displayFieldError('#password-field','password-error','Password must be at least 8 character combination of uppercase, lowercase and number.');
			
			return false;
		}
	}
}

function displayFieldError(field, msgField, error){

	if($("#" + msgField).length > 0){
		$("#" + msgField).empty().append(error);
	}else{	
		$(field).append('<div id="'+ msgField +'" class="error-msg">'+ error +'</div>');
	}
	
}

//-->
</script>
@endsection