<div data-asdf="{{ $classes }}">
    <{{ $el }} @if($role == "link") href="{{ $href }}" @endif {{ $attributes->merge(['class' => "$classes"]) }}>
        {{ $slot }}
    </{{ $el }}>
</div>