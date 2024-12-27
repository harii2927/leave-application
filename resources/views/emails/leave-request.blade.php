<!DOCTYPE html>
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
</html>