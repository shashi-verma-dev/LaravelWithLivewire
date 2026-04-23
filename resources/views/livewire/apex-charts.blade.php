<div class="chart-container">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <style id="g2lj0p">
        .chart-container {
            max-width: 90%;
            margin: 40px auto;
            font-family: Arial, sans-serif;
        }

        /* FILTER CARD */
        .filter-card {
            display: flex;
            gap: 15px;
            align-items: flex-end;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-group label {
            font-size: 12px;
            margin-bottom: 5px;
            color: #555;
        }

        .filter-group input {
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            outline: none;
            transition: 0.2s;
        }

        .filter-group input:focus {
            border-color: #007bff;
        }

        /* BUTTON */
        .btn-filter {
            padding: 9px 18px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-filter:hover {
            background: #0056b3;
        }

        /* CHART BOX */
        #chart {
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
    </style>

    <form wire:submit.prevent="chartFilter" class="filter-card">

        <div class="filter-group">
            <label>Start Date</label>
            <input type="date" wire:model="startDate">
        </div>

        <div class="filter-group">
            <label>End Date</label>
            <input type="date" wire:model="endDate">
        </div>

        <button type="submit" class="btn-filter">Apply</button>
    </form>

    <div wire:ignore id="chart"></div>

    <script>
        let chart;

        document.addEventListener('livewire:init', function() {

            let options = {
                chart: {
                    type: 'area',
                    height: 350,
                    foreColor: 'red',
                    dropShadow: {
                        enabled: true,
                        blur: 5,
                        color: '#000',
                        opacity: 0.2
                    },
                    toolbar: {
                        show: true,
                        tools: {
                            download: true,
                            zoomin: true,
                            zoomout: true,
                            reset: true
                        }
                    }
                },
                series: @json($series),
                xaxis: {
                    categories: @json($labels)
                }
            };

            chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();

            Livewire.on('updateChart', ({
                series,
                labels
            }) => {
                chart.updateOptions({
                    series: series,
                    xaxis: {
                        categories: labels
                    }
                });
            });
        });
    </script>
</div>
