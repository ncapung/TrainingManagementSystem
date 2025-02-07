<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManualBook;
use Illuminate\Support\Facades\Storage;

class ManualBookController extends Controller
{
    public function index()
    {
        $manualBooks = ManualBook::all();
        return view('manual_books.index', compact('manualBooks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
        ]);
        $filePath = $request->file('file')->store('manual_books');
        ManualBook::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
        ]);
        return redirect()->route('manual_books.index')->with('success', 'Manual Book berhasil ditambahkan.');
    }
    
    public function destroy(ManualBook $manualBook)
    {
        Storage::delete($manualBook->file_path);
        $manualBook->delete();
        return redirect()->route('manual_books.index')->with('success', 'Manual Book berhasil dihapus.');
    }
}