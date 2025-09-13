<x-dashboard-layout>
    <div class="container mt-5">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">📜 Pending Certificate Requests</h4>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Event</th>
                                <th scope="col">User</th>
                                <th scope="col">Requested On</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($certificates as $certificate)
                                <tr>
                                    <td>{{ $certificate->event->title }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle d-flex justify-content-center align-items-center me-2" style="width:35px; height:35px;">
                                                <i class="bi bi-person text-secondary"></i>
                                            </div>
                                            {{ $certificate->student->name }}
                                        </div>
                                    </td>
                                    <td>{{ $certificate->created_at->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('admin.certificates.approve', $certificate->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm px-3">
                                                <i class="bi bi-check-circle me-1"></i> Approve & Generate
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        <i class="bi bi-info-circle"></i> No pending requests.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
