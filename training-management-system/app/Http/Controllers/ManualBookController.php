<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManualBook;
use Illuminate\Support\Facades\Storage;

class ManualBookController extends Controller
{
    public function index()
    {
        $manual_books = ManualBook::all();
        return view('manual_books.index', compact('manual_books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'file' => 'required|mimes:pdf|max:102400',
        ]);

        $filePath = $request->file('file')->store('manual_books', 'public');

        ManualBook::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
        ]);

        return redirect()->route('manual_books.index')->with('success', 'Manual Book berhasil ditambahkan.');
    }

    public function show(ManualBook $manualBook)
    {
        return response()->json($manualBook);
    }

    public function destroy(ManualBook $manualBook)
    {
        Storage::disk('public')->delete($manualBook->file_path);
        $manualBook->delete();
        return redirect()->route('manual_books.index')->with('success', 'Manual Book deleted successfully.');
    }
}
