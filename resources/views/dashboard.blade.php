@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h4 class="mb-1">Selamat datang, {{ auth()->user()->name }}! 👋</h4>
                    <p class="text-muted mb-0">
                        Kamu login sebagai
                        <strong class="text-{{ auth()->user()->role === 'admin' ? 'danger' : 'primary' }}">
                            {{ strtoupper(auth()->user()->role) }}
                        </strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection