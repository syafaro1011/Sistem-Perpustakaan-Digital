@extends('layouts.app')
@section('title', 'Activity Log')
@section('page-title', 'Activity Log')

@section('breadcrumb')
    <li class="breadcrumb-item active">Activity Log</li>
@endsection

@push('styles')
    <style>
        .event-badge-created {
            background: #d1fae5;
            color: #065f46;
        }

        .event-badge-updated {
            background: #dbeafe;
            color: #1e40af;
        }

        .event-badge-deleted {
            background: #fee2e2;
            color: #991b1b;
        }

        .event-badge-default {
            background: #f3f4f6;
            color: #374151;
        }

        .log-badge {
            font-size: .7rem;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 20px;
            display: inline-block;
        }

        .prop-table {
            font-size: .8rem;
            width: 100%;
        }

        .prop-table td {
            padding: 2px 6px;
            vertical-align: top;
        }

        .prop-old {
            color: #991b1b;
            text-decoration: line-through;
        }

        .prop-new {
            color: #065f46;
        }

        .prop-key {
            color: #6b7280;
            width: 40%;
        }
    </style>
@endpush

@section('content')

    {{-- ── Filter ───────────────────────────────────────────────────── --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body py-3">
            <form method="GET" class="row g-2 align-items-end">
                <div class="col-md-2">
                    <label class="form-label small fw-semibold mb-1">Modul</label>
                    <select name="log_name" class="form-select form-select-sm">
                        <option value="">Semua Modul</option>
                        @foreach($logNames as $name)
                            <option value="{{ $name }}" {{ request('log_name') === $name ? 'selected' : '' }}>
                                {{ ucfirst($name) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-semibold mb-1">Event</label>
                    <select name="event" class="form-select form-select-sm">
                        <option value="">Semua Event</option>
                        <option value="created" {{ request('event') === 'created' ? 'selected' : '' }}>Created</option>
                        <option value="updated" {{ request('event') === 'updated' ? 'selected' : '' }}>Updated</option>
                        <option value="deleted" {{ request('event') === 'deleted' ? 'selected' : '' }}>Deleted</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-semibold mb-1">User</label>
                    <select name="causer_id" class="form-select form-select-sm">
                        <option value="">Semua User</option>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}" {{ request('causer_id') == $u->id ? 'selected' : '' }}>
                                {{ $u->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-semibold mb-1">Dari Tanggal</label>
                    <input type="date" name="dari" class="form-control form-control-sm" value="{{ request('dari') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-semibold mb-1">Sampai Tanggal</label>
                    <input type="date" name="sampai" class="form-control form-control-sm" value="{{ request('sampai') }}">
                </div>
                <div class="col-md-1 d-flex gap-1">
                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        <i class="bi bi-search"></i>
                    </button>
                    <a href="{{ route('activity-log.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-x"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- ── Header + Hapus Semua ─────────────────────────────────────── --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <div>
                <h6 class="mb-0 fw-semibold">
                    <i class="bi bi-clock-history me-2 text-primary"></i>Activity Log
                </h6>
                <small class="text-muted">
                    Total {{ $logs->total() }} log ditemukan
                </small>
            </div>
            <form action="{{ route('activity-log.destroy-all') }}" method="POST"
                onsubmit="return confirm('Hapus SEMUA log? Tindakan ini tidak bisa dibatalkan!')">
                @csrf @method('DELETE')
                <button class="btn btn-outline-danger btn-sm">
                    <i class="bi bi-trash3 me-1"></i>Hapus Semua Log
                </button>
            </form>
        </div>

        <div class="card-body p-0">
            @forelse($logs as $log)
                @php
                    $eventClass = match ($log->event) {
                        'created' => 'event-badge-created',
                        'updated' => 'event-badge-updated',
                        'deleted' => 'event-badge-deleted',
                        default => 'event-badge-default',
                    };
                    $eventIcon = match ($log->event) {
                        'created' => 'bi-plus-circle-fill text-success',
                        'updated' => 'bi-pencil-fill text-primary',
                        'deleted' => 'bi-trash-fill text-danger',
                        default => 'bi-info-circle-fill text-secondary',
                    };
                    $properties = $log->properties;
                    $oldAttrs = $properties->get('old', []);
                    $newAttrs = $properties->get('attributes', []);
                @endphp

                <div class="d-flex gap-3 px-4 py-3 border-bottom hover-bg">

                    {{-- Icon Event --}}
                    <div class="flex-shrink-0 pt-1">
                        <i class="bi {{ $eventIcon }}" style="font-size:1.1rem"></i>
                    </div>

                    {{-- Konten --}}
                    <div class="flex-grow-1 overflow-hidden">
                        <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                            {{-- Modul badge --}}
                            <span class="log-badge bg-dark bg-opacity-10 text-dark">
                                {{ strtoupper($log->log_name) }}
                            </span>

                            {{-- Event badge --}}
                            <span class="log-badge {{ $eventClass }}">
                                {{ strtoupper($log->event ?? 'LOG') }}
                            </span>

                            {{-- Deskripsi --}}
                            <span class="small fw-semibold">{{ $log->description }}</span>
                        </div>

                        <div class="d-flex align-items-center gap-3 text-muted small mb-2">
                            {{-- Causer --}}
                            <span>
                                <i class="bi bi-person me-1"></i>
                                @if($log->causer)
                                    <strong>{{ $log->causer->name }}</strong>
                                    <span class="badge bg-{{ $log->causer->role === 'admin' ? 'danger' : 'primary' }}
                                                     ms-1" style="font-size:.6rem">
                                        {{ strtoupper($log->causer->role) }}
                                    </span>
                                @else
                                    <em>System</em>
                                @endif
                            </span>

                            {{-- Subject --}}
                            @if($log->subject)
                                <span>
                                    <i class="bi bi-box me-1"></i>
                                    {{ class_basename($log->subject_type) }} #{{ $log->subject_id }}
                                </span>
                            @endif

                            {{-- Waktu --}}
                            <span>
                                <i class="bi bi-clock me-1"></i>
                                {{ $log->created_at->diffForHumans() }}
                                <span class="text-muted">({{ $log->created_at->format('d/m/Y H:i:s') }})</span>
                            </span>
                        </div>

                        {{-- Properties: Old vs New ──────────────────────── --}}
                        @if($log->event === 'updated' && count($oldAttrs) > 0)
                            <div class="bg-light rounded p-2 mt-1" style="font-size:.78rem">
                                <div class="fw-semibold text-muted mb-1 small">
                                    <i class="bi bi-arrow-left-right me-1"></i>Perubahan:
                                </div>
                                <table class="prop-table">
                                    @foreach($oldAttrs as $key => $oldVal)
                                        <tr>
                                            <td class="prop-key">{{ $key }}</td>
                                            <td class="prop-old">{{ $oldVal ?? 'null' }}</td>
                                            <td style="padding:2px 4px;color:#9ca3af">→</td>
                                            <td class="prop-new">{{ $newAttrs[$key] ?? 'null' }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        @elseif($log->event === 'created' && count($newAttrs) > 0)
                            <div class="bg-light rounded p-2 mt-1" style="font-size:.78rem">
                                <div class="fw-semibold text-muted mb-1 small">
                                    <i class="bi bi-plus me-1"></i>Data Dibuat:
                                </div>
                                <table class="prop-table">
                                    @foreach($newAttrs as $key => $val)
                                        <tr>
                                            <td class="prop-key">{{ $key }}</td>
                                            <td class="prop-new">{{ $val ?? 'null' }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        @elseif($log->event === 'deleted' && count($oldAttrs) > 0)
                            <div class="bg-light rounded p-2 mt-1" style="font-size:.78rem">
                                <div class="fw-semibold text-muted mb-1 small">
                                    <i class="bi bi-trash me-1"></i>Data Dihapus:
                                </div>
                                <table class="prop-table">
                                    @foreach($oldAttrs as $key => $val)
                                        <tr>
                                            <td class="prop-key">{{ $key }}</td>
                                            <td class="prop-old">{{ $val ?? 'null' }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        @endif
                    </div>

                    {{-- Tombol Hapus --}}
                    <div class="flex-shrink-0">
                        <form action="{{ route('activity-log.destroy', $log) }}" method="POST"
                            onsubmit="return confirm('Hapus log ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger py-0 px-2">
                                <i class="bi bi-trash" style="font-size:.8rem"></i>
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-clock-history" style="font-size:3rem;opacity:.3"></i>
                    <p class="mt-3">Belum ada activity log.</p>
                </div>
            @endforelse
        </div>

        @if($logs->hasPages())
            <div class="card-footer bg-white">
                {{ $logs->links() }}
            </div>
        @endif
    </div>

@endsection

@push('styles')
    <style>
        .hover-bg:hover {
            background: #f8fafc;
        }
    </style>
@endpush