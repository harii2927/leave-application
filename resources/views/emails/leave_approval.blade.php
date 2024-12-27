<!DOCTYPE html>
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
</html>