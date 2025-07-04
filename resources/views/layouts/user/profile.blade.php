@extends('app')
@section('title', 'Profile')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header text-center bg-dark text-white">
                        <h3 class="card-title mb-0"><i class="fas fa-id-badge mr-2"></i>Profile Information</h3>
                    </div>
                    <div class="card-body bg-white">
                        <div class="row">
                            <div class="col-md-4 text-center d-flex flex-column align-items-center justify-content-center">
                                <div class="mb-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=343a40&color=fff&size=128" alt="Avatar" class="rounded-circle shadow" width="110" height="110">
                                </div>
                                <span class="badge badge-dark px-3 py-2" style="font-size: 1rem;">{{ ucfirst(Auth::user()->role) }}</span>
                            </div>
                            <div class="col-md-8">
                                <table class="table table-borderless mb-0">
                                    <tr>
                                        <th style="width: 40%;">Nama</th>
                                        <td>{{ Auth::user()->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ Auth::user()->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Role</th>
                                        <td>{{ Auth::user()->role }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created At</th>
                                        <td>{{ Auth::user()->created_at->format('d M Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated At</th>
                                        <td>{{ Auth::user()->updated_at->format('d M Y H:i') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-dark text-white">
                        <h3 class="card-title mb-0"><i class="fas fa-id-badge mr-2"></i>Profile Information</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<style>
    .btn-gradient-primary:hover {
        background: linear-gradient(90deg, #2980b9 0%, #3498db 100%) !important;
        color: #fff !important;
    }
</style>
@endsection
