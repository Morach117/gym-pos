<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym POS - Access & Sales</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        neon: '#06b6d4', // Cian vibrante
                        dark: '#0f172a', // Fondo principal oscuro
                        panel: '#1e293b' // Paneles secundarios
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'], // Tipografía fuerte y limpia
                    }
                }
            }
        }
    </script>
    <style>
        /* Efecto de brillo neón para botones principales */
        .shadow-neon { box-shadow: 0 0 10px rgba(6, 182, 212, 0.5); }
    </style>
</head>
<body class="bg-dark text-white h-screen overflow-hidden flex font-sans">

    <aside class="w-1/4 bg-panel border-r border-gray-700 p-6 flex flex-col justify-between">
        <div>
            <h1 class="text-3xl font-black text-neon tracking-wider mb-2">GYM<span class="text-white">CORE</span></h1>
            <p class="text-gray-400 text-sm mb-8">Control de Acceso y POS</p>
            
            <div class="bg-dark p-4 rounded-lg border border-gray-600 mb-6 text-center">
                <p class="text-gray-400 text-xs uppercase font-bold mb-2">Lector DigitalPersona</p>
                <div id="scanner-status" class="text-yellow-400 text-sm font-semibold flex items-center justify-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></span>
                    Esperando conexión...
                </div>
            </div>
        </div>
        
        <div id="last-access-card" class="hidden bg-dark p-4 rounded-lg border border-neon shadow-neon transition-all">
            <h3 class="text-xs uppercase text-neon font-bold">Último Acceso</h3>
            <p id="access-name" class="text-lg font-bold mt-1">---</p>
            <p id="access-status" class="text-sm font-bold mt-1"></p>
        </div>
    </aside>

    <main class="w-3/4 flex flex-col">
        <header class="h-16 border-b border-gray-700 flex items-center px-8 justify-between">
            <h2 class="text-xl font-bold">Punto de Venta</h2>
            <div class="text-sm text-gray-400" id="clock">00:00:00</div>
        </header>

        <div class="flex-1 p-8 grid grid-cols-3 gap-6">
            <div class="col-span-2 bg-panel rounded-xl p-6 border border-gray-700 overflow-y-auto">
                <h3 class="text-lg font-bold mb-4 text-neon">Catálogo Rápido</h3>
                <div id="product-list" class="grid grid-cols-3 gap-4">
                    <p class="text-gray-500 text-sm">Cargando productos...</p>
                </div>
            </div>

            <div class="bg-panel rounded-xl p-6 border border-gray-700 flex flex-col">
                <h3 class="text-lg font-bold mb-4">Ticket de Venta</h3>
                <ul id="cart-items" class="flex-1 overflow-y-auto mb-4 border-b border-gray-600 pb-4">
                    </ul>
                <div class="mt-auto">
                    <div class="flex justify-between text-xl font-bold mb-4">
                        <span>Total:</span>
                        <span class="text-neon" id="cart-total">$0.00</span>
                    </div>
                    <button onclick="processPayment()" class="w-full bg-neon text-dark font-black py-4 rounded-lg shadow-neon hover:bg-cyan-300 transition-colors uppercase tracking-widest">
                        Cobrar
                    </button>
                </div>
            </div>
        </div>
    </main>

    <div id="toast-container" class="fixed bottom-4 right-4 flex flex-col gap-2 z-50"></div>

    <script>
        // Aquí irá toda la lógica de JS que haremos en el siguiente paso
        console.log("UI Cargada. Lista para la lógica JS.");
        
        // Reloj simple para el Dashboard
        setInterval(() => {
            document.getElementById('clock').innerText = new Date().toLocaleTimeString();
        }, 1000);
    </script>
</body>
</html>