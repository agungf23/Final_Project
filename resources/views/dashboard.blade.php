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
                    <i class="fas fa-thermometer-half me-2"></i><b> Temperature Sensor</b></div>
                <div class="card-footer d-flex flex-column align-items-start">
                    <p id="current-temperature">Current: <span id="temperature-value">Loading...</span>°C</p>
                    <p id="min-temperature">Min: <span id="min-temperature-value">Loading...</span>°C</p>
                    <p id="max-temperature">Max: <span id="max-temperature-value">Loading...</span>°C</p>
                    <p id="max-temperature">Time: <span id="time-value">Loading...</span></p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body text-black">
                    <i class="fas fa-tint half me-2"></i><b> Humidity Sensor</b></div>
                <div class="card-footer d-flex flex-column align-items-start">
                    <p id="current-humidity">Current: <span id="humidity-value">Loading...</span>%</p>
                    <p id="min-humidity">Min: <span id="min-humidity-value">Loading...</span>%</p>
                    <p id="max-humidity">Max: <span id="max-humidity-value">Loading...</span>%</p>
                    <p id="humidity-time">Time: <span id="humidity-time-value">Loading...</span></p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body text-black">
                    <i class="fas fa-seedling me-2"></i><b> Soil Moisture Sensor</b></div>
                <div class="card-footer d-flex flex-column align-items-start">
                    <p id="current-moisture">Current: <span id="moisture-value">Loading...</span>%</p>
                    <p id="min-moisture">Min: <span id="min-moisture-value">Loading...</span>%</p>
                    <p id="max-moisture">Max: <span id="max-moisture-value">Loading...</span>%</p>
                    <p id="moisture-time">Time: <span id="moisture-time-value">Loading...</span></p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body text-black">
                    <i class="fas fa-sun me-2"></i><b> Intensity Sensor</b></div>
                <div class="card-footer d-flex flex-column align-items-start">
                    <p id="current-intensity">Current: <span id="intensity-value">Loading...</span>%</p>
                    <p id="min-intensity">Min: <span id="min-intensity-value">Loading...</span>%</p>
                    <p id="max-intensity">Max: <span id="max-intensity-value">Loading...</span>%</p>
                    <p id="intensity-time">Time: <span id="intensity-time-value">Loading...</span></p>
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
        Highcharts.chart('temperature-sensor', {
            chart: {
                type: 'spline'
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
                max: 70,
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
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [{
                data: [
                    [0, 5.2],
                    [5, 25.3],
                    [10, 15.7],
                    [15, 35.0],
                    [20, 10.2],
                    [25, 55.3],
                    [30, 30.0],
                    [35, 70.5],
                    [40, 20.2],
                    [45, 80.4],
                    [50, 25.6],
                    [55, 60.7],
                    [60, 35.0],
                    [65, 50.3],
                    [70, 20.4],
                    [75, 65.0],
                    [80, 45.3],
                    [85, 55.0],
                    [90, 30.4],
                    [95, 70.0],
                    [100, 40.1]
                ],
                zones: [{
                    value: 10,
                    color: '#1E90FF' // Blue
                }, {
                    value: 20,
                    color: '#32CD32' // Green
                }, {
                    value: 30,
                    color: '#FFD700' // Gold
                }, {
                    value: 40,
                    color: '#FF4500' // OrangeRed
                }, {
                    color: '#FF0000' // Red
                }],
                pointStart: 1,
                name: 'Temperature Sensor'
            }]
        });


        Highcharts.chart('humidity-sensor', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Humidity - air'
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
                    format: '{value}°'
                },
                lineWidth: 1
            },
            tooltip: {
                headerFormat: '<b>{series.name}</b><br />',
                pointFormat: 'Time = {point.x}, Humidity Value = {point.y}'
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [{
                data: [
                    [0, 5.2],
                    [5, 25.3],
                    [10, 15.7],
                    [15, 35.0],
                    [20, 10.2],
                    [25, 55.3],
                    [30, 30.0],
                    [35, 70.5],
                    [40, 20.2],
                    [45, 80.4],
                    [50, 25.6],
                    [55, 60.7],
                    [60, 35.0],
                    [65, 50.3],
                    [70, 20.4],
                    [75, 65.0],
                    [80, 45.3],
                    [85, 55.0],
                    [90, 30.4],
                    [95, 70.0],
                    [100, 40.1]
                ],
                zones: [{
                    value: 10,
                    color: '#1E90FF' // Blue
                }, {
                    value: 20,
                    color: '#32CD32' // Green
                }, {
                    value: 30,
                    color: '#FFD700' // Gold
                }, {
                    value: 40,
                    color: '#FF4500' // OrangeRed
                }, {
                    color: '#FF0000' // Red
                }],
                pointStart: 1,
                name: 'Humidity Sensor'
            }]
        });


        Highcharts.chart('moisture-sensor', {
            chart: {
                type: 'spline'
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
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [{
                data: [
                    [0, 5.2],
                    [5, 25.3],
                    [10, 15.7],
                    [15, 35.0],
                    [20, 10.2],
                    [25, 55.3],
                    [30, 30.0],
                    [35, 70.5],
                    [40, 20.2],
                    [45, 80.4],
                    [50, 25.6],
                    [55, 60.7],
                    [60, 35.0],
                    [65, 50.3],
                    [70, 20.4],
                    [75, 65.0],
                    [80, 45.3],
                    [85, 55.0],
                    [90, 30.4],
                    [95, 70.0],
                    [100, 40.1]
                ],
                zones: [{
                    value: 10,
                    color: '#1E90FF' // Blue
                }, {
                    value: 20,
                    color: '#32CD32' // Green
                }, {
                    value: 30,
                    color: '#FFD700' // Gold
                }, {
                    value: 40,
                    color: '#FF4500' // OrangeRed
                }, {
                    color: '#FF0000' // Red
                }],
                pointStart: 1,
                name: 'Soil Moisture Sensor'
            }]
        });


        Highcharts.chart('intensity-sensor', {
            chart: {
                type: 'spline'
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
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [{
                data: [
                    [0, 5.2],
                    [5, 25.3],
                    [10, 15.7],
                    [15, 35.0],
                    [20, 10.2],
                    [25, 55.3],
                    [30, 30.0],
                    [35, 70.5],
                    [40, 20.2],
                    [45, 80.4],
                    [50, 25.6],
                    [55, 60.7],
                    [60, 35.0],
                    [65, 50.3],
                    [70, 20.4],
                    [75, 65.0],
                    [80, 45.3],
                    [85, 55.0],
                    [90, 30.4],
                    [95, 70.0],
                    [100, 40.1]
                ],
                zones: [{
                    value: 10,
                    color: '#1E90FF' // Blue
                }, {
                    value: 20,
                    color: '#32CD32' // Green
                }, {
                    value: 30,
                    color: '#FFD700' // Gold
                }, {
                    value: 40,
                    color: '#FF4500' // OrangeRed
                }, {
                    color: '#FF0000' // Red
                }],
                pointStart: 1,
                name: 'Intensity Sensor'
            }]
        });
    </script>
@endpush
