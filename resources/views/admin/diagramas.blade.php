<x-layouts.layout>
    <h1 class="text-3xl font-bold text-gray-800 mb-8">📊 Estadísticas de Ventas</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full">

        {{-- Ventas por mes --}}
        <div class="bg-white p-6 rounded-2xl shadow-lg">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Ventas por mes</h2>
            <canvas id="ventasMes"></canvas>
        </div>

        {{-- Pedidos por estado --}}
        <div class="bg-white p-6 rounded-2xl shadow-lg">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Pedidos por estado</h2>
            <canvas id="pedidosEstado"></canvas>
        </div>

    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Datos pasados desde el controlador
        const labels = @json($labels);   // ['Enero','Febrero',...]
        const data = @json($data);       // [0,0,200,...]
        const pedidosPorEstado = @json($pedidosPorEstado);

        // Gráfico de barras (Ventas por mes)
        new Chart(document.getElementById('ventasMes'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Ventas (€)',
                    data: data,
                    backgroundColor: 'rgba(37, 99, 235, 0.6)',
                    borderColor: 'rgba(37, 99, 235, 1)',
                    borderWidth: 1,
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Gráfico circular (Pedidos por estado)
        new Chart(document.getElementById('pedidosEstado'), {
            type: 'doughnut',
            data: {
                labels: Object.keys(pedidosPorEstado),
                datasets: [{
                    data: Object.values(pedidosPorEstado),
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.7)',   // verde (pagado)
                        'rgba(59, 130, 246, 0.7)', // azul (entregado)
                        'rgba(239, 68, 68, 0.7)'   // rojo (cancelado)
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    </script>
</x-layouts.layout>
