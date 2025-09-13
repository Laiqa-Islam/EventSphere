<x-dashboard-layout>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary">🎞️ Media Gallery</h2>
            <a href="{{ route('media-gallery.create') }}" class="btn btn-success rounded-pill shadow-sm px-4">
                <i class="bi bi-upload"></i> Upload Media
            </a>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                ✅ {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Gallery Grid --}}
        <div class="row g-4">
            @forelse($media as $item)
                <div class="col-md-4 col-lg-3">
                    <div class="card border-0 shadow-lg h-100 gallery-card">
                        @if($item->file_type === 'image')
                            <img src="{{ asset('storage/'.$item->file_url) }}" class="card-img-top rounded-top" alt="Media">
                        @else
                            <video class="card-img-top rounded-top" controls>
                                <source src="{{ asset('storage/'.$item->file_url) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif

                        <div class="card-body">
                            <p class="card-text fw-semibold">{{ $item->caption ?? 'No caption' }}</p>
                            <small class="text-muted d-block">
                                👤 {{ $item->uploader->name }}
                            </small>
                            <small class="text-muted d-block">
                                📅 {{ $item->event->title }}
                            </small>
                        </div>

                        <div class="card-footer bg-white d-flex flex-wrap gap-2">
                            <a href="{{ route('media-gallery.show', $item->id) }}" class="btn btn-sm btn-outline-info flex-grow-1">
                                <i class="bi bi-eye"></i> View
                            </a> 
                            <a href="{{ route('media-gallery.edit', $item->id) }}" class="btn btn-sm btn-outline-warning flex-grow-1">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('media-gallery.destroy', $item->id) }}" method="POST" class="d-inline flex-grow-1">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger w-100" onclick="return confirm('Delete this media?')">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center mt-5">
                    <i class="bi bi-image text-muted" style="font-size: 4rem;"></i>
                    <p class="mt-2 text-muted">No media uploaded yet.</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $media->links() }}
        </div>
    </div>

    {{-- Extra Styling --}}
    <style>
        .gallery-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .gallery-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 20px rgba(0,0,0,0.15);
        }
        .card-img-top {
            max-height: 200px;
            object-fit: cover;
        }
        .card-footer .btn {
            min-width: 70px;
        }
    </style>
</x-dashboard-layout>
