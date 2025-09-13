<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold mb-6">My Favorites</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($favorites as $media)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if($media->file_type === 'image')
                        <img src="{{ asset('storage/' . $media->file_url) }}" class="w-full h-48 object-cover" alt="{{ $media->title }}">
                    @else
                        <video controls class="w-full h-48 object-cover rounded-t-lg">
                            <source src="{{ asset('storage/' . $media->file_url) }}" type="video/mp4">
                        </video>
                    @endif

                    <div class="p-4">
                        <h5 class="text-lg font-semibold mb-2">{{ $media->title }}</h5>
                        <a href="{{ route('media.show', $media->id) }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">View</a>
                    </div>
                </div>
            @empty
                <p class="text-gray-600">You haven’t added any favorites yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>