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
    }

    .forum-card {
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
        margin-bottom: 25px;
    }

    .comment-card {
        background: #f8fafc;
        border-left: 4px solid #2563eb;
        border-radius: 12px;
        padding: 12px 16px;
        margin-top: 14px;
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

    .comment-form button:hover {
        color: #1e3fae;
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

                        <label class="fw-semibold mt-2">Judul</label>
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

    <div class="card forum-card p-3">

        {{-- HEADER POST --}}
        <div class="d-flex align-items-center mb-2">
            <div class="fw-bold">{{ $post->user->name ?? 'Anonim' }}</div>
            <div class="text-muted ms-2">
                • {{ $post->created_at->format('d M Y, H:i') }}
            </div>
        </div>

        {{-- JUDUL & ISI --}}
        <h5 class="fw-bold">{{ $post->title }}</h5>

        <p class="mb-1">{{ $post->content }}</p>

        {{-- KOMENTAR --}}
        <div class="comment-card">
            <p class="fw-bold mb-2">
                Komentar ({{ $post->comments_count ?? $post->comments->count() }})
            </p>

            @forelse($post->comments as $comment)
            <div class="mb-1">
                <span class="text-primary fw-semibold">{{ $comment->user->name ?? 'Anonim' }}</span> :
                <span>{{ $comment->komentar }}</span>
            </div>
            @empty
            <p class="text-muted mb-0">Belum ada komentar.</p>
            @endforelse
        </div>

        {{-- FORM INPUT KOMENTAR --}}
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