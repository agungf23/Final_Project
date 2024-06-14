@extends('layouts.app')

@section('content')
    <div class="bg-light text-dark p-3 mb-4 mt-4 border rounded shadow-sm">
        <h1 class="mt-4 display-4 text-primary font-weight-bold">
            <i class="material-icons header-icon"></i>
            <b><i>Green House Integrated IoT Monitoring System</i></b>
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
            <div class="card bg-primary text-white mb-4">
                <div class="card-body text-black">
                    <i class="fas fa-thermometer-half me-2"></i><b> Temperature Sensor</b>
                </div>
                <div class="card-footer text-black d-flex flex-column align-items-start">
                    <p>Device ID: <span id="temperature-device-id-value">Loading...</span></p>
                    <p>Current: <span id="temperature-value">Loading...</span>°C</p>
                    <p>Min: <span id="temperature-min-value">Loading...</span>°C</p>
                    <p>Max: <span id="temperature-max-value">Loading...</span>°C</p>
                    <p>Time: <span id="temperature-time-value">Loading...</span></p>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body text-black">
                    <i class="fas fa-tint half me-2"></i><b> Humidity Sensor</b>
                </div>
                <div class="card-footer text-black d-flex flex-column align-items-start">
                    <p>Device ID: <span id="humidity-device-id-value">Loading...</span></p>
                    <p>Current: <span id="humidity-value">Loading...</span>°C</p>
                    <p>Min: <span id="humidity-min-value">Loading...</span>°C</p>
                    <p>Max: <span id="humidity-max-value">Loading...</span>°C</p>
                    <p>Time: <span id="humidity-time-value">Loading...</span></p>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body text-black">
                    <i class="fas fa-thermometer-half me-2"></i><b>Soil Moisture Sensor</b>
                </div>
                <div class="card-footer text-black d-flex flex-column align-items-start">
                    <p>Device ID: <span id="moisture-device-id-value">Loading...</span></p>
                    <p>Current: <span id="moisture-value">Loading...</span>%</p>
                    <p>Min: <span id="moisture-min-value">Loading...</span>%</p>
                    <p>Max: <span id="moisture-max-value">Loading...</span>%</p>
                    <p>Time: <span id="moisture-time-value">Loading...</span></p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body text-black">
                    <i class="fas fa-thermometer-half me-2"></i><b>Intensity Sensor</b>
                </div>
                <div class="card-footer text-black d-flex flex-column align-items-start">
                    <p>Device ID: <span id="intensity-device-id-value">Loading...</span></p>
                    <p>Current: <span id="intensity-value">Loading...</span>%</p>
                    <p>Min: <span id="intensity-min-value">Loading...</span>%</p>
                    <p>Max: <span id="intensity-max-value">Loading...</span>%</p>
                    <p>Time: <span id="intensity-time-value">Loading...</span></p>
                </div>
            </div>
        </div>

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
                        <label class="form-check-label" for="flexSwitchCheckDefault1" id="switchLabel1">Water Pump</label>
                    </div>
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
            const deviceIds = {
                temperature: 3,
                humidity: 4,
                moisture: 5,
                intensity: 6
            };

            const elements = {
                temperature: {
                    deviceId: 'temperature-device-id-value',
                    value: 'temperature-value',
                    minValue: 'temperature-min-value',
                    maxValue: 'temperature-max-value',
                    time: 'temperature-time-value'
                },
                humidity: {
                    deviceId: 'humidity-device-id-value',
                    value: 'humidity-value',
                    minValue: 'humidity-min-value',
                    maxValue: 'humidity-max-value',
                    time: 'humidity-time-value'
                },
                moisture: {
                    deviceId: 'moisture-device-id-value',
                    value: 'moisture-value',
                    minValue: 'moisture-min-value',
                    maxValue: 'moisture-max-value',
                    time: 'moisture-time-value'
                },
                intensity: {
                    deviceId: 'intensity-device-id-value',
                    value: 'intensity-value',
                    minValue: 'intensity-min-value',
                    maxValue: 'intensity-max-value',
                    time: 'intensity-time-value'
                }
            };

            function fetchData(sensorType) {
                const deviceId = deviceIds[sensorType];
                const endpoint = `/api/data/device/${deviceId}`;

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
                        document.getElementById(elements[sensorType].deviceId).textContent = data.device_id;
                        document.getElementById(elements[sensorType].value).textContent = data.value;
                        document.getElementById(elements[sensorType].minValue).textContent = data.min_value;
                        document.getElementById(elements[sensorType].maxValue).textContent = data.max_value;
                        document.getElementById(elements[sensorType].time).textContent = new Date(data
                            .created_at).toLocaleString();
                    })
                    .catch(error => {
                        console.error(`Error fetching data for ${sensorType}:`, error);
                        document.getElementById(elements[sensorType].deviceId).textContent = 'Error';
                        document.getElementById(elements[sensorType].value).textContent = 'Error';
                        document.getElementById(elements[sensorType].minValue).textContent = 'Error';
                        document.getElementById(elements[sensorType].maxValue).textContent = 'Error';
                        document.getElementById(elements[sensorType].time).textContent = 'Error';
                    });
            }

            ['temperature', 'humidity', 'moisture', 'intensity'].forEach(fetchData);
        });
    </script>

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


    {{-- Temperature --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header bg-primary">
                    <i class="fas fa-chart-area me-1"></i>
                    <b>Temperature Sensor Data Graphics</b>
                </div>
                <div class="card-body" id="temperature-sensor"></div>
            </div>
        </div>

        {{-- Humidity --}}
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header bg-warning">
                    <i class="fas fa-chart-area me-1"></i>
                    <b>Humidity Sensor Data Graphics</b>
                </div>
                <div class="card-body" id="humidity-sensor"></div>
            </div>
        </div>
    </div>

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

        {{-- Intensity --}}
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header bg-danger">
                    <i class="fas fa-chart-bar me-1"></i>
                    <b>Intensity Sensor Data Graphics</b>
                </div>
                <div class="card-body" id="intensity-sensor"></div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        let temperatureData = [];
        const temperatureChart = Highcharts.chart('temperature-sensor', {
            accessibility: {
                enabled: true
            },
            chart: {
                type: 'areaspline'
            },
            title: {
                text: 'Temperature'
            },
            xAxis: {
                tickInterval: 1,
                accessibility: {
                    description: 'Temperature values from 0 to 100'
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
                    text: 'Temperature Value'
                },
                labels: {
                    format: '{value}°'
                },
                lineWidth: 1
            },
            tooltip: {
                headerFormat: '<b>{series.name}</b><br />',
                pointFormat: 'Time = {point.x}, Temperature Value = {point.y}'
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
                            [0, '#1E90FF'], // Blue
                            [1, '#FF0000'] // Red
                        ]
                    }
                }
            },
            series: [{
                data: temperatureData,
                name: 'Temperature Sensor',
                fillColor: {
                    linearGradient: {
                        x1: 0,
                        y1: 1,
                        x2: 0,
                        y2: 0
                    },
                    stops: [
                        [0, '#1E90FF'], // Blue
                        [1, '#FF0000'] // Red
                    ]
                },
                zones: [{
                    value: 50,
                    color: '#1E90FF' // Blue
                }, {
                    color: '#FF0000' // Red
                }]
            }]
        });
        console.log("Starting fetch request...");
        fetch("{{ route('datas.index') }}?device_id=3")
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log("Fetch successful");
                console.log(data);
                temperatureData = [];

                data.forEach(function(item) {
                    temperatureData.push([item.created_at, item.value]);
                });

                // Set initial data on chart
                temperatureChart.series[0].setData(temperatureData);

                // Start interval to fetch updated data
                intervalTemperature();
            })
            .catch(error => {
                console.log("Fetch error");
                console.error('There has been a problem with your fetch operation:', error);
            });

        function intervalTemperature() {
            setInterval(function() {
                updateTemperatureData();
            }, 2000);
        }

        function updateTemperatureData() {
            fetch("{{ route('datas.index') }}?device_id=3")
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log("Update fetch successful");
                    console.log(data);
                    temperatureData = [];
                    data.forEach(function(item) {
                        temperatureData.push([item.created_at, item.value]);
                    });
                    // Update the chart with new data
                    temperatureChart.series[0].setData(temperatureData);
                })
                .catch(error => {
                    console.log("Update fetch error");
                    console.error('There has been a problem with your fetch operation:', error);
                });
        }

        let humidityData = [];
        const humidityChart = Highcharts.chart('humidity-sensor', {
            chart: {
                type: 'areaspline'
            },
            title: {
                text: 'Humidity - Air'
            },
            xAxis: {
                tickInterval: 1,
                accessibility: {
                    description: 'Humidity values from 0 to 100'
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
                    text: 'Humidity Value'
                },
                labels: {
                    format: '{value}%'
                },
                lineWidth: 1
            },
            tooltip: {
                headerFormat: '<b>{series.name}</b><br />',
                pointFormat: 'Time = {point.x}, Humidity Value = {point.y}'
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
                            [1, '#FFD700'] // Yellow
                        ]
                    }
                }
            },
            series: [{
                data: humidityData,
                name: 'Humidity Sensor',
                zones: [{
                    value: 50,
                    color: '#32CD32' // Green
                }, {
                    color: '#FFD700' // Yellow
                }],
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
                        [1, '#FFD700'] // Yellow
                    ]
                }
            }]
        });
        console.log("Starting fetch request...");
        fetch("{{ route('datas.index') }}?device_id=4")
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log("Fetch successful");
                console.log(data);
                humidityData = [];

                data.forEach(function(item) {
                    // Parse the timestamp to a JS Date object
                    humidityData.push([item.created_at, item.value]);
                });

                // Set initial data on chart
                humidityChart.series[0].setData(humidityData);

                // Start interval to fetch updated data
                intervalHumidity();
            })
            .catch(error => {
                console.log("Fetch error");
                console.error('There has been a problem with your fetch operation:', error);
            });

        function intervalHumidity() {
            setInterval(function() {
                updateHumidityData();
            }, 2000);
        }

        function updateHumidityData() {
            fetch("{{ route('datas.index') }}?device_id=4")
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
                        humidityData.push([item.created_at, item.value]);
                    });
                    // Update the chart with new data
                    humidityChart.series[0].setData(humidityData);
                })
                .catch(error => {
                    console.log("Update fetch error");
                    console.error('There has been a problem with your fetch operation:', error);
                });
        }


        let moistureData = [];
        const moistureChart = Highcharts.chart('moisture-sensor', {
            chart: {
                type: 'areaspline'
            },
            title: {
                text: 'Soil Moisture'
            },
            xAxis: {
                tickInterval: 1,
                accessibility: {
                    description: 'Moisture values from 0 to 100'
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
                    text: 'Moisture Value'
                },
                labels: {
                    format: '{value}%'
                },
                lineWidth: 1
            },
            tooltip: {
                headerFormat: '<b>{series.name}</b><br />',
                pointFormat: 'Time = {point.x}, Moisture Value = {point.y}'
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
                    moistureData.push([item.created_at, item.value]);
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
            }, 2000);
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

                    data.forEach(function(item) {
                            moistureData.push([item.created_at, item.value]);
                        });
                        // Update the chart with new data
                        moistureChart.series[0].setData(moistureChart);
                    })
                .catch(error => {
                    console.log("Update fetch error");
                    console.error('There has been a problem with your fetch operation:', error);
                });
        }



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
            }, 5000);
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
                        intensityChart.series[0].setData(intensityData);
                    })
                .catch(error => {
                    console.log("Update fetch error");
                    console.error('There has been a problem with your fetch operation:', error);
                });
        }
    </script>
@endpush
