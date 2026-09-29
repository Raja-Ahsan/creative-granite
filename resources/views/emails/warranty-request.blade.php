<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>New Warranty Request</title>
</head>
<body style="font-family: 'Biondi Sans', 'Helvetica Neue', Arial, sans-serif; line-height: 1.6; color: #2a2622;">
    <h1 style="font-size: 20px; margin-bottom: 16px;">New warranty request</h1>

    <p><strong>Name:</strong> {{ $warranty['name'] }}</p>
    <p><strong>Email:</strong> {{ $warranty['email'] }}</p>
    @if (! empty($warranty['phone']))
        <p><strong>Phone:</strong> {{ $warranty['phone'] }}</p>
    @endif
    @if (! empty($warranty['address']))
        <p><strong>Address / location:</strong> {{ $warranty['address'] }}</p>
    @endif

    <p><strong>Issue details:</strong></p>
    <p style="white-space: pre-wrap;">{{ $warranty['message'] }}</p>
</body>
</html>
