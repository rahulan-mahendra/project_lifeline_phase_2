@props(['url'])
<tr>
<td class="header">
{{-- <a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === config('app.name'))
<img src="{{URL::asset('admin/assets/images/color_logo_no_background.svg')}}" class="logo" alt="LIFELINE HEALTHCARE GROUP">
@else
{{ $slot }}
@endif --}}
</a>
</td>
</tr>
