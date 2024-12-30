{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>leave Approved</title>
</head>
<body>
    <h1>Leave Approved</h1>

    <p>Dear {{ $leaveRequest->name }},</p>
    <p>Your leave request for {{ $leaveRequest->date }} has been approved.</p>

</body>
</html> --}}

<!DOCTYPE html>
<html>
<head>
    <title>Leave Request Approved</title>
</head>
<body>
    <p>Dear {{ $name }},</p>

    <p>Your leave request for the following details has been approved:</p>
    <ul>
        <li><strong>Employee ID:</strong> {{ $emp_id }}</li>
        <li><strong>Date:</strong> {{ $date }}</li>
        <li><strong>Reason:</strong> {{ $reason }}</li>
    </ul>

    <p>We hope this approval helps you plan accordingly.</p>

    <p>Thank you,<br>
    Your HR Team</p>
</body>
</html>
