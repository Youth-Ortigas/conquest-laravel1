@extends(config('constants.ACTIVE_GUEST_THEME'))

@section('title', 'Reset Password')
<!-- Main Content -->
@section('content')
            <div class="panel panel-default reset-password-form-wrapper card border-primary rounded shadow">
                <div class="panel-heading card-header">Reset Password</div>
                <div class="panel-body card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form id="login-form" class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        	<div class="label">E-Mail Address <span class="required-indicator">*</span></div>
    						<input type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus="autofocus">
    						@if ($errors->has('email'))
                                <span class="help-block error-msg">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-envelope"></i>Send Password Reset Link
                            </button>
                        </div>
                    </form>
                </div>
            </div>
@endsection
