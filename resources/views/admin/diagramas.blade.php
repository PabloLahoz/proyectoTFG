<x-layouts.admin>
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
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script>
        // Datos pasados desde el controlador
        const labels = @json($labels);
        const data = @json($data);
        const pedidosPorEstado = @json($pedidosPorEstado);
        const coloresEstados = @json($coloresEstados);

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

        // Gráfico circular (Pedidos por estado con %)
        const ctxEstado = document.getElementById('pedidosEstado').getContext('2d');
        const valores = Object.values(pedidosPorEstado);
        const total = valores.reduce((a, b) => a + b, 0);

        new Chart(ctxEstado, {
            type: 'doughnut',
            data: {
                labels: Object.keys(pedidosPorEstado),
                datasets: [{
                    data: valores,
                    backgroundColor: Object.keys(pedidosPorEstado).map(e => coloresEstados[e])
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' },
                    datalabels: {
                        color: '#fff',
                        font: { weight: 'bold' },
                        formatter: (value) => {
                            let porcentaje = ((value / total) * 100).toFixed(1);
                            return porcentaje + '%';
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    </script>
</x-layouts.admin>
