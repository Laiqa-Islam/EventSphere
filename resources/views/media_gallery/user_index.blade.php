

<x-website-layout>
      <div id="page_caption" class=" ">

            <div class="page_title_wrapper">
                <div style="background: none" class="standard_wrapper">
                    <div class="page_title_inner">
                        <h1>Gallery</h1>
                        <div class="page_tagline">
                            This is sample of gallery excerpt and you can set it up using gallery option </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="container py-4">
        <div class="row">
            @foreach($media as $item)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if($item->file_type === 'image')
                            <img src="{{ asset('storage/' . $item->file_url) }}" class="card-img-top"
                                style="height:200px; object-fit:cover;" alt="media">
                        @else
                            <video class="card-img-top" controls style="height:200px; object-fit:cover;">
                                <source src="{{ asset('storage/' . $item->file_url) }}" type="video/mp4">
                            </video>
                        @endif
                        <div class="card-body">
                            <h6 class="card-title">{{ $item->event->title }}</h6>
                            <a href="{{ route('media.show', $item->id) }}" class="btn btn-primary btn-sm">View</a>
                            @auth
                                <form action="{{ route('favorites.toggle', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit"
                                        class="btn {{ auth()->user()->favorites->contains($item->id) ? 'btn-danger' : 'btn-outline-danger' }}">
                                        <i class="fa fa-heart"></i>
                                        {{ auth()->user()->favorites->contains($item->id) ? 'Favorited' : 'Favorite' }}
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-outline-secondary" disabled>
                                    <i class="fa fa-heart"></i> Login to favorite
                                </button>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $media->links() }}
    </div>

</x-website-layout>