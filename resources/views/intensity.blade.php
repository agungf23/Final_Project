@extends('layouts.app')

@section('content')
    <div class="bg-light text-dark p-3 mb-4 mt-4 border rounded shadow-sm">
        <h1 class="mt-4 display-4 text-primary font-weight-bold">
            <i class="material-icons header-icon"></i>
            <b><i>Green House Integrated IoT Monitoring System</i></b>
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active" aria-current="page">Intensity Sensor</li>
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
            <div class="card bg-danger text-white mb-4">
                <div class="card-body text-black">
                    <i class="fas fa-thermometer-half me-2"></i><b>Intensity Sensor</b>
                </div>
                <div class="card-footer text-black d-flex flex-column align-items-start">
                    <p>Device ID: <span id="device-id-value">Loading...</span></p>
                    <p>Current: <span id="intensity-value">Loading...</span>%</p>
                    <p>Min: <span id="min-intensity-value">Loading...</span>%</p>
                    <p>Max: <span id="max-intensity-value">Loading...</span>%</p>
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
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault2">
                            <label class="form-check-label" for="flexSwitchCheckDefault2" id="switchLabel2">Lamp
                                Indicator</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const deviceId = 6; // Device ID yang ingin ditampilkan
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
                        document.getElementById('intensity-value').textContent = data.value;
                        document.getElementById('min-intensity-value').textContent = data.min_value;
                        document.getElementById('max-intensity-value').textContent = data.max_value;
                        document.getElementById('time-value').textContent = new Date(data.created_at)
                            .toLocaleString();
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                        document.getElementById('device-id-value').textContent = 'Error';
                        document.getElementById('intensity-value').textContent = 'Error';
                        document.getElementById('min-intensity-value').textContent = 'Error';
                        document.getElementById('max-intensity-value').textContent = 'Error';
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


    {{-- Intensity --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header bg-danger">
                    <i class="fas fa-chart-bar me-1"></i>
                    <b>Intensity Sensor Data Graphics</b>
                </div>
                <div class="card-body" id="intensity-sensor"></div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script>
            let intensityData = [];

            const intensityChart = Highcharts.chart('intensity-sensor', {
                chart: {
                    type: 'areaspline'
                },
                title: {
                    text: 'Intensity Moisture'
                },
                xAxis: {
                    tickInterval: 1,
                    accessibility: {
                        description: 'Intensity values from 0 to 100'
                    },
                    title: {
                        text: 'Time'
                    }
                },
                yAxis: {
                    min: 0,
                    max: 100,
                    tickInterval: 10,
                    title: {
                        text: 'Intensity Value'
                    },
                    labels: {
                        format: '{value}%'
                    },
                    lineWidth: 1
                },
                tooltip: {
                    headerFormat: '<b>{series.name}</b><br />',
                    pointFormat: 'Time = {point.x}, Intensity Value = {point.y}'
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
                                [0, '#FFD700'], // Gold (Yellow)
                                [1, '#FF4500'] // OrangeRed (Orange)
                            ]
                        }
                    }
                },
                series: [{
                    data: intensityData,
                    zones: [{
                        value: 50,
                        color: '#FFD700' // Gold (Yellow)
                    }, {
                        color: '#FF4500' // OrangeRed (Orange)
                    }],
                    name: 'Intensity Sensor',
                    color: '#FFD700', // Line color (start with gold for initial values)
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 1,
                            x2: 0,
                            y2: 0
                        },
                        stops: [
                            [0, '#FFD700'], // Gold (Yellow)
                            [1, '#FF4500'] // OrangeRed (Orange)
                        ]
                    }
                }]
            });

            console.log("Starting fetch request...");

            fetch("{{ route('datas.index') }}?device_id=6")
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log("Fetch successful");
                    console.log(data);
                    intensityData = [];

                    data.forEach(function(item) {
                        // Parse the timestamp to a JS Date object
                        intensityData.push([item.created_at, item.value]);
                    });

                    // Set initial data on chart
                    intensityChart.series[0].setData(intensityData);

                    // Start interval to fetch updated data
                    intervalIntensity();
                })
                .catch(error => {
                    console.log("Fetch error");
                    console.error('There has been a problem with your fetch operation:', error);
                });

            function intervalIntensity() {
                setInterval(function() {
                    updateIntensityData();
                }, 2000);
            }

            function updateIntensityData() {
                fetch("{{ route('datas.index') }}?device_id=6")
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
                            intensityData.push([item.created_at, item.value]);
                        });
                        // Update the chart with new data
                        chart.series[0].setData(intensityData);
                    })
                    .catch(error => {
                        console.log("Update fetch error");
                        console.error('There has been a problem with your fetch operation:', error);
                    });
            }
        </script>
    @endpush
