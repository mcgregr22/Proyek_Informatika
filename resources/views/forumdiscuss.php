<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Library-Hub Discussion Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f6f7fb;
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            background-color: white;
        }

        .navbar-brand span {
            color: #0d6efd;
            font-weight: bold;
        }

        .navbar-icon {
            font-size: 1.2rem;
            margin-left: 15px;
            color: #333;
        }

        .forum-container {
            margin-top: 40px;
            margin-bottom: 50px;
        }

        .forum-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        }

        .comment-box {
            background: #f8f9fa;
            border-left: 3px solid #0d6efd;
            padding: 10px 15px;
            margin-top: 10px;
            border-radius: 8px;
        }

        .comment-box strong {
            color: #0d6efd;
        }

        .input-comment {
            border: 1px solid #ccc;
            border-radius: 20px;
            padding: 6px 12px;
            width: 90%;
            outline: none;
        }

        .btn-send {
            border: none;
            background: none;
            color: #0d6efd;
            font-size: 1.2rem;
        }

        .add-post-btn {
            background-color: #0d6efd;
            border: none;
            color: white;
            font-weight: 500;
            padding: 6px 16px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/homepage">
            Library-<span>Hub</span>
        </a>
        <ul class="navbar-nav ms-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                    Kategori
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Romance</a></li>
                    <li><a class="dropdown-item" href="#">Comedy</a></li>
                    <li><a class="dropdown-item" href="#">Fiction</a></li>
                </ul>
            </li>
        </ul>
        <form class="d-flex ms-auto me-3">
            <input class="form-control" type="search" placeholder="Cari Buku">
        </form>
        <ul class="navbar-nav align-items-center">
            <li class="nav-item"><a class="nav-link fw-semibold" href="/swapbook">Swapbook</a></li>
            <li class="nav-item"><a class="nav-link fw-semibold" href="/mycollection">My Collection</a></li>
        </ul>
        <div class="d-flex align-items-center ms-3">
            <a href="/keranjang" class="navbar-icon"><i class="bi bi-cart"></i></a>
            <a href="/forumdiscuss" class="navbar-icon"><i class="bi bi-chat-dots"></i></a>
            <a href="#" class="navbar-icon"><i class="bi bi-person-circle"></i></a>
        </div>
    </div>
</nav>

<div class="container forum-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Forum Diskusi</h3>
        <button class="add-post-btn">Add Post</button>
    </div>

    {{-- Simulasi data post --}}
    @php
        $posts = [
            [
                "user" => "davidbeckham",
                "date" => "14/2/2025",
                "content" => "Buku apa yaa yang cocok untuk orang yang pertama kali pengen baca buku tentang romance?",
                "comments" => [
                    ["user" => "davidbeckham", "text" => "Buku pergi pulang bagus sih!!"],
                    ["user" => "donaiandro", "text" => "Iyeeaa pergi pulang bagus tuh!!"]
                ]
            ],
            [
                "user" => "davidbeckham",
                "date" => "14/2/2025",
                "content" => "Buku apa yaa yang cocok untuk orang yang pertama kali pengen baca buku tentang romance?",
                "comments" => [
                    ["user" => "davidbeckham", "text" => "Buku pergi pulang bagus sih!!"],
                    ["user" => "donaiandro", "text" => "Iyeeaa pergi pulang bagus tuh!!"]
                ]
            ]
        ];
    @endphp

    @foreach ($posts as $post)
        <div class="forum-card">
            <strong>{{ $post['user'] }}</strong> • <small>{{ $post['date'] }}</small>
            <p class="mt-2">{{ $post['content'] }}</p>

            <div class="comment-box">
                <p class="mb-1"><strong>Komentar ...</strong></p>
                @foreach ($post['comments'] as $comment)
                    <p><strong>{{ $comment['user'] }} :</strong> {{ $comment['text'] }}</p>
                @endforeach
            </div>

            <div class="d-flex align-items-center mt-3">
                <strong class="me-2">{{ $post['user'] }}</strong>
                <input type="text" class="input-comment" placeholder="Tulis Disini ....">
                <button class="btn-send"><i class="bi bi-send"></i></button>
            </div>
        </div>
    @endforeach
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>