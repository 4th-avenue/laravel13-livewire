
<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Articles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-3 lg:px-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="border rounded-md p-3">
                        <p>제목: {{$article->title}}</p>
                        <p>작성자: {{$article->user->nickname}}</p>
                        <p>{{$article->created_at}}</p>
                        <hr class="my-3">
                        <p>{{$article->body}}</p>
                    </div>

                    @canany(['update', 'delete'], $article)
                    <div class="flex items-center justify-end mt-3 space-x-2">
                        @can('update', $article)
                        <x-primary-button :href="route('articles.edit', $article)" wire:navigate>
                            {{ __('Edit') }}
                        </x-primary-button>
                        @endcan
                        @can('delete', $article)
                        <x-danger-button wire:click="deleteArticle" wire:confirm="정말로 이 글을 삭제하시겠습니까?">
                            {{ __('Delete') }}
                        </x-danger-button>
                        @endcan
                    </div>
                    @endcanany
                </div>
            </div>
        </div>
    </div>
</div>