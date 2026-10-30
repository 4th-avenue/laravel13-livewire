<?php

use App\Models\Comment;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component
{
    public $articleId;

    #[On('comment-created')]
    public function refreshComments()
    {
        //
    }

    #[Computed]
    public function comments()
    {
        $comments = Comment::with('user:id,nickname,userid')
            ->where('article_id', $this->articleId)
            ->select('id', 'user_id', 'body', 'created_at')
            ->get();

        return $comments;
    }
};
?>

<div>
    <ul class="divide-y divide-gray-500/30">
        @foreach($this->comments as $comment)
        <li class="py-6">
            <p>{!! nl2br(e($comment->body)) !!}</p>
            <p class="text-xs text-gray-500">
                {{ $comment->user->nickname }} ({{ $comment->user->userid }})
            </p>
            <time class="text-xs text-gray-500">
                {{ $comment->created_at->format('Y-m-d H:i') }}
            </time>
        </li>
        @endforeach
    </ul>
</div>