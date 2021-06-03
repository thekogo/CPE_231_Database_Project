<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <!-- Scripts -->
    @routes
    <script src="{{ mix('js/app.js') }}" defer></script>
    <style>
        @font-face {
            font-family: Lamoon;
            src: url('/fonts/FC Lamoon/FC Lamoon Regular ver 1.00.ttf');
            font-weight: normal;
        }

        @font-face {
            font-family: Lamoon;
            src: url('/fonts/FC Lamoon/FC Lamoon Bold ver 1.00.ttf');
            font-weight: bold;
        }

        @font-face {
            font-family: Lamoon;
            src: url('/fonts/FC Lamoon/FC Lamoon Light ver 1.00.ttf');
            font-weight: 300;
        }

        html,
        body {
            height: 100%;
            padding: 0px;
            margin: 0px;
        }

        * {
            font-family: Lamoon;
            font-size: 20px;
        }

        #id {
            height: 100%;
        }

        *::-webkit-scrollbar {
            width: 10px;
            background-color: #F5F5F5;
        }

        *::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #F5F5F5;
        }

        *::-webkit-scrollbar-thumb {
            background-color: #F90;
            background-image: -webkit-linear-gradient(90deg, rgba(255, 255, 255, .2) 25%,
                    transparent 25%,
                    transparent 50%,
                    rgba(255, 255, 255, .2) 50%,
                    rgba(255, 255, 255, .2) 75%,
                    transparent 75%,
                    transparent)
        }
    </style>
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>
