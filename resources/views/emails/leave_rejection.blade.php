<!DOCTYPE html>
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
</html>