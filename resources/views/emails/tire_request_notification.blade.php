<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Tire Request Notification</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f6f8; margin: 0; padding: 0; }
        .container { max-width: 520px; margin: 40px auto; background: #fff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); padding: 32px 32px 24px 32px; }
        .logo { text-align: center; margin-bottom: 24px; }
        .logo img { height: 60px; }
        .title { color: #1a237e; font-size: 1.5rem; font-weight: 700; margin-bottom: 12px; text-align: center; }
        .greeting { font-size: 1.1rem; margin-bottom: 12px; }
        .info-table { width: 100%; border-collapse: collapse; margin: 18px 0 24px 0; }
        .info-table th, .info-table td { text-align: left; padding: 7px 8px; }
        .info-table th { background: #e3eafc; color: #1a237e; font-weight: 600; }
        .info-table tr:nth-child(even) td { background: #f7f9fc; }
        .cta-btn {
            display: inline-block;
            background: #1976d2;
            color: #fff !important;
            text-decoration: none;
            padding: 12px 32px;
            border-radius: 6px;
            font-weight: 600;
            margin: 18px 0;
            transition: background 0.2s;
        }
        .cta-btn:hover { background: #0d47a1; }
        .footer { color: #888; font-size: 0.95rem; text-align: center; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="container">
        
        <div class="logo">
            <img src="{{ secure_asset('https://morning.lk/wp-content/uploads/2021/12/SLTMOBITEL-Logo-E-1024x724.png') }}" alt="SLT Logo" style="height: 150px; margin-bottom: 2px;">
        </div>
        <div class="title">New Tire Request Notification</div>
        <div class="greeting">Dear {{ $recipient->full_name }},</div>
        <p>
            You have been selected as the supervisor/manager for a new tire request in your department.
            Please log in to the Vehicle Tire Management System to review and process the request.
        </p>

        <table class="info-table">
            <tr>
                <th>Requested By</th>
                <td>{{ $sender->full_name }} ({{ $sender->role }})</td>
            </tr>
            <tr>
                <th>Department</th>
                <td>{{ $sender->department ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Request Date</th>
                <td>{{ now()->format('Y-m-d H:i') }}</td>
            </tr>
        </table>

        <a href="{{ url('/tirerequest/approval') }}" class="cta-btn">View Tire Requests</a>

        <p style="margin-top: 24px;">
            <strong>Note:</strong> This is an automated notification from the Vehicle Tire Management System.<br>
            If you have any questions, please contact the transport department.
        </p>

        <div class="footer">
            &copy; {{ date('Y') }} SLT Mobile. All rights reserved.
        </div>
    </div>
</body>
</html>