<<<<<<< Updated upstream
@extends('dashboard.master')

@section('title', 'Log Aktivitas')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Log Aktivitas</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Aktivitas User</h3>
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Waktu</th>
                                <th>User</th>
                                <th>Aktivitas</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($logs as $index => $log)
                                <tr>
                                    <td>{{ $logs->firstItem() + $index }}</td>
                                    <td>{{ $log->created_at }}</td>
                                    <td>{{ $log->username }}</td>
                                    <td>{{ $log->activity }}</td>
                                    <td>{{ $log->detail }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        Belum ada aktivitas yang tercatat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer clearfix">
                    {{ $logs->links() }}
                </div>
            </div>

        </div>
    </section>
=======
@extends('dashboard.layouts.app') 
{{-- Kalau layout-mu beda (misal: layouts.dashboard), sesuaikan nama ini --}}

@section('title', 'Activity Logs')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Activity Logs</h1>
    </div>

    <div class="card">
        <div class="card-header">
            <strong>Daftar Aktivitas Pengguna</strong>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th style="width: 60px;">#</th>
                            <th>User</th>
                            <th>Action</th>
                            <th>Description</th>
                            <th>Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $index => $log)
                            <tr>
                                <td>{{ $logs->firstItem() + $index }}</td>
                                <td>
                                    {{ $log->user?->name ?? 'Unknown' }}
                                    <br>
                                    <small class="text-muted">
                                        ID: {{ $log->user_id }}
                                    </small>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $log->action }}
                                    </span>
                                </td>
                                <td>{{ $log->description ?? '-' }}</td>
                                <td>
                                    {{ $log->created_at ? $log->created_at->format('d-m-Y H:i') : '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    Belum ada aktivitas yang tercatat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($logs->hasPages())
            <div class="card-footer">
                {{ $logs->links() }}
            </div>
        @endif
    </div>
>>>>>>> Stashed changes
</div>
@endsection
