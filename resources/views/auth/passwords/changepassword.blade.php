@extends(config('constants.ACTIVE_GUEST_THEME'))

@section('title', 'Change Password')
@section('content')
<div class="container">
    <div class="row no-gutter">
        <div class="col-md-12">
            <div class="panel panel-default change-password card shadow" style="max-width: 700px;margin: 30px auto;">
                <div class="panel-heading card-header">Change Password</div>
					<div id="record-details" class="panel-collapse collapse in show">
	                	<div class="panel-body card-body">
	                    {!! csrf_field() !!}
						<input type="hidden" name="id" value="{{ $id }}">
	                    
	                    @if($isExpired)
	                    <div class="alert alert-danger">Your password has expired, please change it.</div>
	                    @endif
			      		<div class="row form-group no-gutters">
			      			<div class="col-sm-4 label-horizontal">
								<label class="field-label align-right required">Current Password</label>
							</div>
							<div class="col-sm-6 field-horizontal">
								<input type="password" class="form-control" name="current" maxlength="50"/> 
							</div>
						</div>
						<div class="row form-group no-gutters">
			      			<div class="col-sm-4 label-horizontal">
								<label class="field-label align-right required">New Password</label>
							</div>
							<div class="col-sm-6 field-horizontal">
								<input type="password" class="form-control" name="new_password" maxlength="50"/> 
								<div class="description">At least 8 character combination of uppercase, lowercase, number and special character.</div>
							</div>
						</div>
						<div class="row form-group no-gutters">
			      			<div class="col-sm-4 label-horizontal">
								<label class="field-label align-right required">Confirm Password</label>
							</div>
							<div class="col-sm-6 field-horizontal">
								<input type="password" class="form-control" name="confirm_password" maxlength="50"/> 
							</div>
						</div>
						<div class="row form-group no-gutters">
							<div class="col-sm-4 label-horizontal"></div>
							<div class="col-sm-6 field-horizontal">
								@if(!empty($redirect))
								<button class="btn btn-primary" onclick="crudRecordSaveAndGoTo('/changepassword', '{{$redirect}}', validateChangePassword)"><i class="fa fa-btn fa-refresh"></i> Change Password</button>
								@else
								<button class="btn btn-primary" onclick="crudRecordSaveAndGoTo('/changepassword', '/login', validateChangePassword)"><i class="fa fa-btn fa-refresh"></i> Change Password</button>
								@endif 
							</div>
							
						</div>
	                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer-scripts')
    <script type="text/javascript" src="{{ URL::asset('js/crudcontrols.js?')}}{{config('constants.VERSION') }}"></script>
@endsection