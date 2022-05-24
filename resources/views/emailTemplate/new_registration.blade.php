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
            background-color: rgba(13, 110, 253) !important;
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
            <h1 class="text-white">Welcome to The Ethical Man</h1>
        </div>
        <div class="p-4 bg-white">
            <p>Hii {{ $name }},</p>
            <p>Thank you for signing up</p>
            <p>Please click on the button below to verify your email address</p>
            <a href="{{ url('/verify_email/' . $rand_id . '') }}"
                style="text-decoration: none!important;border: 1px solid transparent;padding: 0.375rem 0.75rem;
                font-size: 1rem;
                border-radius: 0.25rem;cursor: pointer;color: #fff;background-color: #0d6efd;border-color: #0d6efd;">Verify
                Email</a>
        </div>
    </div>

</body>

</html>
