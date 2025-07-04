@extends('app')
@section('title', 'Forum Diskusi')
@section('content')
<div class="container py-2">

    <!-- Tombol Kembali -->
    <a href="{{ route('forum.index') }}" class="btn btn-outline-secondary mb-4"><i class="bi bi-arrow-left"></i> Kembali ke Forum</a>

    <!-- Postingan Utama -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white border-bottom">
            <!-- User Block -->
            <div class="d-flex align-items-center">
                <img class="rounded-circle" src="https://placehold.co/40x40/{{ $discussion->user->role == 'admin' ? '0d6efd' : '198754' }}/ffffff?text={{ Str::substr($discussion->user->name, 0, 1) }}" alt="User Image">
                <div class="ms-3">
                    <a href="#" class="text-dark text-decoration-none fw-bold">{{ $discussion->user->name }}</a>
                    <div class="text-muted small">Diposting pada - {{ $discussion->created_at->diffForHumans() }}</div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <h2 class="mb-3">{{ $discussion->title }}</h2>
            <p>{{ $discussion->content }}</p>

            <!-- Tombol Aksi -->
            <div class="d-flex small text-muted mt-4">
                <a href="#" class="text-muted text-decoration-none me-3"><i class="bi bi-share me-1"></i> Bagikan</a>
            </div>
        </div>
    </div>
    <!-- Akhir Postingan Utama -->

    <!-- Judul Bagian Jawaban -->
    <h3 class="mb-4">Semua Jawaban ({{ $discussion->comments->count() }})</h3>

    <!-- Jawaban -->
    @foreach ($discussion->comments->sortByDesc('created_at') as $comment)
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <div class="d-flex">
                <img class="rounded-circle" src="https://placehold.co/40x40/{{ $comment->user->role == 'admin' ? '0d6efd' : ($comment->user->role == 'mentor' ? '198754' : '6c757d') }}/ffffff?text={{ Str::substr($comment->user->name, 0, 1) }}" alt="User Image" style="width: 40px; height: 40px;">
                <div class="ms-3 flex-grow-1">
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold">{{ $comment->user->name }}</span>
                        <span class="text-muted small">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="mt-2">{{ $comment->content }}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Form untuk Menulis Balasan -->
    <div class="card shadow-sm mt-4">
        <div class="card-header">
            <h5 class="mb-0">Tulis Jawaban Anda</h5>
        </div>
        <div class="card-body">
            <div class="d-flex align-items-start">
                <img class="rounded-circle" src="https://placehold.co/40x40/{{ Auth::user()->role == 'admin' ? '0d6efd' : (Auth::user()->role == 'mentor' ? '198754' : '6c757d') }}/ffffff?text={{ Str::substr(Auth::user()->name, 0, 1) }}" alt="Your Avatar" style="width: 40px; height: 40px;">
                <form action="{{ route('forum.storeComment') }}" method="POST" class="ms-3 flex-grow-1">
                    @csrf
                    <input type="text" name="discussion_id" value="{{ $discussion->id }}" hidden>
                    <textarea class="form-control form-control-sm" name="content" placeholder="Ketik balasan Anda di sini..."></textarea>
                    <button type="submit" class="btn btn-primary btn-sm mt-2 float-end">Kirim Balasan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
