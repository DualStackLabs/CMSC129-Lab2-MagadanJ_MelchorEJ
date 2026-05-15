@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-2xl border border-pink-100 shadow-2xl shadow-pink-200/40 max-w-2xl mx-auto">
    <h2 class="text-3xl font-bold text-[#333] mb-6">Edit Entry</h2>

    <form action="/entries/{{ $entry->id }}" method="POST">
        @csrf 
        @method('PUT') <div class="mb-4">
            <label class="block text-slate-700 font-bold mb-2">Title</label>
            <input type="text" name="title" value="{{ $entry->title }}" required class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#e22161]">
        </div>

        <div class="mb-4">
            <label class="block text-slate-700 font-bold mb-2">Content</label>
            <textarea name="content" rows="5" required class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#e22161]">{{ $entry->content }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-slate-700 font-bold mb-2">Mood</label>
                <select name="mood" required class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#e22161]">
                    <option value="Happy" {{ $entry->mood == 'Happy' ? 'selected' : '' }}>Happy</option>
                    <option value="Focused" {{ $entry->mood == 'Focused' ? 'selected' : '' }}>Focused</option>
                    <option value="Stressed" {{ $entry->mood == 'Stressed' ? 'selected' : '' }}>Stressed</option>
                </select>
            </div>
            <div>
                <label class="block text-slate-700 font-bold mb-2">Location</label>
                <input type="text" name="location" value="{{ $entry->location }}" class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#e22161]">
            </div>
        </div>

        <div class="mb-6 flex items-center">
            <input type="checkbox" name="is_favorite" value="1" {{ $entry->is_favorite ? 'checked' : '' }} class="w-5 h-5 text-[#e22161] rounded">
            <label class="ml-2 text-slate-700 font-bold">Mark as Favorite ⭐</label>
        </div>

        <input type="hidden" name="category_id" value="1">

        <button type="submit" class="w-full bg-[#e22161] text-white font-bold py-3 rounded-lg hover:bg-[#ce0d4d] transition">
            Update Entry
        </button>
    </form>
</div>
@endsection