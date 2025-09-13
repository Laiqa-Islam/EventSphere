<x-dashboard-layout>
    <div class="container mt-5">
        <h2 class="fw-bold text-primary mb-4">📌 Media Details</h2>

        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
            <div class="card-body">
                @if($mediaGallery->file_type === 'image')
                    <img src="{{ asset('storage/' . $mediaGallery->file_url) }}" 
                         class="img-fluid rounded mb-4 d-block mx-auto shadow-sm" 
                         style="max-height: 400px; object-fit: cover;">
                @else
                    <video class="w-100 rounded mb-4 shadow-sm" controls>
                        <source src="{{ asset('storage/' . $mediaGallery->file_url) }}">
                        Your browser does not support the video tag.
                    </video>
                @endif

                <h5 class="fw-semibold text-dark">{{ $mediaGallery->caption ?? 'No caption provided' }}</h5>
                
                <ul class="list-group list-group-flush mt-3">
                    <li class="list-group-item">
                        <strong>🎉 Event:</strong> {{ $mediaGallery->event->title }}
                    </li>
                    <li class="list-group-item">
                        <strong>👤 Uploaded by:</strong> {{ $mediaGallery->uploader->name }}
                    </li>
                    <li class="list-group-item">
                        <strong>⏰ Uploaded on:</strong> {{ $mediaGallery->created_at->format('d M Y, h:i A') }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-dashboard-layout>
