@extends('layouts.forumdiscuss') 

@section('title', 'Library-Hub Discussion Forum')

{{-- 1. Menyuntikkan CSS khusus Forum --}}
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
    /* Mengatasi background-color di Master Layout */
    body {
        background-color: #f6f7fb; 
    }

    /* Styling Kustom Forum */
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
        transition: background-color 0.2s;
    }
    .add-post-btn:hover {
        background-color: #0b5ed7;
    }
</style>
@endpush

{{-- 2. Menghilangkan Search Form (Jika tidak diperlukan di Forum) --}}
@section('search_form')
    {{-- Biarkan kosong, atau tambahkan form jika dibutuhkan --}}
@endsection

{{-- 3. Konten Utama --}}
@section('content')

<div class="container forum-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Forum Diskusi</h3>
        <button class="add-post-btn" data-bs-toggle="modal" data-bs-target="#createPostModal">Buat Post Baru</button>
    </div>

    <div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('forum.post.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createPostModalLabel">Buat Post Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="postTitle" class="form-label">Judul</label>
                            <input type="text" name="title" id="postTitle" class="form-control" placeholder="Judul Postingan..." required>
                        </div>
                        <div class="mb-3">
                            <label for="postContent" class="form-label">Isi Post</label>
                            <textarea name="content" id="postContent" class="form-control" rows="5" placeholder="Tulis topik atau pertanyaan kamu di sini..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($posts as $post)
        <div class="forum-card">
            <strong>{{ $post->user->name ?? 'Anonim' }}</strong>
            <small class="text-muted"> • {{ $post->created_at->format('d M Y, H:i') }}</small>
            
            <h5 class="mt-2 fw-bold">{{ $post->title }}</h5> 
            
            <p class="mt-2">{{ $post->content }}</p>

            <div class="comment-box">
                <p class="mb-1"><strong>Komentar ({{ $post->comments_count ?? $post->comments->count() }}):</strong></p>
                @forelse ($post->comments as $comment)
                    <p><strong>{{ $comment->user->name ?? 'Anonim' }}:</strong> {{ $comment->komentar }}</p>
                @empty
                    <p class="text-muted">Belum ada komentar.</p>
                @endforelse
            </div>

            {{-- Form untuk Komentar --}}
            <form action="{{ route('forum.comment', $post->id_post) }}" method="POST" class="d-flex align-items-center mt-3">
                @csrf
                <input type="text" name="komentar" class="input-comment form-control me-2" placeholder="Tulis komentar..." required>
                <button type="submit" class="btn-send"><i class="bi bi-send"></i></button>
            </form>
        </div>
    @endforeach
</div>

{{-- Script Bootstrap JS --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endpush

@endsection