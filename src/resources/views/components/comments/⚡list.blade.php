<?php

use App\Models\Comment;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{
    public $articleId;
    public ?int $editingId = null;

    #[Validate('required|string|min:3|max:2000')]
    public string $body = '';

    public function edit(Comment $comment): void
    {
        $this->editingId = $comment->id;
        $this->body = $comment->body;
    }

    public function cancelEdit(): void
    {
        $this->editingId = null;
        $this->body = '';
        $this->resetValidation();
    }

    public function update(): void
    {
        $comment = Comment::findOrFail($this->editingId);

        $this->validate();

        $comment->update([
            'body' => $this->body,
        ]);

        $this->cancelEdit();
    }

    public function delete(Comment $comment): void
    {
        $comment->delete();
    }

    #[On('comment-created')]
    public function refreshComments()
    {
        //
    }

    #[Computed]
    public function comments()
    {
        return Comment::with('user:id,nickname,userid')
            ->where('article_id', $this->articleId)
            ->select('id', 'user_id', 'body', 'created_at')
            ->get();
    }
};
?>

<div>
    <ul class="divide-y divide-gray-500/30">
        @foreach($this->comments as $comment)
        <li class="py-6" 
            x-data="{ 
                get edit() { return $wire.editingId === {{ $comment->id }} } 
            }" 
            wire:key="comment-{{ $comment->id }}">
            <div x-show="!edit" class="flex space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <div class="flex-1">
                    <div class="flex justify-between items-center">
                        <div>
                            <span>{{ $comment->user->nickname }}</span>
                            <time datetime="{{ $comment->created_at->toIso8601String() }}" class="ml-2 text-sm">{{ $comment->created_at->format('Y-m-d H:i') }}</time>
                        </div>
                        <x-dropdown placement="left-start">
                            <x-slot name="trigger">
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-600">
                                        <path d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <button @click.prevent="
                                    if ($wire.editingId && $wire.editingId !== {{ $comment->id }}) {
                                        if (!confirm('작성 중이던 수정 내용이 사라집니다. 다른 댓글을 수정하시겠습니까?')) {
                                            return;
                                        }
                                    }
                                    $wire.edit({{ $comment->id }})
                                " class="block w-full px-4 py-2 text-left text-sm leading-5 hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-100 transition duration-150 ease-in-out">
                                    {{ __('Edit') }}
                                </button>
                                <button wire:click="delete({{ $comment->id }})" wire:confirm="이 댓글을 삭제하시겠습니까?" class="w-full text-start">
                                    <x-dropdown-link>
                                        {{ __('Delete') }}
                                    </x-dropdown-link>
                                </button>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    <p class="mt-4">{!! nl2br(e($comment->body)) !!}</p>
                </div>
            </div>

            <div x-show="edit">
                <form wire:submit.prevent="update">
                    <div>
                        <x-textarea wire:model="body" x-effect="if (edit) { $nextTick(() => $el.focus()) }" rows="4" class="block mt-1 w-full" required autocomplete="off"></x-textarea>
                        <x-input-error :messages="$errors->get('body')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4 space-x-2">
                        <x-secondary-button @click.prevent="$wire.cancelEdit()">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                        <x-primary-button>
                            {{ __('Save') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </li>
        @endforeach
    </ul>
</div>