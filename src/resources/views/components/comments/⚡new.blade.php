<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div>
    <h3 class="font-semibold text-sm mb-2">댓글 쓰기</h3>
    <form wire:submit="save">
        <div>
            <x-textarea wire:model="body" id="body" rows="4" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="body" required autocomplete="off"></x-textarea>
            <x-input-error :messages="$errors->get('body')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Save') }}
            </x-primary-button>
        </div>
    </form>
</div>