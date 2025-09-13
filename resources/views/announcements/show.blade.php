<x-dashboard-layout>
<div class="container">
    <h1>{{ $announcement->title }}</h1>

    <p><strong>Message:</strong></p>
    <p>{{ $announcement->message }}</p>

    <p>
        <strong>Sent At:</strong> {{ $announcement->sent_at ?? 'Not yet sent' }}
    </p>

    <p>
        <strong>Sender:</strong>
        @if($announcement->organizer)
            Organizer: {{ $announcement->organizer->name }}
        @elseif($announcement->admin)
            Admin: {{ $announcement->admin->name }}
        @endif
    </p>

    <p>
        <strong>Target:</strong>
        @if($announcement->event)
            Event: {{ $announcement->event->title }}
        @elseif($announcement->target_role)
            Role: {{ ucfirst($announcement->target_role) }}
        @elseif($announcement->target_users)
            Selected Users
        @else
            All Users
        @endif
    </p>

    <a href="{{ route('announcements.index') }}" class="btn btn-secondary">Back</a>
</div>
</x-dashboard-layout>
