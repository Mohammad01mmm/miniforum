<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>انجمن برنامه نویسی</title>
</head>

<body>
    <h1>انجمن برنامه نویسی</h1>

    <a href="{{ route('forum.create') }}">ساخت تاپیک جدید</a>

    <ul>
        @foreach ($topics as $topic)
            <li>
                <a href="{{ route('forum.show', $topic) }}">{{ $topic->title }}</a>
                <small>توسط {{ $topic->user->name }}</small>
                @if ($topic->tags->count())
                    <p>برچسب‌ها:
                        @foreach ($topic->tags as $tag)
                            <span>{{ $tag->name }}</span>
                        @endforeach
                    </p>
                @endif
            </li>
        @endforeach
    </ul>

</body>

</html>
