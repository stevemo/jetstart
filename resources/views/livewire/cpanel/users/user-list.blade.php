<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            <div class="flex items-center space-x-2">
                <x-svg.user-solid class="w-6 h-6" />
                <span class="pt-1 ml-2">Users</span>
            </div>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <x-card>
                <x-card-header title="Users" subtitle="A list of all the users.">

                </x-card-header>

                <x-card-body stretch>
                    <div class="px-2 sm:px-0">
                        <x-table>
                            <x-slot name="thead">
                                <tr>
                                    <th scope="col" class="table-th-first">
                                        Name
                                    </th>
                                    <th scope="col" class="table-th">
                                        Status
                                    </th>
                                    <th scope="col" class="table-th">
                                        Administrator
                                    </th>
                                    <th scope="col" class="table-th">
                                        Actions
                                    </th>
                                </tr>
                            </x-slot>
                            <x-slot name="tbody">
                                @forelse ($this->users as $user)
                                    <tr>
                                        <td class="table-td-first">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10">
                                                    <img class="w-10 h-10 rounded-full"
                                                        src="{{ $user->profile_photo_url }}"
                                                        alt="{{ $user->name }}">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                                    <div class="text-gray-500">{{ $user->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="table-td">
                                            @if($user->trashed())
                                                <span class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                                        Suspended
                                                </span>
                                            @else
                                                <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                                        Active
                                                </span>
                                            @endif
                                        </td>
                                        <td class="table-td">
                                            @if($user->admin)
                                                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            @else
                                                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            @endif
                                        </td>
                                        <td class="table-td">
                                            <div class="flex space-x-2">
                                                @if(! $user->trashed())
                                                    @can('delete', $user)
                                                        @if ($user->isNot(auth()->user()))
                                                            <button
                                                                x-data
                                                                x-tooltip="Delete"
                                                                wire:click="$emit('user:delete', {{ $user->id }})"
                                                                type="button">
                                                                <x-svg.trash class="w-6 h-6 text-red-500 hover:text-red-700" />
                                                            </button>
                                                        @endif
                                                    @endcan
                                                @else
                                                    @can('restore', $user)
                                                        <button wire:click="$emit('user:restore', {{ $user->id }})" type="button">
                                                            <x-svg.refresh class="w-6 h-6 text-gray-800 hover:text-red-500" />
                                                        </button>
                                                    @endcan
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <x-no-result>No users found!</x-no-result>
                                        </td>
                                    </tr>
                                @endforelse
                            </x-slot>
                        </x-table>
                    </div>

                    <div>
                        @if($this->users->hasPages())
                            <div class="p-4 border-t border-gray-300">
                                {{ $this->users->links() }}
                            </div>
                        @endif
                    </div>

                </x-card-body>
            </x-card>
        </div>
    </div>

    @livewire('cpanel.users.delete-user')
    @livewire('cpanel.users.restore-user')
</div>
