@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'StudyHub-App')
<img src="https://i.postimg.cc/0yJTzcQr/logo-removebg-preview.png" class="logo" alt="StudyHub-App Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
