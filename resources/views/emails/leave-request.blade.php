{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Request</title>
</head>
<body>

    <h1>Leave Request</h1>
    <p>Dear Sir/Madam,</p>
    <p>Employee Name: {{ $leaveRequest->name }}</p>
    <p>Employee ID: {{ $leaveRequest->emp_id }}</p>
    <p>Reason: {{ $leaveRequest->reason }}</p>
    <p>Date: {{ $leaveRequest->date }}</p>
       
</body>
</html> --}}

<!DOCTYPE html>
<html>
<head>
    <title>New Leave Request</title>
</head>
<body>
    <p>Hello HR/Manager,</p>

    <p>A new leave request has been submitted by {{ $name }} (Employee ID: {{ $emp_id }}).</p>
    <p><strong>Date:</strong> {{ $date }}</p>
    <p><strong>Reason:</strong> {{ $reason }}</p>

    <p>
        <a href="{{ $approveUrl }}" style="color: green; text-decoration: none;">Approve Leave</a> | 
        <a href="{{ $rejectUrl }}" style="color: red; text-decoration: none;">Reject Leave</a>
    </p>

    <p>Thank you,</p>
    <p>Your Leave Management System</p>
</body>
</html>
