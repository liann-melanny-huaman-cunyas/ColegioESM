<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/css/custom.css')
    <title>Elecciones Estudiantiles</title>
    <link rel="shortcut icon" href="https://th.bing.com/th/id/OIP.3QIB-x7FollcN1lT2gxTIAHaI7?rs=1&pid=ImgDetMain">   

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<div class="mb-24">
    @include('page.navbar')
</div>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="text-center bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">Elecciones Estudiantiles</h1>
        <p class="text-gray-600">{{ $message }}</p>
    </div>
</body>
</html>