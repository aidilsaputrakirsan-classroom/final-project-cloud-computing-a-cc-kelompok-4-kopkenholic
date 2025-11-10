@extends('dashboard.master')

@section('title', 'Pesan Masuk')

@section('content')
<div class="container">
    <h2>Pesan Masuk</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Subjek</th>
                <th>Pesan</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($messages as $msg)
                <tr>
                    <td>{{ $msg->name }}</td>
                    <td>{{ $msg->email }}</td>
                    <td>{{ $msg->subject ?? '-' }}</td>
                    <td>{{ Str::limit($msg->message, 50) }}</td>
                    <td>{{ $msg->created_at->format('d M Y H:i') }}</td>
                    <td>
                        <form action="{{ route('dashboard.contact.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Yakin hapus pesan ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">Belum ada pesan.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $messages->links() }}
</div>
@endsection
