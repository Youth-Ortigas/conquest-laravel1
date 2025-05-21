<div style="margin-bottom: 20px;">Hi {{ $user->first_name }},</div>

<p style="margin-bottom: 20px;">We've received a request to reset your password. Click <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}">here</a> to reset your password.
Or visit {{ $link }} in your browser.</p>

<p style="margin-bottom: 20px;">The link above will expire in 1 hours. If you didn't request for a password reset, don't worry, we haven't done anything yet; feel free to disregard this email.</p>

<p style="margin-bottom: 20px;">For questions or concerns, please send an email to <a href="mailto:{{config('constants.CSS_MAIL_LIST') }}">{{config('constants.CSS_MAIL_LIST') }}</a></p>

<p style="margin-bottom: 50px;">Thank you.</p>

<p style="margin-bottom: 20px;font-weight: bold;font-style: italic;">**This is a system generated email from HGS OSS, please do not reply.</p>
