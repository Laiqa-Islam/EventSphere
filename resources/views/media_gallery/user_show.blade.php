<x-website-layout>
    <div class="container py-4">
        <h2>{{ $media->event->title }}</h2>
        <p><strong>Category:</strong> {{ $media->event->category }}</p>
        <p><strong>Venue:</strong> {{ $media->event->venue->name ?? 'TBA' }}</p>
        <p><strong>Organizer:</strong> {{ $media->event->organizer->name }}</p>
        <p><strong>Rules:</strong>
            @if($media->event->rulebook)
                <a href="{{ asset('storage/' . $media->event->rulebook) }}" target="_blank">Download Rulebook</a>
            @else
                No rulebook available
            @endif
        </p>

        <div class="mb-4">
            @if($media->file_type === 'image')
                <img src="{{ asset('storage/' . $media->file_url) }}" class="img-fluid rounded">
            @else
                <video controls class="w-100 rounded">
                    <source src="{{ asset('storage/' . $media->file_url) }}" type="video/mp4">
                </video>
            @endif
        </div>

        @auth
            <form action="{{ route('favorites.toggle', $media->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit"
                    class="btn {{ auth()->user()->favorites->contains($media->id) ? 'btn-danger' : 'btn-outline-danger' }}">
                    <i class="fa fa-heart"></i>
                    {{ auth()->user()->favorites->contains($media->id) ? 'Favorited' : 'Favorite' }}
                </button>
            </form>
        @else
            <button class="btn btn-outline-secondary" disabled>
                <i class="fa fa-heart"></i> Login to favorite
            </button>
        @endauth
    </div>

</x-website-layout>