<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Cheques</title>
    <!-- Usamos Tailwind CSS vía CDN para estilizar -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 min-h-screen flex items-center justify-center">
    <div class="bg-white p-10 rounded-xl shadow-2xl">
        <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Gestión de Cheques</h1>
        <div class="grid grid-cols-1 gap-4">
            <button class="w-full py-3 px-6 bg-blue-500 hover:bg-blue-600 text-white font-bold rounded-lg shadow transition transform hover:scale-105">
                Abrir Caja
            </button>
            <button class="w-full py-3 px-6 bg-green-500 hover:bg-green-600 text-white font-bold rounded-lg shadow transition transform hover:scale-105">
                Cambiar Cheques
            </button>
            <button class="w-full py-3 px-6 bg-purple-500 hover:bg-purple-600 text-white font-bold rounded-lg shadow transition transform hover:scale-105">
                Agregar Dinero
            </button>
        </div>
    </div>
</body>
</html>
