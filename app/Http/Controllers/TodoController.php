<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ToDoController extends Controller
{
    public function showWelcome()
    {
        // Menampilkan view 'welcome'
        return view('welcome');
    }

    
    public function index()
    {
        $todos = \App\Models\Todo::all(); // Mengambil semua tugas dari database
        return view('todos.index', compact('todos')); // Mengirim data ke view
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

    // Buat tugas baru
    \App\Models\Todo::create([
        'title' => $request->title,
        'description' => $request->description,
        'is_completed' => false,
    ]);

    return redirect()->route('todos.index')->with('success', 'Tugas berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

    // Temukan tugas berdasarkan ID dan perbarui
        $todo = \App\Models\Todo::findOrFail($id);
        $todo->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('todos.index')->with('success', 'Tugas berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $todo = \App\Models\Todo::findOrFail($id);
        $todo->delete();

        return redirect()->route('todos.index')->with('success', 'Tugas berhasil dihapus!');
    }

    public function toggleComplete($id)
    {
        $todo = \App\Models\Todo::findOrFail($id);
        $todo->is_completed = !$todo->is_completed; // Toggle status
        $todo->save();

        return redirect()->route('todos.index')->with('success', 'Status tugas berhasil diperbarui!');
    }


}
