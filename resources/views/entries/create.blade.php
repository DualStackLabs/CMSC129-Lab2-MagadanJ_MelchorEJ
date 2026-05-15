@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-2xl border border-pink-100 shadow-2xl shadow-pink-200/40 max-w-2xl mx-auto">
    <h2 class="text-3xl font-extrabold text-[#333] mb-6">Write a New Entry</h2>
    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/entries" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf 

        <div>
            <label class="block text-slate-700 font-bold mb-2">Title</label>
            <input type="text" name="title" required 
                   class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#e22161] outline-none text-[#333]">
        </div>

        <div>
            <label class="block text-slate-700 font-bold mb-2">How are you feeling?</label>
            <textarea name="content" rows="6" required 
                      class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#e22161] outline-none text-[#333]"></textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-slate-700 font-bold mb-2">Mood</label>
                <select name="mood" required 
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#e22161] outline-none text-[#333] cursor-pointer">
                    <option value="Happy">Happy</option>
                    <option value="Focused">Focused</option>
                    <option value="Stressed">Stressed</option>
                </select>
            </div>
            <div>
                <label class="block text-slate-700 font-bold mb-2">Location (Optional)</label>
                <input type="text" name="location" placeholder="e.g., Coffee Shop" 
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#e22161] outline-none text-[#333]">
            </div>
        </div>

        <div class="flex items-center pt-2">
            <input type="checkbox" name="is_favorite" value="1" class="w-5 h-5 text-[#e22161] rounded cursor-pointer">
            <label class="ml-3 text-slate-700 font-bold cursor-pointer">Mark as Favorite ⭐</label>
        </div>

        <div class="mb-4">
            <label class="block text-slate-700 font-bold mb-2">Attached Image</label>
            <input type="file" name="image" class="w-full p-2 border rounded-xl bg-[#fff0f5]">
        </div>

        <input type="hidden" name="category_id" value="1">

        <button type="submit" class="w-full bg-[#e22161] text-white font-bold py-4 rounded-xl hover:bg-[#ce0d4d] transition duration-200 mt-4">
            Save Journal Entry
        </button>
    </form>
</div>
@endsection