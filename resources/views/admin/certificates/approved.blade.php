<x-dashboard-layout>
    <div class="container mt-5">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-gray-100 text-gray-900 d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Approved Certificates</h4>
            </div>
            <div class="card-body">
                @if($certificates->isEmpty())
                    <div class="alert alert-warning">No approved certificates found.</div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table">
                                <tr>
                                    <th>#</th>
                                    <th>Student</th>
                                    <th>Email</th>
                                    <th>Event</th>
                                    <th>Certificate</th>
                                    <th>Issued On</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($certificates as $index => $certificate)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $certificate->student->name }}</td>
                                        <td>{{ $certificate->student->email }}</td>
                                        <td>{{ $certificate->event->title ?? 'N/A' }}</td>
                                        <td>
                                            @if($certificate->certificate_url)
                                                <a href="{{ asset($certificate->certificate_url) }}" target="_blank"
                                                    class="btn btn-sm btn-primary">
                                                    View Certificate
                                                </a>
                                            @else
                                                <span class="badge bg-secondary">Not Uploaded</span>
                                            @endif
                                        </td>
                                        <td>{{ $certificate->issued_on ? \Carbon\Carbon::parse($certificate->issued_on)->format('d M Y') : 'N/A' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-dashboard-layout>