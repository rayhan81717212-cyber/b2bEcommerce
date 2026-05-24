<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>

<body style="margin:0; padding:0; background:#f4f6f9; font-family:Arial, sans-serif;">

    <div style=" margin:40px auto; background:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 5px 15px rgba(0,0,0,0.1);">

        {{-- header area --}}
        <div style="background:#272727; padding:20px; text-align:start; color:white;">
            <h2 style="margin:0;"> {{ $subjectText }}</h2>
        </div>

        {{-- body area --}}
        <div style="padding:30px; color:#333; font-size:15px; line-height:1.6;">

            <p>{!! nl2br(e($messageData)) !!}</p>

            <hr style="margin:20px 0; border:none; border-top:1px solid #eee;">

            <p style="font-size:14px; color:#777;">
                This email was sent from our system. If you have any questions, feel free to contact support.
            </p>

        </div>

        <div style="background:#f1f1f1; text-align:center; padding:15px; font-size:12px; color:#666;">
            © {{ date('Y') }} Online Shop. All rights reserved.
        </div>

    </div>

</body>
</html>