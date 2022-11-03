<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            <div class="flex items-center space-x-2">
                <x-svg.lock-closed class="w-8 h-8" />
                <span>{{ $user->name }} Abilities</span>
            </div>
        </h2>
    </x-slot>

    <div class="py-12">
        <x-container>
            <div class="py-12">
                @each('cpanel.users.ability-section', $this->abilities, 'group')
            </div>
        </x-container>
    </div>
</div>
