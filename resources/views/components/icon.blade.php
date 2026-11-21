@props(['name', 'class' => 'h-5 w-5'])
<svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => $class.' shrink-0']) }} fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="{{ config('portfolio.icons.'.$name) }}" />
</svg>