@foreach($galleries as $item)
    <div>
        <img src="{{ asset('storage/' . $item->image_path) }}" alt="Gallery Image">
    </div>
@endforeach