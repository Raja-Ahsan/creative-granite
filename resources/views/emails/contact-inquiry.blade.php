<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>New Contact Inquiry</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #2a2622;">
    <h1 style="font-size: 20px; margin-bottom: 16px;">New contact inquiry</h1>

    <p><strong>Name:</strong> {{ $inquiry['name'] }}</p>
    <p><strong>Email:</strong> {{ $inquiry['email'] }}</p>
    @if (! empty($inquiry['phone']))
        <p><strong>Phone:</strong> {{ $inquiry['phone'] }}</p>
    @endif
    <p><strong>Project type:</strong> {{ str($inquiry['project_type'])->headline() }}</p>

    <p><strong>Message:</strong></p>
    <p style="white-space: pre-wrap;">{{ $inquiry['message'] }}</p>
</body>
</html>
