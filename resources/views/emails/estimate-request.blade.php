<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>New Estimate Request</title>
</head>
<body style="font-family: 'Biondi Sans', 'Helvetica Neue', Arial, sans-serif; line-height: 1.6; color: #2a2622;">
    <h1 style="font-size: 20px; margin-bottom: 16px;">New estimate request</h1>

    <p><strong>Name:</strong> {{ $estimate['name'] }}</p>
    <p><strong>Email:</strong> {{ $estimate['email'] }}</p>
    @if (! empty($estimate['phone']))
        <p><strong>Phone:</strong> {{ $estimate['phone'] }}</p>
    @endif
    <p><strong>Project type:</strong> {{ str($estimate['project_type'])->headline() }}</p>

    <p><strong>Project details:</strong></p>
    <p style="white-space: pre-wrap;">{{ $estimate['message'] }}</p>
</body>
</html>
