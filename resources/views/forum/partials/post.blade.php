<div style="margin-right: {{ $level ?? 0 }}px; border: 1px solid #ccc; padding: 10px; margin-top: 10px;">
    <p>{{ $post->body }}</p>
    <small>توسط {{ $post->user->name }}</small>

    <form action="{{ route('forum.reply', $post->topic) }}" method="POST" style="margin-top: 5px;">
        @csrf
        <textarea name="body" rows="2" placeholder="پاسخ به این نظر..." required></textarea>
        <input type="hidden" name="parent_id" value="{{ $post->id }}">
        <button type="submit">ارسال پاسخ</button>
    </form>

    @if($post->children->count())
        @foreach($post->children as $child)
            @include('forum.partials.post', ['post' => $child, 'level' => ($level ?? 0) + 30])
        @endforeach
    @endif
</div>
