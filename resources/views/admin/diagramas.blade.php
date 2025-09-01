<x-layouts.admin :titulo="'Estadísticas'">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">📊 Estadísticas de Ventas</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full">

            {{-- Ventas por mes --}}
            <div class="bg-white p-4 rounded-xl shadow-md">
                <h2 class="text-lg font-semibold mb-3 text-gray-700">Ventas por mes</h2>
                <div class="chart-container" style="position: relative; height: 280px;">
                    <canvas id="ventasMes"></canvas>
                </div>
            </div>

            {{-- Pedidos por estado --}}
            <div class="bg-white p-4 rounded-xl shadow-md">
                <h2 class="text-lg font-semibold mb-3 text-gray-700">Pedidos por estado</h2>
                <div class="chart-container" style="position: relative; height: 280px;">
                    <canvas id="pedidosEstado"></canvas>
                </div>
            </div>

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

        // Configuración responsive para los gráficos
        Chart.defaults.responsive = true;
        Chart.defaults.maintainAspectRatio = false;

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
                    borderRadius: 6,
                    barPercentage: 0.6,
                    categoryPercentage: 0.7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: {
                                size: 11
                            }
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 11
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });

        // Gráfico circular (Pedidos por estado con %)
        const ctxEstado = document.getElementById('pedidosEstado');
        const valores = Object.values(pedidosPorEstado);
        const total = valores.reduce((a, b) => a + b, 0);

        new Chart(ctxEstado, {
            type: 'doughnut',
            data: {
                labels: Object.keys(pedidosPorEstado),
                datasets: [{
                    data: valores,
                    backgroundColor: Object.keys(pedidosPorEstado).map(e => coloresEstados[e]),
                    borderWidth: 1,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '60%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 11
                            },
                            padding: 15
                        }
                    },
                    datalabels: {
                        color: '#fff',
                        font: {
                            weight: 'bold',
                            size: 10
                        },
                        formatter: (value) => {
                            let porcentaje = ((value / total) * 100).toFixed(1);
                            return porcentaje + '%';
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });

        // Ajustar gráficos al redimensionar la ventana
        window.addEventListener('resize', function() {
            document.querySelectorAll('canvas').forEach(canvas => {
                const chart = Chart.getChart(canvas);
                if (chart) {
                    chart.resize();
                }
            });
        });
    </script>
</x-layouts.admin>
