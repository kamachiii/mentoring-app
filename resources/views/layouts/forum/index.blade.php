@extends('app')
@section('title', 'Forum Diskusi')
@section('content')
<div class="container py-2">
    <!-- Fitur Pencarian dan Sortir -->
    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'mentor')
    <div class="row mb-4">
        <div class="col-md-10">
            <form action="{{ route('forum.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" id="searchInput" name="search" placeholder="Cari topik diskusi..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#addDiscussionModal">
                <i class="bi bi-plus-circle me-1"></i> Tambah
            </button>
        </div>
        @else
        <div class="col-md-12">
            <form action="{{ route('forum.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" id="searchInput" name="search" placeholder="Cari topik diskusi..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
        @endif
    </div>

    @include('layouts.forum._discussion_list')

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

            // --- SCRIPT UNTUK LIVE SEARCH ---
            const searchInput = document.getElementById('searchInput');
            const discussionListContainer = document.getElementById('discussionListContainer');
            let debounceTimer;

            searchInput.addEventListener('keyup', function() {
                const query = this.value;

                // Hapus timer sebelumnya
                clearTimeout(debounceTimer);

                // Set timer baru (Debouncing)
                debounceTimer = setTimeout(() => {
                    // Buat URL untuk request AJAX
                    const url = `{{ route('forum.index') }}?search=${encodeURIComponent(query)}`;

                    // Tampilkan indikator loading (opsional, tapi bagus)
                    discussionListContainer.innerHTML = '<div class="text-center p-5"><span class="spinner-border" role="status" aria-hidden="true"></span><p class="mt-2">Mencari...</p></div>';

                    fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        // Ganti konten dengan hasil dari server
                        discussionListContainer.innerHTML = html;
                    })
                    .catch(error => {
                        console.error('Error fetching search results:', error);
                        // Tampilkan pesan error (opsional)
                        discussionListContainer.innerHTML = '<div class="alert alert-danger">Gagal memuat hasil. Silakan coba lagi.</div>';
                    });
                }, 300); // Tunggu 300ms setelah user berhenti mengetik
            });
    });
</script>
@endsection
