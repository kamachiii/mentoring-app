 @forelse ($discussions as $discussion)
    <div class="card shadow-sm mb-4 discussion-card" style="cursor: pointer;" data-href="forum/{{ $discussion->id }}">
        <div class="card-header bg-white border-bottom">
            <!-- User Block -->
            <div class="d-flex align-items-center">
                <img class="rounded-circle" src="https://placehold.co/40x40/{{ $discussion->user->role == 'admin' ? '0d6efd' : '198754' }}/ffffff?text={{ Str::substr($discussion->user->name, 0, 1) }}" alt="User Image">
                <div class="ms-3">
                    <a href="#" class="text-dark text-decoration-none fw-bold">{{ $discussion->user->name }}</a>
                    <div class="text-muted small">Diposting pada - {{ $discussion->created_at->diffForHumans() }}</div>
                </div>

                @if (Auth::user()->id == $discussion->user_id || Auth::user()->role == 'admin')
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

    @empty
    <div class="alert alert-info text-center">
        Tidak ada diskusi yang ditemukan. Silakan buat diskusi baru atau cari topik lain.
    </div>
    @endforelse

    <!-- Komponen Paginasi -->
    <div class="d-flex justify-content-center">
        {{ $discussions->links('pagination::bootstrap-4') }}
    </div>
