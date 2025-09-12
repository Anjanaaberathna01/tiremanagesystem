<!-- filepath: resources/views/emails/tire_arrived.blade.php -->

<table width="100%" cellpadding="0" cellspacing="0" style="background: #f4f8fb; padding: 0; margin: 0;">
  <tr>
    <td align="center">
      <table width="600" cellpadding="0" cellspacing="0" style="background: #fff; border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,0.07); margin: 32px 0;">
        <tr>
          <td style="padding: 40px 40px 24px 40px; text-align: center;">
            <img src="{{ secure_asset('https://morning.lk/wp-content/uploads/2021/12/SLTMOBITEL-Logo-E-1024x724.png') }}" alt="SLT Logo" style="height: 150px; margin-bottom: 2px;">
            <h1 style="color: #2563eb; font-size: 28px; font-weight: 700; margin-bottom: 8px;">Tire Order Arrived</h1>
            <p style="color: #374151; font-size: 18px; margin-bottom: 0;">
              Dear <strong>{{ $order->request->driver_name ?? $order->request->user->full_name }}</strong>,
            </p>
          </td>
        </tr>
        <tr>
          <td style="padding: 0 40px 24px 40px;">
            <div style="background: #f1f5f9; border-radius: 12px; padding: 24px; margin-bottom: 24px;">
              <p style="color: #2563eb; font-size: 16px; font-weight: 600; margin-bottom: 8px;">Your requested tire has arrived at the company!</p>
              <table width="100%" cellpadding="0" cellspacing="0" style="font-size: 15px;">
                <tr>
                  <td style="color: #64748b; padding: 4px 0;">Request Code:</td>
                  <td style="color: #0f172a; font-weight: 600;">{{ $order->request->request_code }}</td>
                </tr>
                <tr>
                  <td style="color: #64748b; padding: 4px 0;">Vehicle No:</td>
                  <td style="color: #0f172a;">{{ $order->request->vehicle->vehicle_number ?? '-' }}</td>
                </tr>
                <tr>
                  <td style="color: #64748b; padding: 4px 0;">Tire Size:</td>
                  <td style="color: #0f172a;">{{ $order->request->tire_size_required }}</td>
                </tr>
                <tr>
                  <td style="color: #64748b; padding: 4px 0;">Brand:</td>
                  <td style="color: #0f172a;">{{ $order->request->tire_brand_required }}</td>
                </tr>
                <tr>
                  <td style="color: #64748b; padding: 4px 0;">No. of Tires:</td>
                  <td style="color: #0f172a;">{{ $order->request->number_of_tires }}</td>
                </tr>
                <tr>
                  <td style="color: #64748b; padding: 4px 0;">Order Date:</td>
                  <td style="color: #0f172a;">{{ $order->ordered_at ? \Carbon\Carbon::parse($order->ordered_at)->format('Y-m-d') : '-' }}</td>
                </tr>
              </table>
            </div>
            <p style="color: #374151; font-size: 16px; margin-bottom: 24px;">
              Please visit the company transport section to collect your tire.<br>
              If you have any questions, reply to this email or contact your transport coordinator.
            </p>
            <div style="text-align: center; margin-bottom: 24px;">
              <a href="{{ url('/') }}" style="background: #2563eb; color: #fff; padding: 12px 32px; border-radius: 8px; font-weight: 600; text-decoration: none; font-size: 16px;">
                View in Tire Management System
              </a>
            </div>
          </td>
        </tr>
        <tr>
          <td style="padding: 0 40px 40px 40px; text-align: center; color: #64748b; font-size: 13px;">
            Thanks,<br>
            <span style="color: #2563eb; font-weight: 600;">SLT Mobile</span>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
