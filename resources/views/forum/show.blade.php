<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>{{ $topic->title }}</title>
</head>
<body>
    <h1>{{ $topic->title }}</h1>
    <p>{{ $topic->body }}</p>
    <p>توسط: {{ $topic->user->name }}</p>

    <hr>

    <h2>پاسخ‌ها</h2>

    @foreach($posts as $post)
        @include('forum.partials.post', ['post' => $post])
    @endforeach

    <hr>

    <h3>پاسخ به تاپیک</h3>

    <form action="{{ route('forum.reply', $topic) }}" method="POST">
        @csrf
        <textarea name="body" rows="4" required></textarea>
        <input type="hidden" name="parent_id" value="">
        <button type="submit">ارسال پاسخ</button>
    </form>

    <br>
    <a href="{{ route('forum.index') }}">بازگشت به انجمن</a>
</body>
</html>
