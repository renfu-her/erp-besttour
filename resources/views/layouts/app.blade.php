<!DOCTYPE html>
<html lang="zh-TW" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '控制台')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    @include('layouts.styles')
</head>

<body>
    @include('layouts.sidebar')

    <!-- 主要內容區 -->
    <div class="main-content" id="main-content">
        @include('layouts.header')

        <div class="container-fluid py-4">
            @yield('content')
        </div>

        @include('layouts.footer')
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/js/bootstrap.bundle.min.js"></script>
    @include('layouts.scripts')
</body>

</html>
