@extends('app')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-primary shadow-sm">
                    <i class="bi bi-people-fill"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Akun</span>
                    <span class="info-box-number">
                        {{ $users->count() }}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-danger shadow-sm">
                    <i class="bi bi-person-fill-gear"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Admin</span>
                    <span class="info-box-number">{{ $users->where('role', 'admin')->count() }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-warning text-white shadow-sm">
                    <i class="bi bi-person-fill-lock"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Mentor</span>
                    <span class="info-box-number">{{ $users->where('role', 'mentor')->count() }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-success shadow-sm">
                    <i class="bi bi-person-fill"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Total User</span>
                    <span class="info-box-number">{{ $users->where('role', 'user')->count() }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
