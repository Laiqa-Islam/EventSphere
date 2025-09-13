<?php

namespace App\Http\Controllers;
use App\Models\Attendance;
use App\Models\Certificate;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{

    public function myCertificates()
    {
        $userId = Auth::id();

        // Fetch events the user attended
        $attendedEvents = Attendance::with('event')
            ->where('student_id', $userId)
            ->where('attended', true)
            ->get();

        return view('student.certificate', compact('attendedEvents'));
    }

    public function requestCertificate($eventId)
    {
        $userId = Auth::id();

        // Check if request already exists
        $existing = Certificate::where('event_id', $eventId)
            ->where('student_id', $userId)
            ->first();

        if ($existing) {
            return redirect()->back()->with('info', 'You already requested a certificate for this event.');
        }

        // Save request as pending
        Certificate::create([
            'event_id' => $eventId,
            'student_id' => $userId,
            'certificate_url' => null,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Your certificate request has been submitted. Please wait for approval.');
    }

    public function pendingCertificates()
    {
        $certificates = Certificate::with('event', 'student')
            ->where('status', 'pending')
            ->get();

        return view('admin.certificates.pending', compact('certificates'));
    }

    public function approveCertificate($id)
    {
        $certificate = Certificate::with('event', 'student')->findOrFail($id);

        // Generate PDF
        $pdf = Pdf::loadView('admin.certificates.template', [
            'event' => $certificate->event,
            'user' => $certificate->student
        ]);

        $fileName = 'certificates/certificate_' . $certificate->id . '.pdf';
        Storage::disk('public')->put($fileName, $pdf->output());

        // Update record
        $certificate->update([
            'certificate_url' => '/storage/' . $fileName,
            'status' => 'approved'
        ]);

        return redirect()->back()->with('success', 'Certificate approved and generated.');
    }
public function approvedCertificates()
{
    $certificates = Certificate::with(['event', 'student'])
        ->where('status', 'approved')
        ->get();

    return view('admin.certificates.approved', compact('certificates'));
}

}