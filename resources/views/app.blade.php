<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Мой Сайт')</title>
    <meta name="description" content="@yield('description', 'Описание моего сайта')">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
</head>
<body>
<header>
    <nav>
        <a href="/">Главная</a> | <a href="/about">О нас</a>
    </nav>
</header>

<main>
    <div class="flex-1">
{{--        brand header --}}
        <div>
            <h1 class="px-lg pb-xl mb-sm border-b border-outline-variant">SEO CMS</h1>
            <p>Система управления</p>
        </div>
{{--        navigation tabs--}}
        <aside>
            <nav>
                <ul>
                    <li><a href="#">Дашборд</a></li>
                    <li><a href="#">Структура</a></li>
                </ul>
            </nav>
        </aside>
    </div>
    <!-- Сюда будет вставляться основной контент -->
    @yield('content')
</main>

<footer>
    <p>&copy; 2026 Мое Laravel Приложение</p>
</footer>
</body>
</html>
