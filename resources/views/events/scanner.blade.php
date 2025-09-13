<x-dashboard-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-primary text-white text-center rounded-top-4">
                        <h4 class="mb-0">📷 QR Code Scanner - Attendance</h4>
                    </div>
                    <div class="card-body text-center">
                        <!-- Scanner Box -->
                        <div id="reader" class="mx-auto border rounded-3 shadow-sm" style="width:100%; max-width:350px;"></div>

                        <!-- Scan Result -->
                        <p id="scan-result" class="mt-4 fw-semibold text-success"></p>
                    </div>
                    <div class="card-footer text-muted text-center small">
                        Point your camera at the QR code to mark attendance
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Load QR scanning libraries -->
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode-scanner.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode/html5-qrcode.min.js"></script>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            const resultElement = document.getElementById("scan-result");
            resultElement.innerText = "✅ Scanned: " + decodedText;
            resultElement.classList.remove("text-danger");
            resultElement.classList.add("text-success");

            fetch("{{ route('attendance.checkin') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ code: decodedText })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert("✅ " + data.message);
                    } else {
                        resultElement.innerText = "❌ " + data.message;
                        resultElement.classList.remove("text-success");
                        resultElement.classList.add("text-danger");
                    }
                })
                .catch(err => console.error("Fetch error:", err));
        }

        function onScanError(errorMessage) {
            // Optional: handle errors silently
        }

        document.addEventListener("DOMContentLoaded", function () {
            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader",
                { fps: 10, qrbox: { width: 250, height: 250 } }
            );
            html5QrcodeScanner.render(onScanSuccess, onScanError);
        });
    </script>
</x-dashboard-layout>
