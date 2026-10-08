@extends('layouts.app')

@section('header')
    Edit Tour Package
@endsection

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden p-6">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-lg font-bold text-gray-800">Edit Tour: {{ $tour->title }}</h2>
        <a href="{{ route('dashboard.settings') }}" class="text-xs text-gray-600 hover:underline">
            ← Back to Dashboard
        </a>
    </div>

    <form action="{{ route('dashboard.tours.update', $tour->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1">Tour Title *</label>
            <input type="text" name="title" value="{{ old('title', $tour->title) }}" required class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1">Subtitle / Tagline</label>
            <input type="text" name="sub_title" value="{{ old('sub_title', $tour->sub_title) }}" class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1">Start Date</label>
            <input type="date" name="start_date" value="{{ old('start_date', $tour->start_date) }}" class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1">Duration *</label>
            <input type="text" name="duration" value="{{ old('duration', $tour->duration) }}" required class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1">Price ($) *</label>
            <input type="number" name="price" step="0.01" value="{{ old('price', $tour->price) }}" required class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
        </div>

        <div class="md:col-span-2">
            <label class="block text-xs font-semibold text-gray-700 mb-1">Description</label>
            <textarea name="description" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm text-sm">{{ old('description', $tour->description) }}</textarea>
        </div>

        <div class="md:col-span-2">
            <label class="block text-xs font-semibold text-gray-700 mb-1">Cover Image</label>
            <input type="file" name="image" class="block w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:bg-emerald-50 file:text-emerald-700">
            @if(!empty($tour->image))
                <img src="{{ asset('storage/' . $tour->image) }}" class="h-16 mt-2 rounded border">
            @endif
        </div>

        <!-- Tour Highlights Dynamic Section -->
        <div class="md:col-span-2 border-t pt-4 mt-2">
            <div class="flex justify-between items-center mb-2">
                <label class="block text-xs font-semibold text-gray-700">Tour Highlights</label>
                <button type="button" id="add-highlight" class="text-xs text-emerald-600 font-semibold hover:underline">+ Add Highlight</button>
            </div>
            
            <div id="highlights-wrapper" class="space-y-2">
                @php
                    $highlights = old('highlights',$tour->highlights ?? []);
                @endphp

                @if(!empty($highlights) && count($highlights) > 0)
                    @foreach($highlights as $index =>$hl)
                        <div class="flex items-center gap-2 highlight-row">
                            <input type="text" name="highlights[{{ $index }}][title]" value="{{ is_array($hl) ? ($hl['title'] ?? '') : ($hl->title ?? '') }}" placeholder="Title (e.g. Flight)" class="w-1/3 border-gray-300 rounded-lg shadow-sm text-sm">
                            <input type="text" name="highlights[{{ $index }}][duration]" value="{{ is_array($hl) ? ($hl['duration'] ?? '') : ($hl->duration ?? '') }}" placeholder="Duration (e.g. 2 hrs)" class="w-1/3 border-gray-300 rounded-lg shadow-sm text-sm">
                            <input type="number" step="0.01" name="highlights[{{ $index }}][price]" value="{{ is_array($hl) ? ($hl['price'] ?? '') : ($hl->price ?? '') }}" placeholder="Price ($)" class="w-1/3 border-gray-300 rounded-lg shadow-sm text-sm">
                            <button type="button" class="remove-highlight text-red-500 text-xs font-bold px-2">X</button>
                        </div>
                    @endforeach
                @else
                    <div class="flex items-center gap-2 highlight-row">
                        <input type="text" name="highlights[0][title]" placeholder="Title (e.g. Flight)" class="w-1/3 border-gray-300 rounded-lg shadow-sm text-sm">
                        <input type="text" name="highlights[0][duration]" placeholder="Duration (e.g. 2 hrs)" class="w-1/3 border-gray-300 rounded-lg shadow-sm text-sm">
                        <input type="number" step="0.01" name="highlights[0][price]" placeholder="Price ($)" class="w-1/3 border-gray-300 rounded-lg shadow-sm text-sm">
                        <button type="button" class="remove-highlight text-red-500 text-xs font-bold px-2">X</button>
                    </div>
                @endif
            </div>
        </div>

        <div class="md:col-span-2 text-right mt-4">
            <button type="submit" class="px-5 py-2 bg-emerald-600 text-white rounded-lg text-sm font-semibold hover:bg-emerald-700">
                Update Tour Package
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let highlightIndex = {{ count(old('highlights', $tour->highlights ?? [1])) }};
        const wrapper = document.getElementById('highlights-wrapper');
        
        document.getElementById('add-highlight').addEventListener('click', function() {
            const newRow = document.createElement('div');
            newRow.className = 'flex items-center gap-2 highlight-row';
            newRow.innerHTML = `
                <input type="text" name="highlights[${highlightIndex}][title]" placeholder="Title (e.g. Flight)" class="w-1/3 border-gray-300 rounded-lg shadow-sm text-sm">
                <input type="text" name="highlights[${highlightIndex}][duration]" placeholder="Duration (e.g. 2 hrs)" class="w-1/3 border-gray-300 rounded-lg shadow-sm text-sm">
                <input type="number" step="0.01" name="highlights[${highlightIndex}][price]" placeholder="Price ($)" class="w-1/3 border-gray-300 rounded-lg shadow-sm text-sm">
                <button type="button" class="remove-highlight text-red-500 text-xs font-bold px-2">X</button>
            `;
            wrapper.appendChild(newRow);
            highlightIndex++;
        });

        wrapper.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-highlight')) {
                if (wrapper.querySelectorAll('.highlight-row').length > 1) {
                    e.target.closest('.highlight-row').remove();
                } else {
                    alert('At least one highlight field must remain.');
                }
            }
        });
    });
</script>
@endsection