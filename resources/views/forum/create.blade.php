<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>ساخت تاپیک جدید</title>
</head>
<body>
    <h1>ساخت تاپیک جدید</h1>

    <form action="{{ route('forum.store') }}" method="POST">
        @csrf
        <div>
            <label>عنوان:</label>
            <input type="text" name="title" required>
        </div>
        <div>
            <label>متن:</label>
            <textarea name="body" rows="5" required></textarea>
        </div>
        <div>
            <label>برچسب‌ها (با , جدا کن):</label>
            <input type="text" name="tags">
        </div>
        <button type="submit">ایجاد</button>
    </form>

    <a href="{{ route('forum.index') }}">بازگشت به انجمن</a>
</body>
</html>
