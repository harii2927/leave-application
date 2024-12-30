{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <h1>Leave Request Rejected</h1>
    <p>Dear {{ $leaveRequest->name }},</p>
    <p>We regret to inform you that your leave request for {{ $leaveRequest->date }} has been rejected.</p>
    <p>Reason for leave: {{ $leaveRequest->reason }}</p>
    <p>Please contact Manager if you have any questions.</p>
    
</body>
</html> --}}

<!DOCTYPE html>
<html>
<head>
    <title>Leave Request Rejected</title>
</head>
<body>
    <p>Dear {{ $name }},</p>

    <p>We regret to inform you that your leave request has been rejected. Below are the details of your request:</p>
    <ul>
        <li><strong>Employee ID:</strong> {{ $emp_id }}</li>
        <li><strong>Date:</strong> {{ $date }}</li>
        <li><strong>Reason:</strong> {{ $reason }}</li>
    </ul>

    <p>Please feel free to reach out to HR for further clarification.</p>

    <p>Thank you,<br>
    Your HR Team</p>
</body>
</html>
