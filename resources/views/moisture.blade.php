@extends('layouts.app')

@section('content')
    <div class="bg-light text-dark p-3 mb-4 mt-4 border rounded shadow-sm">
        <h1 class="mt-4 display-4 text-primary font-weight-bold">
            <i class="material-icons header-icon"></i>
            <b><i>Green House Integrated IoT Monitoring System</i></b>
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active" aria-current="page">Soil Moisture Sensor</li>
            </ol>
        </nav>
    </div>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .display-4 {
            font-size: 2.5rem;
            font-family: 'Varela Round', sans-serif;
        }

        .breadcrumb {
            background-color: transparent;
        }

        .breadcrumb-item.active {
            font-weight: bold;
            color: #555;
        }

        .bg-light {
            background-color: #f8f9fa !important;
            border-radius: 0.75rem;
        }

        .text-primary {
            color: #007bff !important;
        }

        .header-icon {
            font-size: 2.5rem;
            vertical-align: middle;
            margin-right: 10px;
        }

        .rounded {
            border-radius: 0.75rem !important;
        }
    </style>

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body text-black">
                    <i class="fas fa-thermometer-half me-2"></i><b>Soil Moisture Sensor</b>
                </div>
                <div class="card-footer text-black d-flex flex-column align-items-start">
                    <p>Device ID: <span id="device-id-value">Loading...</span></p>
                    <p>Current: <span id="moisture-value">Loading...</span>°C</p>
                    <p>Min: <span id="min-moisture-value">Loading...</span>°C</p>
                    <p>Max: <span id="max-moisture-value">Loading...</span>°C</p>
                    <p>Time: <span id="time-value">Loading...</span></p>
                </div>
            </div>
        </div>

        {{-- Actuator --}}
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-black">
                        <i class="fas fa-lightbulb me-1"></i>
                        Actuator Control
                    </div>
                    <div class="card-body">
                        <div class="form-check form-switch my-3" style="padding-left: 40px;">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault1">
                            <label class="form-check-label" for="flexSwitchCheckDefault1" id="switchLabel1">Water
                                Pump</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const deviceId = 5; // Device ID yang ingin ditampilkan
                const endpoint = `/api/data/device/${deviceId}`; // Endpoint API Anda

                fetch(endpoint)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.message) {
                            throw new Error(data.message);
                        }
                        document.getElementById('device-id-value').textContent = data.device_id;
                        document.getElementById('moisture-value').textContent = data.value;
                        document.getElementById('min-moisture-value').textContent = data.min_value;
                        document.getElementById('max-moisture-value').textContent = data.max_value;
                        document.getElementById('time-value').textContent = new Date(data.created_at)
                            .toLocaleString();
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                        document.getElementById('device-id-value').textContent = 'Error';
                        document.getElementById('moisture-value').textContent = 'Error';
                        document.getElementById('min-moisture-value').textContent = 'Error';
                        document.getElementById('max-moisture-value').textContent = 'Error';
                        document.getElementById('time-value').textContent = 'Error';
                    });
            });
        </script>


        <style>
            .card-footer {
                border-top: 1px solid #e9ecef;
                padding: 10px;
            }

            .card-footer p {
                margin: 0;
                /* Remove default paragraph margin */
                font-size: 0.875rem;
                /* Smaller font size */
            }

            .card-footer span {
                font-weight: bold;
                /* Make the temperature value bold */
            }
        </style>
    </div>

    <style>
        .card {
            border-radius: 0.75rem;
        }

        .card-header {
            border-radius: 0.75rem 0.75rem 0 0;
            font-weight: bold;
        }

        .form-check {
            margin-bottom: 1rem;
        }

        .form-check-input {
            margin-right: 1rem;
        }
    </style>


    {{-- Soil Moisture --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header bg-success">
                    <i class="fas fa-chart-bar me-1"></i>
                    <b>Soil Moisture Sensor Data Graphics</b>
                </div>
                <div class="card-body" id="moisture-sensor"></div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script>
            let moistureData = [];

            const moistureChart = Highcharts.chart('moisture-sensor', {
                chart: {
                    type: 'areaspline'
                },
                title: {
                    text: 'Soil Moisture'
                },
                xAxis: {
                    type: 'datetime', // Adjusted for time-based data
                    tickInterval: 1000 * 60, // 1 minute interval
                    accessibility: {
                        description: 'Time-based moisture values'
                    },
                    title: {
                        text: 'Time'
                    },
                    dateTimeLabelFormats: {
                        second: '%H:%M:%S',
                        minute: '%H:%M',
                        hour: '%H:%M',
                        day: '%e. %b',
                        week: '%e. %b',
                        month: '%b \'%y',
                        year: '%Y'
                    }
                },
                yAxis: {
                    min: 0,
                    max: 100,
                    tickInterval: 10,
                    title: {
                        text: 'Moisture Value'
                    },
                    labels: {
                        format: '{value}%'
                    },
                    lineWidth: 1
                },
                tooltip: {
                    headerFormat: '<b>{series.name}</b><br />',
                    pointFormat: 'Time = {point.x:%H:%M:%S}, Moisture Value = {point.y}'
                },
                plotOptions: {
                    areaspline: {
                        marker: {
                            radius: 4,
                            lineColor: '#666666',
                            lineWidth: 1
                        },
                        lineWidth: 3,
                        fillColor: {
                            linearGradient: {
                                x1: 0,
                                y1: 1,
                                x2: 0,
                                y2: 0
                            },
                            stops: [
                                [0, '#32CD32'], // Green
                                [1, '#1E90FF'] // Blue
                            ]
                        }
                    }
                },
                series: [{
                    data: moistureData,
                    zones: [{
                        value: 50,
                        color: '#32CD32' // Green
                    }, {
                        color: '#1E90FF' // Blue
                    }],
                    name: 'Soil Moisture Sensor',
                    color: '#32CD32', // Line color (start with green for initial values)
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 1,
                            x2: 0,
                            y2: 0
                        },
                        stops: [
                            [0, '#32CD32'], // Green
                            [1, '#1E90FF'] // Blue
                        ]
                    }
                }]
            });

            console.log("Starting fetch request...");

            fetch("{{ route('datas.index') }}?device_id=5")
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log("Fetch successful");
                    console.log(data);
                    moistureData = [];

                    data.forEach(function(item) {
                        // Parse the timestamp to a JS Date object
                        moistureData.push([new Date(item.created_at).getTime(), item.value]);
                    });

                    // Set initial data on chart
                    moistureChart.series[0].setData(moistureData);

                    // Start interval to fetch updated data
                    intervalMoisture();
                })
                .catch(error => {
                    console.log("Fetch error");
                    console.error('There has been a problem with your fetch operation:', error);
                });

            function intervalMoisture() {
                setInterval(function() {
                    updateMoistureData();
                }, 5000);
            }

            function updateMoistureData() {
                fetch("{{ route('datas.index') }}?device_id=5")
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok ' + response.statusText);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log("Update fetch successful");
                        console.log(data);

                        // Append new data instead of replacing
                        data.forEach(function(item) {
                            const newPoint = [new Date(item.created_at).getTime(), item.value];
                            const lastPoint = moistureChart.series[0].data[moistureChart.series[0].data.length - 1];

                            // Ensure not to add duplicates
                            if (newPoint[0] > lastPoint.x) {
                                moistureChart.series[0].addPoint(newPoint, true, moistureChart.series[0].data
                                    .length >= 100); // Remove old points to avoid clutter
                            }
                        });
                    })
                    .catch(error => {
                        console.log("Update fetch error");
                        console.error('There has been a problem with your fetch operation:', error);
                    });
            }
        </script>
    @endpush
