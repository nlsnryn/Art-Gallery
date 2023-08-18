<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Art Gallery</title>
    @vite(['resources/css/app.css','resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"/>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    

    <x-header/>
    <div id="authentication" data-is-authenticated="{{ auth()->check() ? 'true' : 'false' }}"></div>
    <div class="bg-white min-h-screen">
        {{ $slot }}
    </div>
    <x-footer/>

    <script>
        //Navigation
        document.getElementById('nav-hamburger').addEventListener('click', function () {
            document.getElementById('nav-menu').classList.toggle('hidden');
            document.getElementById('nav-ekis').classList.toggle('hidden');
            document.getElementById('nav-hamburger').classList.toggle('hidden');
        });

        document.getElementById('nav-ekis').addEventListener('click', function () {
            document.getElementById('nav-menu').classList.toggle('hidden');
            document.getElementById('nav-ekis').classList.toggle('hidden');
            document.getElementById('nav-hamburger').classList.toggle('hidden');
        });
    </script>
</body>
</html>