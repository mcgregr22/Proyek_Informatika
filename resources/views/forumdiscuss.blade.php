@extends('layouts.forumdiscuss')

@section('title', 'Library-Hub Discussion Forum')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body {
        background: #eef1f6;
        font-family: "Inter", sans-serif;
    }

    .forum-container {
        margin-top: 35px;
        margin-bottom: 60px;
        max-width: 820px;
    }

    .forum-card {
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
        margin-bottom: 25px;
        padding: 22px;
    }

    .post-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .post-user {
        font-weight: 600;
        font-size: 15px;
    }

    .post-date {
        font-size: 13px;
        color: gray;
    }

    .comment-card {
        background: #f8fafc;
        border-left: 4px solid #2563eb;
        border-radius: 12px;
        padding: 14px 16px;
        margin-top: 18px;
    }

    .comment-line {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
    }

    .comment-user {
        font-weight: 600;
        color: #2563eb;
    }

    .comment-text {
        font-size: 15px;
    }

    .comment-form input {
        border-radius: 30px;
        padding: 10px 16px;
    }

    .comment-form button {
        border: none;
        background: transparent;
        font-size: 20px;
        color: #2563eb;
        padding-left: 10px;
    }

    .delete-btn {
        padding: 4px 8px;
        font-size: 14px;
    }
</style>
@endpush

@section('content')
<div class="container forum-container">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-3">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h3 class="fw-bold m-0">Forum Diskusi</h3>
        </div>

        <button class="btn btn-primary px-3 rounded-3" data-bs-toggle="modal" data-bs-target="#createPostModal">
            <i class="bi bi-plus-circle me-1"></i> Post Baru
        </button>
    </div>

    {{-- Modal Buat Post --}}
    <div class="modal fade" id="createPostModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{ route('forum.post.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Buat Post Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <label class="fw-semibold">Judul</label>
                        <input type="text" name="title" class="form-control" required>

                        <label class="fw-semibold mt-3">Isi</label>
                        <textarea name="content" class="form-control" rows="5" required></textarea>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    {{-- LIST POST --}}
    @forelse($posts as $post)

    <div class="card forum-card">

        {{-- POST HEADER --}}
        <div class="post-header">

            {{-- User + date --}}
            <div>
                <div class="post-user">{{ $post->user->name ?? 'Anonim' }}</div>
                <div class="post-date">{{ $post->created_at->format('d M Y, H:i') }}</div>
            </div>

            {{-- Delete Button for Admin or Post Owner --}}
            @auth
            @if(Auth::user()->role == 'admin' || $post->user_id == Auth::id())
            <form action="{{ route('forum.post.delete', $post->id_post) }}"
                method="POST"
                onsubmit="return confirm('Yakin ingin hapus post ini?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm delete-btn">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
            @endif
            @endauth

        </div>

        {{-- CONTENT --}}
        <h5 class="fw-bold mt-3">{{ $post->title }}</h5>
        <p>{{ $post->content }}</p>

        {{-- KOMENTAR --}}
        <div class="comment-card">
            <p class="fw-bold mb-2">
                Komentar ({{ $post->comments_count ?? $post->comments->count() }})
            </p>

            @forelse($post->comments as $comment)
            <div class="comment-line">

                <div>
                    <span class="comment-user">{{ $comment->user->name ?? 'Anonim' }}</span> :
                    <span class="comment-text">{{ $comment->komentar }}</span>
                </div>

                {{-- Delete Button for Admin or Comment Owner --}}
                @if(auth()->check() && (auth()->user()->role === 'admin' || $comment->user_id == auth()->id()))
                <form action="{{ route('forum.comment.delete', $comment->id_comment) }}" method="POST"
                    onsubmit="return confirm('Hapus komentar ini?')">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-sm btn-danger py-0 px-2">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
                @endif

            </div>
            @empty
            <p class="text-muted mb-0">Belum ada komentar.</p>
            @endforelse
        </div>

        {{-- COMMENT FORM --}}
        <form action="{{ route('forum.comment', $post->id_post) }}"
            method="POST"
            class="comment-form d-flex align-items-center mt-3">

            @csrf

            <input type="text" name="komentar" class="form-control" placeholder="Tulis komentar..." required>

            <button type="submit">
                <i class="bi bi-send-fill"></i>
            </button>
        </form>

    </div>

    @empty

    {{-- EMPTY STATE --}}
    <div class="text-center p-5">
        <i class="bi bi-chat-dots text-secondary" style="font-size: 64px;"></i>
        <h4 class="mt-3 text-muted fw-bold">Belum ada postingan</h4>
        <p class="text-muted">Mulai diskusi pertamamu dengan membuat post baru!</p>

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPostModal">
            Buat Post Baru
        </button>
    </div>

    @endforelse

</div>
@endsection