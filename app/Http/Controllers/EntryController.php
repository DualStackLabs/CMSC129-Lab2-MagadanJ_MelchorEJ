<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entry;

class EntryController extends Controller
{
    // 1. SHOW THE DASHBOARD (Read)
    public function index(Request $request)
    {
        $query = Entry::query();

        // Search feature
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        // Filter feature
        if ($request->filled('mood')) {
            $query->where('mood', $request->mood);
        }

        if ($request->filled('is_favorite') == '1') {
            $query->where('is_favorite', true);
        }

        $entries = $query->latest()->get();
        return view('entries.index', compact('entries'));
    }

    // 2. SHOW THE CREATE FORM
    public function create()
    {
        return view('entries.create');
    }

    // 3. SAVE THE NEW ENTRY (Create)
    // 3. SAVE THE NEW ENTRY (Create)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'mood' => 'required',
            'location' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:10240', // Validation is here
            'category_id' => 'required|integer'
        ]);

        // --- ADD THIS LOGIC ---
        if ($request->hasFile('image')) {
            // Stores in storage/app/public/entries
            $path = $request->file('image')->store('entries', 'public');
            $validated['image'] = $path;
        }
        // ----------------------

        $validated['is_favorite'] = $request->has('is_favorite');

        Entry::create($validated);

        return redirect('/entries')->with('success', 'Journal entry saved successfully!');
    }

     public function edit(Entry $entry)
    {
        return view('entries.edit', compact('entry'));
    }


    // 5. SAVE THE UPDATES (Update)
    public function update(Request $request, Entry $entry)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'mood' => 'required',
            'location' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:10240',
            'category_id' => 'required|integer'
        ]);

        // --- ADD THIS LOGIC ---
        if ($request->hasFile('image')) {
            // Optional: Delete old image if it exists to save space
            if ($entry->image) {
                \Storage::disk('public')->delete($entry->image);
            }
            
            $path = $request->file('image')->store('entries', 'public');
            $validated['image'] = $path;
        }
        // ----------------------

        $validated['is_favorite'] = $request->has('is_favorite');

        $entry->update($validated);

        return redirect('/entries')->with('success', 'Journal entry updated!');
    }

    // 6. SOFT DELETE THE ENTRY (Delete)
    public function destroy(Entry $entry)
    {
        $entry->delete();
        return redirect('/entries')->with('success', 'Entry moved to trash.');
    }

    public function trash()
    {
        // This fetches ONLY the items that were soft-deleted
        $trashedEntries = Entry::onlyTrashed()->latest()->get();
        
        return view('entries.trash', compact('trashedEntries'));
    }

    public function restore($id)
    {
        // We use findOrFail with onlyTrashed because a normal find() won't see it!
        $entry = Entry::onlyTrashed()->findOrFail($id);
        $entry->restore();

        return redirect()->route('entries.index')->with('success', 'Entry restored successfully!');
    }
}