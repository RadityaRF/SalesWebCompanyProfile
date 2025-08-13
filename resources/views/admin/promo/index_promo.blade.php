@extends('admin.layouts.main')
@section('title', 'Promo Banners')
@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Promo Banners</h2>

    {{-- Upload Form --}}
        <form action="{{ route('admin.promo.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" required>
        <textarea name="description"></textarea>
        <input type="file" name="image" required>
        <input type="date" name="start_date" required>
        <input type="date" name="end_date" required>
        <button type="submit">Save</button>
    </form>


    {{-- Banner List --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse($files as $file)
            <div class="bg-white border rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                <img src="{{ $file['url'] }}" alt="{{ $file['name'] }}" class="w-full h-40 object-cover">
                <div class="p-4 flex justify-between items-center">
                    <span class="text-sm text-gray-700 truncate" title="{{ $file['name'] }}">
                        {{ $file['name'] }}
                    </span>
                    <form action="{{ route('admin.promo.destroy', urlencode($file['name'])) }}" method="POST" onsubmit="return confirm('Delete this banner?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                            class="text-red-600 hover:text-red-800 text-sm font-medium">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500">No banners uploaded yet.</p>
        @endforelse
    </div>
</div>
@endsection
