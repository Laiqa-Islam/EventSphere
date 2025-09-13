<x-website-layout>
    <div class="container">
        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('warning'))
            <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
                {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Event Details --}}
        <h1>{{ $event->title }}</h1>
        <p><strong>Organizer:</strong> {{ $event->organizer->name }}</p>

        @if($event->banner_image)
            <img src="{{ asset('storage/' . $event->banner_image) }}" alt="Banner" class="img-fluid mb-3">
        @endif

        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</p>
        <p><strong>Venue:</strong> {{ $event->venue->name }}</p>
        <p><strong>Description:</strong> {{ $event->description }}</p>

        {{-- Registration Section --}}
        @php
            $registration = $event->registrations->where('student_id', auth()->id())->where('status', 'confirmed')->first();
            $waitlist = $event->waitlist->where('user_id', auth()->id())->where('status', 'waiting')->first();
        @endphp

        @auth
            @if(!$registration && !$waitlist)
                <form action="{{ route('events.user.register', $event->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-primary">Register</button>
                </form>
            @elseif($registration)
                <form action="{{ route('events.user.cancel', $event->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Cancel Registration</button>
                </form>
            @elseif($waitlist)
                <form action="{{ route('events.user.cancel', $event->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-warning">Leave Waitlist</button>
                </form>
            @endif
        @else
            <p class="text-muted">Please <a href="{{ route('login') }}">log in</a> to register.</p>
        @endauth

        <hr>

        {{-- Feedback Section --}}
        @if($isPastEvent)
            <h3>Feedback</h3>

            {{-- Feedback Form --}}
            @auth
                @if($canGiveFeedback)
                    <form action="{{ route('feedback.store', $event->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="rating">Rating:</label>
                            <select name="rating" id="rating" class="form-control" required>
                                <option value="">Select</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="comments">Comments</label>
                            <textarea name="comments" id="comments" class="form-control" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Submit Feedback</button>
                    </form>
                @else
                    <p class="text-muted">You did not attend this event, so you cannot leave feedback.</p>
                @endif
            @else
                <p class="text-muted">Please <a href="{{ route('login') }}">log in</a> to leave feedback.</p>
            @endauth

            <hr>

            {{-- Existing Feedback --}}
            @forelse($feedback as $item)
                <div class="mb-3 border p-2 rounded">
                    <strong>{{ $item->student->name }}</strong>
                    <span>({{ $item->rating }}★)</span>
                    <p>{{ $item->comments }}</p>
                    <small class="text-muted">Submitted on {{ $item->created_at->format('d M Y h:i A') }}</small>
                </div>
            @empty
                <p>No feedback yet.</p>
            @endforelse
        @else
            <p class="text-muted">Feedback will be available after the event ends.</p>
        @endif
    </div>
</x-website-layout>
