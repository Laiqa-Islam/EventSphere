<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Certificate</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; text-align: center; }
        .certificate { border: 5px solid #333; padding: 50px; }
        h1 { font-size: 40px; margin-bottom: 20px; }
        h2 { font-size: 30px; margin: 10px 0; }
        p { font-size: 18px; }
    </style>
</head>
<body>
    <div class="certificate">
        <h1>Certificate of Participation</h1>
        <p>This is to certify that</p>
        <h2>{{ $user->name }}</h2>
        <p>has successfully attended the event</p>
        <h2>"{{ $event->title }}"</h2>
        <p>held on {{ $event->date->format('d M Y') }}</p>
    </div>
</body>
</html>
