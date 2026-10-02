<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Quiz Reminder</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        /* General styling for email */
        body, table, td, a {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }
        table, td {
            mso-table-rspace: 0pt;
            mso-table-lspace: 0pt;
        }
        img {
            -ms-interpolation-mode: bicubic;
        }
        a[x-apple-data-detectors] {
            font-family: inherit !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            color: inherit !important;
            text-decoration: none !important;
        }
        body {
            width: 100% !important;
            height: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        table {
            border-collapse: collapse !important;
        }
        a {
            color: #1a82e2;
        }
        img {
            height: auto;
            line-height: 100%;
            text-decoration: none;
            border: 0;
            outline: none;
        }
    </style>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="max-w-lg mx-auto p-6 bg-white shadow-md rounded-lg">
        <!-- start logo -->
        <div class="flex justify-center py-6">
            <a href="#" target="_blank">
                <img src="{{asset('odyssey.png')}}" alt="Logo" class="h-12 w-12">
            </a>
        </div>
        <!-- end logo -->

        <!-- start hero -->
        <div class="bg-white p-6 border-t-4 border-gray-300">
            <h1 class="text-3xl font-bold text-gray-800">Group Invitation</h1>
        </div>
        <!-- end hero -->

        <!-- start copy block -->
        <div class="bg-white p-6">
            <!-- start copy -->
            <p class="text-gray-800 mb-4">Hello <span class="font-bold">{{ $stud->name }}</span>,</p>
            <p class="text-gray-800 mb-4">You have been invited by <span class="font-bold italic">{{ $sName }}.</span> to join the group: Please click the link below to accept the invitation:</p>
            <a href="{{ $link }}" target="_blank" class="block ms-3 text-white bg-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Accept Invitation</a>
            <!-- end copy -->
        </div>

        <!-- start copy -->
        <div class="bg-white p-6 border-b-4 border-gray-300">
            <p class="text-gray-800 mb-0">Thank you!</p>
        </div>
        <!-- end copy block -->
    </div>
</body>
</html>
