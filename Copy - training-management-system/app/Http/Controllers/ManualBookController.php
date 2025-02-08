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

        $manualBook = ManualBook::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
        ]);

        return response()->json($manualBook);
    }

    public function edit(Banner $book)
    {
        return response()->json($book);
    }

    public function update(Request $request, ManualBook $book)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'file' => 'required|mimes:pdf|max:102400',
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($book->file);
            $filePath = $request->file('file')->store('manual_books', 'public');
            $book->file = $filePath;
        }

        $book->title = $request->title;
        $book->description = $request->description;
        $book->save();

        return redirect()->route('manual_books.index')->with('success', 'Manual Book updated successfully.');
    }

    public function show(ManualBook $book)
    {
        return response()->json($book);
    }

    public function destroy(ManualBook $book)
    {
        Storage::disk('public')->delete($book->image);
        $book->delete();
        return redirect()->route('manual_books.index')->with('success', 'Manual Book deleted successfully.');
    }
}