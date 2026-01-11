@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" class="header-link">
    {{-- We removed the Laravel logo check entirely --}}
    {{ $slot }}
</a>
</td>
</tr>
