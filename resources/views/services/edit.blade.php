@extends('layouts.app')

@section('header')
    Edit Service
@endsection

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden p-6">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-lg font-bold text-gray-800">Edit Service: {{ $service->title }}</h2>
        <a href="{{ route('dashboard') }}" class="text-xs text-gray-600 hover:underline">
            ← Back to Dashboard
        </a>
    </div>

    <form action="{{ route('dashboard.services.update', $service->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @csrf
        @method('PUT')

        <div class="md:col-span-2">
            <label class="block text-xs font-semibold text-gray-700 mb-1">Service Title *</label>
            <input type="text" name="title" value="{{ old('title', $service->title) }}" required class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
        </div>

        <div class="md:col-span-2">
            <label class="block text-xs font-semibold text-gray-700 mb-1">Description *</label>
            <textarea name="description" rows="4" required class="w-full border-gray-300 rounded-lg shadow-sm text-sm">{{ old('description', $service->description) }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1">Button Text</label>
            <input type="text" name="button_text" value="{{ old('button_text', $service->button_text) }}" placeholder="Book Now" class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-700 mb-1">Button URL</label>
            <input type="url" name="button_url" value="{{ old('button_url', $service->button_url) }}" placeholder="https://..." class="w-full border-gray-300 rounded-lg shadow-sm text-sm">
        </div>

        <div class="md:col-span-2">
            <label class="block text-xs font-semibold text-gray-700 mb-1">Service Image</label>
            <input type="file" name="image" class="block w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:bg-emerald-50 file:text-emerald-700">
            @if(!empty($service->image))
                <img src="{{ asset('storage/' . $service->image) }}" class="h-16 mt-2 rounded border">
            @endif
        </div>

        <div class="md:col-span-2 text-right mt-4">
            <button type="submit" class="px-5 py-2 bg-emerald-600 text-white rounded-lg text-sm font-semibold hover:bg-emerald-700">
                Update Service
            </button>
        </div>
    </form>
</div>
@endsection