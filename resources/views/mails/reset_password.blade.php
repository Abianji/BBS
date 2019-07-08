@component('mail::message')
# 重置密码

你好，{{ $username }}！点击下面的链接，重置密码

@component('mail::button', ['url' => url(route('password.reset', $token, false))])
重置密码
@endcomponent

如果非本人操作，请忽略这封邮件。

你的，<br>
{{ config('app.name') }}
@endcomponent
