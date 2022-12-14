<div>
   <x-jet-dialog-modal wire:model="show">
       <x-slot name="title">
           Suspend Account
       </x-slot>

       <x-slot name="content">
           Are you sure you want to suspend this account?
       </x-slot>

       <x-slot name="footer">
           <x-jet-secondary-button wire:click="$toggle('show')" wire:loading.attr="disabled">
               {{ __('Nevermind') }}
           </x-jet-secondary-button>

           <x-danger-button class="ml-2" wire:click="destroy" wire:loading.attr="disabled">
               Suspend Account
           </x-danger-button>
       </x-slot>
   </x-jet-dialog-modal>
</div>
