@props(['title', 'subtitle', 'buttons'])
<div class="px-4 py-5 border-b border-gray-200 sm:px-6">
    <div class="-ml-4 -mt-4 flex justify-between items-center flex-wrap sm:flex-nowrap">
        <div class="ml-4 mt-4">
            <h3 class="text-lg leading-6 font-medium text-gray-900">{{ $title }}</h3>
            @isset($subtitle)
                <p class="mt-1 text-sm text-gray-500">{{ $subtitle }}</p>
            @endisset
        </div>
        <div class="ml-4 mt-4 flex-shrink-0">
            @isset($buttons)
                {{ $buttons }}
            @endisset
        </div>
    </div>
</div>
