<?php

use App\Models\Article;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    #[Computed]
    public function articles()
    {
        $articles = Article::with('user:id,nickname')
            ->select('id', 'title', 'user_id', 'created_at')
            ->latest()
            ->paginate(3);

        if ($articles->currentPage() > 1 && $articles->isEmpty()) {
            abort(404);
        }

        return $articles;
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
                    @can('create article')
                    <div class="flex items-center justify-end mb-3">
                        <x-primary-button :href="route('articles.new')" wire:navigate>
                            {{ __('Create') }}
                        </x-primary-button>
                    </div>
                    @endcan

                    @foreach($this->articles as $article)
                        <div class="border rounded-md my-3 p-3">
                            <p>제목: <a href="{{ route('articles.show', $article) }}" wire:navigate class="text-indigo-500 hover:text-indigo-700">{{$article->title}}</a></p>
                            <p>작성자: {{$article->user->nickname}}</p>
                            <p>{{$article->created_at}}</p>
                        </div>
                    @endforeach
                    <div>
                        {{ $this->articles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>