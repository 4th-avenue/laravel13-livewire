<?php

use App\Models\Article;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    #[Computed]
    public function articles()
    {
        return Article::select('id', 'title', 'user_id', 'created_at')
            ->latest()
            ->get();
    }
};
?>

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Articles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xs sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-end mb-3">
                        <a href="{{ route('articles.new') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" wire:navigate>
                            {{ __('Create') }}
                        </a>
                    </div>

                    @foreach($this->articles as $article)
                        <div class="border rounded-md my-3 p-3">
                            <p>제목: {{$article->title}}</p>
                            <p>작성자: {{$article->user->nickname}}</p>
                            <p>{{$article->created_at}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>