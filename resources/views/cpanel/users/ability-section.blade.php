<div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:col-span-1">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium text-gray-900">{{ $group['title'] }}</h3>

            <p class="mt-1 text-sm text-gray-600">
                {{ $group['subtitle'] }}
            </p>
        </div>
    </div>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
                <div class="grid grid-cols-6 gap-6">
                    @foreach($group['rules'] as $groupAbilities)
                        <div class="col-span-6 sm:col-span-3">
                            <p class="mb-2 font-semibold text-gray-800">
                                {{ $groupAbilities['title'] }}
                            </p>

                            @foreach($groupAbilities['abilities'] as $ability => $display)
                                <div class="flex items-center mb-2">
                                    <input type="checkbox"
                                        id="id_{{ $ability }}"
                                        wire:model.defer="state"
                                        value="{{ $ability }}"
                                        class="w-4 h-4 text-indigo-600 transition duration-150 ease-in-out form-checkbox" />

                                    <label for="id_{{ $ability }}"
                                        class="block ml-2 text-sm font-medium text-gray-700">
                                            {{ $display }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center justify-end px-4 py-3 text-right bg-gray-50 sm:px-6">
                <x-jet-button wire:click="update">
                    Save
                </x-jet-button>
            </div>
        </div>
    </div>
</div>
<x-jet-section-border />
