<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        .bg-light {
            --bs-bg-opacity: 1;
            background-color: #ededed !important;
        }

        .bg-primary {
            --bs-bg-opacity: 1;
            background-color: #96588a !important;
        }

        .p-4 {
            padding: 1.5rem !important;
        }

        .text-white {
            color: #fff !important;
        }

        .bg-white {
            background-color: rgb(255, 255, 255) !important;
        }

    </style>

    <title>The Ethical Man</title>
</head>

<body class="bg-light">
    <div class="container p-4">
        <div class="heading bg-primary p-4">
            <h1 class="text-white">Password reset</h1>
        </div>
        <div class="p-4 bg-white">
            <p>Hii {{ $name }},</p>
            <p>{{ $otp }} is the otp for reset your password.</p>
            <br>
            <p>Regards</p>
            <p>The Ethical Man</p>
        </div>
    </div>

</body>

</html>
