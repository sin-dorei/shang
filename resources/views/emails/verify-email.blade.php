@component('mail::message')
# {{ $user->name }}，欢迎加入{{ config('app.name') }}！

为了保证您正常使用{{ config('app.name') }}，请点击下面按钮激活账号：

@component('mail::button', ['url' => $url])
立即激活账号
@endcomponent

<hr>
如果以上按钮无法打开，请把下面的链接复制到浏览器地址栏中打开：<br>
{{ $url }}
<hr>
该邮件5分钟内有效，请尽快操作。<br>
该邮件为自动发送，请勿回复！
@endcomponent
