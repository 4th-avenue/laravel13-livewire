<?php

use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{
    #[Validate('required|exists:categories,id')]
    public $category_id;
    #[Validate('required|string|max:60')]
    public $title;
    #[Validate('required|string|max:21844')]
    public $body;

    public $childCategories = [];

    public function mount()
    {
        $this->childCategories = Category::whereNotNull('parent_id')
            ->pluck('name', 'id')
            ->toArray();
    }

    public function save()
    {
        $validated = $this->validate();

        auth()->user()->articles()->create($validated);

        $this->reset();
    }
};
?>

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form wire:submit="save" class="space-y-4">
                        <!-- Category -->
                        <div>
                            <x-input-label for="category_id" :value="__('Category')" />
                            <x-select wire:model="category_id" id="category_id" class="block mt-1 w-full" name="category_id" required>
                                <option>{{ __('Select a category.') }}</option>
                                @foreach ($childCategories as $id => $name)
                                    <option value="{{ $id }}">
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </x-select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input wire:model="title" id="title" class="block mt-1 w-full" type="text" name="title" required autofocus autocomplete="off" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Body -->
                        <div>
                            <x-input-label for="body" :value="__('Body')" />
                            <x-textarea wire:model="body" id="body" rows="9" class="block mt-1 w-full" name="body" required autocomplete="off"></x-textarea>
                            <x-input-error :messages="$errors->get('body')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end">
                            <x-primary-button>
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>