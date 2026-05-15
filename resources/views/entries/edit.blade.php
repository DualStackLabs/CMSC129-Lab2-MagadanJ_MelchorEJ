@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-2xl border border-pink-100 shadow-2xl shadow-pink-200/40 max-w-2xl mx-auto mb-10">
    <h2 class="text-3xl font-bold text-[#333] mb-6">Edit Entry</h2>

    <form id="editForm" action="/entries/{{ $entry->id }}" method="POST" enctype="multipart/form-data">
        @csrf 
        @method('PUT') 

        <div class="mb-4">
            <label class="block text-slate-700 font-bold mb-2">Title</label>
            <input type="text" name="title" value="{{ $entry->title }}" required class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#e22161] outline-none transition-all">
        </div>

        <div class="mb-4">
            <label class="block text-slate-700 font-bold mb-2">Content</label>
            <textarea name="content" rows="5" required class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#e22161] outline-none transition-all">{{ $entry->content }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-slate-700 font-bold mb-2">Mood</label>
                <select name="mood" required class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#e22161] outline-none cursor-pointer transition-all">
                    <option value="Happy" {{ $entry->mood == 'Happy' ? 'selected' : '' }}>Happy</option>
                    <option value="Focused" {{ $entry->mood == 'Focused' ? 'selected' : '' }}>Focused</option>
                    <option value="Stressed" {{ $entry->mood == 'Stressed' ? 'selected' : '' }}>Stressed</option>
                </select>
            </div>
            <div>
                <label class="block text-slate-700 font-bold mb-2">Location</label>
                <input type="text" name="location" value="{{ $entry->location }}" class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#e22161] outline-none transition-all">
            </div>
        </div>

        <div class="mb-6 flex items-center">
            <input type="checkbox" name="is_favorite" value="1" {{ $entry->is_favorite ? 'checked' : '' }} class="w-5 h-5 text-[#e22161] rounded cursor-pointer">
            <label class="ml-2 text-slate-700 font-bold cursor-pointer">Mark as Favorite ⭐</label>
        </div>

        <div class="mb-4">
            <label class="block text-slate-700 font-bold mb-2">Category</label>
            <select name="category_id" required class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#e22161] outline-none cursor-pointer transition-all">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $entry->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-8">
            <label class="block text-slate-700 font-bold mb-2">Update Image (Optional)</label>
            @if($entry->image)
                <p class="text-sm text-slate-500 mb-2">Current image saved. Uploading a new one will replace it.</p>
            @endif
            <input type="file" name="image" class="w-full p-2 border rounded-xl bg-[#fff0f5] cursor-pointer">
        </div>

        {{-- NEW CANCEL AND LOCKED UPDATE BUTTONS --}}
        <div class="flex items-center justify-end gap-4 pt-4 border-t border-slate-100">
            <a href="/entries" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-xl transition-colors">
                Cancel
            </a>
            
            <button type="submit" id="updateBtn" disabled
                    class="px-6 py-3 bg-[#e22161] text-white font-bold rounded-xl shadow-md transition-all opacity-50 cursor-not-allowed">
                Update Entry
            </button>
        </div>
    </form>
</div>

{{-- JAVASCRIPT TO LOCK/UNLOCK THE BUTTON --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('editForm');
        const updateBtn = document.getElementById('updateBtn');
        
        // Grab every input field inside the form (excluding the hidden Laravel tokens)
        const inputs = form.querySelectorAll('input:not([name="_token"]):not([name="_method"]), textarea, select');
        
        // Take a "snapshot" of the original values when the page loads
        const initialValues = {};
        inputs.forEach(input => {
            if (input.type === 'checkbox') {
                initialValues[input.name] = input.checked;
            } else {
                initialValues[input.name] = input.value;
            }
        });

        // Function that runs every time the user types or clicks something
        function checkChanges() {
            let hasChanged = false;
            
            // Compare current values against our snapshot
            inputs.forEach(input => {
                let currentValue = input.type === 'checkbox' ? input.checked : input.value;
                if (currentValue !== initialValues[input.name]) {
                    hasChanged = true;
                }
            });

            // Unlock button if changes exist, lock it if they changed it back to original
            if (hasChanged) {
                updateBtn.disabled = false;
                updateBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                updateBtn.classList.add('hover:opacity-90', 'hover:-translate-y-0.5'); // Adds a nice pop effect
            } else {
                updateBtn.disabled = true;
                updateBtn.classList.add('opacity-50', 'cursor-not-allowed');
                updateBtn.classList.remove('hover:opacity-90', 'hover:-translate-y-0.5');
            }
        }

        // Listen for typing ('input') and dropdown/checkbox clicks ('change')
        inputs.forEach(input => {
            input.addEventListener('input', checkChanges);
            input.addEventListener('change', checkChanges);
        });
    });
</script>
@endsection