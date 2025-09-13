<x-website-layout>
 <div id="page_caption" class="hasbg parallax"
     style="background-image: url('{{ asset('website/upload/26549211695_14ca70baa9_o.jpg') }}');">


        <div class="page_title_wrapper">
            <div style="background: none" class="standard_wrapper">
                <div class="page_title_inner">
                    <div class="page_title_content">
                        <h1>Event Schedule</h1>
                        <div class="page_tagline">
                            View the complete event timeline in a single glance. </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="container">

        {{-- UPCOMING --}}
        <h2>Upcoming Events</h2>
        <div class="row mb-4">
            @forelse($upcomingEvents as $event)
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        @if($event->banner)
                            <img src="{{ asset('storage/' . $event->banner) }}" class="card-img-top" alt="Banner">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <p class="card-text">{{ Str::limit($event->description, 100) }}</p>
                            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</p>

                            <p><strong>Venue:</strong> {{ $event->venue->name }}</p>
                            <a href="{{ route('events.user.show', $event->id) }}" style="background-color:#FF2D55; border-color:#FF2D55" class="btn btn-primary">View</a>

                            @auth
                                @if(auth()->user()->bookmarkedEvents->contains($event->id))
                                    <form action="{{ route('events.unbookmark', $event) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-warning">Remove Bookmark</button>
                                    </form>
                                @else
                                    <form action="{{ route('events.bookmark', $event) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn" style="background-color:black; color:white; border:none;">
    Bookmark
</button>

                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <p>No upcoming events.</p>
            @endforelse
        </div>

        {{-- ONGOING --}}
        <h2>Ongoing Events</h2>
        <div class="row mb-4">
            @forelse($ongoingEvents as $event)
                <div class="col-md-4 mb-3">
                    <div class="card h-100 border-info">
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <p>{{ Str::limit($event->description, 100) }}</p>
                            <span style="background-color:black; " class="badge  text-white">Ongoing</span>
                            <a href="{{ route('events.user.show', $event) }}" style="background-color:#FF2D55; border-color:#FF2D55; color: white;" class="btn  mt-2">View</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>No ongoing events.</p>
            @endforelse
        </div>

        {{-- PAST --}}
        <h2>Past Events</h2>
        <div class="row mb-4">
            @forelse($pastEvents as $event)
                <div class="col-md-4 mb-3">
                    <div class="card h-100 text-muted">
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <p>{{ Str::limit($event->description, 100) }}</p>
                            <span class="badge bg-secondary text-white">Past</span>
                            <a href="{{ route('events.user.show', $event) }}" class="btn btn-outline-dark mt-2">View</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>No past events.</p>
            @endforelse
        </div>

    </div>

</x-website-layout>