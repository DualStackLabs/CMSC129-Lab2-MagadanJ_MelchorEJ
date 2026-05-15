@extends('layouts.app')

@section('content')

<div class="mb-8 flex items-center gap-3">
    <i class="ph ph-trash text-4xl text-[#333]"></i>
    <div>
        <h2 class="text-3xl font-extrabold text-[#333] mb-1">Trash Bin</h2>
        <p class="text-slate-500 font-medium">Deleted entries are kept here until you destroy them forever.</p>
    </div>
</div>

@if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl mb-6">
        {{ session('success') }}
    </div>
@endif

<div class="space-y-6">
    @forelse($trashedEntries as $entry)
      <article class="bg-white p-6 rounded-2xl border border-pink-100 shadow-xl shadow-pink-200/40 hover:shadow-2xl hover:shadow-red-200/50 transition-all duration-300 group">
            <div class="flex justify-between items-start mb-3">
                <div class="flex items-center gap-3">
                    <h3 class="text-xl font-bold text-slate-400 line-through">{{ $entry->title }}</h3>
                </div>
                <span class="text-xs font-bold uppercase tracking-wider text-red-400 bg-red-50 px-3 py-1 rounded-full">
                    Deleted {{ $entry->deleted_at->diffForHumans() }}
                </span>
            </div>

            @if($entry->image)
                <div class="mb-4 overflow-hidden rounded-xl border border-slate-100 opacity-60 grayscale hover:grayscale-0 transition duration-500">
                    <img src="{{ asset('storage/' . $entry->image) }}" 
                        class="w-full h-32 object-cover">
                </div>
            @endif
            
            <p class="text-slate-400 leading-relaxed mb-4 line-clamp-2 italic">
                {{ $entry->content }}
            </p>
            
            <div class="flex justify-between items-center mt-4 pt-4 border-t border-slate-50">
                <div class="text-sm text-slate-400">
                    Originally written on {{ $entry->created_at->format('M d, Y') }}
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3 mt-4">
                    <button type="button" 
                            onclick="confirmAction(this, 'Bring this entry back?', '#10b981')" 
                            class="bg-emerald-50 text-emerald-700 hover:bg-emerald-100 px-5 py-2.5 rounded-xl text-sm font-bold tracking-tight transition-colors">
                        Restore
                    </button>
                    <form action="{{ route('entries.restore', $entry->id) }}" method="POST" class="hidden">
                        @csrf
                    </form>
                    
                    <button type="button" 
                            onclick="confirmAction(this, 'Delete this forever? This cannot be undone!', '#ef4444')" 
                            class="bg-red-50 text-red-700 hover:bg-red-100 px-5 py-2.5 rounded-xl text-sm font-bold tracking-tight transition-colors">
                        Destroy
                    </button>
                    <form action="{{ route('entries.forceDelete', $entry->id) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </article>
    @empty
        <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-slate-300">
            <p class="text-slate-500 mb-2 text-lg italic text-6xl">✨</p>
            <p class="text-slate-500 mb-4 text-lg">Your trash is empty.</p>
            <a href="/entries" class="text-[#e22161] font-semibold hover:underline">Back to Journal</a>
        </div>
    @endforelse
</div>

@endsection