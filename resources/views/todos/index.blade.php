<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
</head>
<body>
    <h1>Todo List</h1>

    <!-- Form untuk Menambah Tugas Baru -->
    <form action="{{ route('todos.store') }}" method="POST">
        @csrf
        <label for="title">Judul Tugas:</label>
        <input type="text" name="title" id="title" required>
        
        <label for="description">Deskripsi:</label>
        <textarea name="description" id="description"></textarea>
        
        <button type="submit">Tambah Tugas</button>
    </form>

    <!-- Daftar Tugas -->
    <h2>Daftar Tugas</h2>
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if ($todos->isEmpty())
        <p>Tidak ada tugas.</p>
    @else
        <ul>
            @foreach ($todos as $todo)
                <li>
                    <form action="{{ route('todos.toggle', $todo->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit">
                            {{ $todo->is_completed ? 'Selesai' : 'Belum Selesai' }}
                        </button>
                    </form>
                    
                    <strong>{{ $todo->title }}</strong> - {{ $todo->description }}
                    
                    <!-- Form untuk Mengedit Tugas -->
                    <form action="{{ route('todos.update', $todo->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <input type="text" name="title" value="{{ $todo->title }}" required>
                        <input type="text" name="description" value="{{ $todo->description }}">
                        <button type="submit">Edit</button>
                    </form>
                    
                    <!-- Form untuk Menghapus Tugas -->
                    <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>
