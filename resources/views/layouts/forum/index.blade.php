@extends('app')
@section('title', 'Forum Diskusi')
@section('content')
<div class="container py-2">
    <!-- Fitur Pencarian dan Sortir -->
    <div class="row mb-4">
        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'mentor')
        <div class="col-md-10">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari topik diskusi...">
                <button class="btn btn-primary" type="button"><i class="bi bi-search"></i></button>
            </div>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#addDiscussionModal">
                <i class="bi bi-plus-circle me-1"></i> Tambah
            </button>
        </div>
        @endif
    </div>

    @foreach ($discussions as $discussion)
    <div class="card shadow-sm mb-4 discussion-card" style="cursor: pointer;" data-href="forum/{{ $discussion->id }}">
        <div class="card-header bg-white border-bottom">
            <!-- User Block -->
            <div class="d-flex align-items-center">
                <img class="rounded-circle" src="https://placehold.co/40x40/{{ $discussion->user->role == 'admin' ? '0d6efd' : '198754' }}/ffffff?text={{ Str::substr($discussion->user->name, 0, 1) }}" alt="User Image">
                <div class="ms-3">
                    <a href="#" class="text-dark text-decoration-none fw-bold">{{ $discussion->user->name }}</a>
                    <div class="text-muted small">Diposting pada - {{ $discussion->created_at->diffForHumans() }}</div>
                </div>

                @if (Auth::user()->id == $discussion->user_id)
                <!-- Dropdown Edit/Hapus Diskusi -->
                <div class="ms-auto">
                    <div class="dropdown">
                        <a href="#" class="text-muted text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <button class="dropdown-item btn btn-transparent btn-sm"
                                        data-id="{{ $discussion->id }}"
                                        data-title="{{ $discussion->title }}"
                                        data-content="{{ $discussion->content }}"
                                        data-bs-toggle="modal" data-bs-target="#editMentoringGroupModal">
                                    <i class="bi bi-pencil-square me-2"></i>Edit
                                </button>
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('forum.destroy', $discussion->id) }}"
                                    data-confirm-delete>
                                    <i class="bi bi-trash me-2"></i>Hapus
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="card-body">
            <h4>{{ $discussion->title }}</h4>
            <p>{{ $discussion->content }}</p>

            <!-- Tombol Aksi dengan Bootstrap Icons -->
            <div class="d-flex small text-muted">
                <a href="#" class="text-muted text-decoration-none me-3 share-btn"><i class="bi bi-share me-1"></i> Bagikan</a>
                <a class="text-muted text-decoration-none ms-auto" data-bs-toggle="collapse" href="#collapseReplyForm{{ $discussion->id }}" role="button" aria-expanded="false" aria-controls="collapseReplyForm{{ $discussion->id }}">
                    <i class="bi bi-reply-fill me-1"></i> Balas
                </a>
            </div>
        </div>

        <!-- Bagian Komentar/Balasan (Collapsible) -->
        <div class="card-footer bg-white border-top">
            <a class="text-decoration-none text-dark d-block" data-bs-toggle="collapse" href="#collapseAnswers{{ $discussion->id }}" role="button" aria-expanded="false" aria-controls="collapseAnswers{{ $discussion->id }}">
                <h5 class="mb-0">Jawaban ({{ $discussion->comments->count() }})</h5>
            </a>

            <div class="collapse pt-3" id="collapseAnswers{{ $discussion->id }}">
                @foreach ($discussion->comments->sortByDesc('created_at')->take(2) as $comment)
                <div class="d-flex mb-3">
                    <img class="rounded-circle" src="https://placehold.co/40x40/{{ $comment->user->role == 'admin' ? '0d6efd' : ($comment->user->role == 'mentor' ? '198754' : '6c757d') }}/ffffff?text={{ Str::substr($comment->user->name, 0, 1) }}" alt="User Image" style="width: 40px; height: 40px;">
                    <div class="ms-3 flex-grow-1">
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">{{ $comment->user->name }}</span>
                            <span class="text-muted small">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        {{ $comment->content }}
                    </div>
                </div>
                @endforeach

                @if($discussion->comments->count() > 2)
                <div class="mt-3 text-center">
                    <a href="{{ route('forum.show', $discussion->id) }}" class="btn btn-outline-primary btn-sm rounded-pill">
                        <i class="bi bi-eye me-1"></i> Lihat semua komentar
                    </a>
                </div>
                @endif
            </div>
        </div>


        <!-- Form untuk Menulis Balasan (Collapsible) -->
        <div class="card-footer bg-white border-top pt-0">
            <div class="collapse" id="collapseReplyForm{{ $discussion->id }}">
                <div class="d-flex align-items-start pt-3">
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
    @endforeach

    <!-- Komponen Paginasi -->
    <div class="d-flex justify-content-center">
        {{ $discussions->links('pagination::bootstrap-4') }}
    </div>

</div>

<!-- Modal untuk Tambah Diskusi -->
<div class="modal fade" id="addDiscussionModal" tabindex="-1" aria-labelledby="addDiscussionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDiscussionModalLabel">Tambah Diskusi Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('forum.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="discussionTitle" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="discussionTitle" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="discussionContent" class="form-label">Konten</label>
                        <textarea class="form-control" id="discussionContent" name="content" rows="5" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editMentoringGroupModal" tabindex="-1" aria-labelledby="editMentoringGroupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMentoringGroupModalLabel">Edit Diskusi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('forum.update', 0) }}" id="editDiscussionForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editDiscussionTitle" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="editDiscussionTitle" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDiscussionContent" class="form-label">Konten</label>
                        <textarea class="form-control" id="editDiscussionContent" name="content" rows="5" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Setup for Edit Discussion Modal
        const editModal = document.getElementById('editMentoringGroupModal');
        if (editModal) {
            editModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const discussionId = button.getAttribute('data-id');
                const discussionTitle = button.getAttribute('data-title');
                const discussionContent = button.getAttribute('data-content');

                // Update form action with the correct discussion ID
                const formAction = "{{ route('forum.update', ':id') }}".replace(':id', discussionId);
                document.getElementById('editDiscussionForm').action = formAction;

                // Populate form fields
                document.getElementById('editDiscussionTitle').value = discussionTitle;
                document.getElementById('editDiscussionContent').value = discussionContent;
            });
        }

        // Setup for Discussion Card navigation
        const discussionCards = document.querySelectorAll('.discussion-card');
        discussionCards.forEach(card => {
            card.addEventListener('click', function(event) {
                // Jangan navigasi jika pengguna mengklik link, tombol, atau elemen interaktif lainnya
                if (event.target.closest('a, button, textarea, [data-bs-toggle="collapse"], [data-bs-toggle="dropdown"]')) {
                    return;
                }

                // Navigasi ke link yang ditentukan di atribut data-href
                const link = this.dataset.href;
                if (link) {
                    window.location.href = link;
                }
            });
        });

        // Script untuk tombol bagikan (copy link)
            const shareButtons = document.querySelectorAll('.share-btn');
            shareButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const card = this.closest('.discussion-card');
                    const detailUrl = new URL(card.dataset.href, window.location.href).href;

                    navigator.clipboard.writeText(detailUrl).then(() => {
                        const originalContent = this.innerHTML;
                        this.innerHTML = `<i class="bi bi-check-lg me-1"></i> Tersalin!`;
                        setTimeout(() => {
                            this.innerHTML = originalContent;
                        }, 2000);
                    }).catch(err => {
                        console.error('Gagal menyalin link: ', err);
                    });
                });
            });
    });
</script>
@endsection
