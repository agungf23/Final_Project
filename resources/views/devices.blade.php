@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Devices Management</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>

        <style>
            body {
                color: #566787;
                background: #f5f5f5;
                font-family: 'Varela Round', sans-serif;
                font-size: 13px;
            }

            .table-responsive {
                margin: 30px 0;
            }

            .table-wrapper {
                background: #fff;
                padding: 20px 25px;
                border-radius: 3px;
                min-width: 1000px;
                box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
            }

            .table-title {
                padding-bottom: 15px;
                background: #435d7d;
                color: #fff;
                padding: 16px 30px;
                min-width: 100%;
                margin: -20px -25px 10px;
                border-radius: 3px 3px 0 0;
            }

            .table-title h2 {
                margin: 5px 0 0;
                font-size: 24px;
            }

            .table-title .btn-group {
                float: right;
            }

            .table-title .btn {
                color: #fff;
                float: right;
                font-size: 13px;
                border: none;
                min-width: 50px;
                border-radius: 2px;
                border: none;
                outline: none !important;
                margin-left: 10px;
            }

            .table-title .btn i {
                float: left;
                font-size: 21px;
                margin-right: 5px;
            }

            .table-title .btn span {
                float: left;
                margin-top: 2px;
            }

            table.table tr th,
            table.table tr td {
                border-color: #e9e9e9;
                padding: 12px 15px;
                vertical-align: middle;
            }

            table.table tr th:first-child {
                width: 60px;
            }

            table.table tr th:last-child {
                width: 100px;
            }

            table.table-striped tbody tr:nth-of-type(odd) {
                background-color: #fcfcfc;
            }

            table.table-striped.table-hover tbody tr:hover {
                background: #f5f5f5;
            }

            table.table th i {
                font-size: 13px;
                margin: 0 5px;
                cursor: pointer;
            }

            table.table td:last-child i {
                opacity: 0.9;
                font-size: 22px;
                margin: 0 5px;
            }

            table.table td a {
                font-weight: bold;
                color: #566787;
                display: inline-block;
                text-decoration: none;
                outline: none !important;
            }

            table.table td a:hover {
                color: #2196F3;
            }

            table.table td a.edit {
                color: #FFC107;
            }

            table.table td a.delete {
                color: #F44336;
            }

            table.table td i {
                font-size: 19px;
            }

            table.table .avatar {
                border-radius: 50%;
                vertical-align: middle;
                margin-right: 10px;
            }

            .pagination {
                float: right;
                margin: 0 0 5px;
            }

            .pagination li a {
                border: none;
                font-size: 13px;
                min-width: 30px;
                min-height: 30px;
                color: #999;
                margin: 0 2px;
                line-height: 30px;
                border-radius: 2px !important;
                text-align: center;
                padding: 0 6px;
            }

            .pagination li a:hover {
                color: #666;
            }

            .pagination li.active a,
            .pagination li.active a.page-link {
                background: #03A9F4;
            }

            .pagination li.active a:hover {
                background: #0397d6;
            }

            .pagination li.disabled i {
                color: #ccc;
            }

            .pagination li i {
                font-size: 16px;
                padding-top: 6px
            }

            .hint-text {
                float: left;
                margin-top: 10px;
                font-size: 13px;
            }

            /* Custom checkbox */
            .custom-checkbox {
                position: relative;
            }

            .custom-checkbox input[type="checkbox"] {
                opacity: 0;
                position: absolute;
                margin: 5px 0 0 3px;
                z-index: 9;
            }

            .custom-checkbox label:before {
                width: 18px;
                height: 18px;
            }

            .custom-checkbox label:before {
                content: '';
                margin-right: 10px;
                display: inline-block;
                vertical-align: text-top;
                background: white;
                border: 1px solid #bbb;
                border-radius: 2px;
                box-sizing: border-box;
                z-index: 2;
            }

            .custom-checkbox input[type="checkbox"]:checked+label:after {
                content: '';
                position: absolute;
                left: 6px;
                top: 3px;
                width: 6px;
                height: 11px;
                border: solid #000;
                border-width: 0 3px 3px 0;
                transform: inherit;
                z-index: 3;
                transform: rotateZ(45deg);
            }

            .custom-checkbox input[type="checkbox"]:checked+label:before {
                border-color: #03A9F4;
                background: #03A9F4;
            }

            .custom-checkbox input[type="checkbox"]:checked+label:after {
                border-color: #fff;
            }

            .custom-checkbox input[type="checkbox"]:disabled+label:before {
                color: #b8b8b8;
                cursor: auto;
                box-shadow: none;
                background: #ddd;
            }

            /* Modal styles */
            .modal .modal-dialog {
                max-width: 400px;
            }

            .modal .modal-header,
            .modal .modal-body,
            .modal .modal-footer {
                padding: 20px 30px;
            }

            .modal .modal-content {
                border-radius: 3px;
                font-size: 14px;
            }

            .modal .modal-footer {
                background: #ecf0f1;
                border-radius: 0 0 3px 3px;
            }

            .modal .modal-title {
                display: inline-block;
            }

            .modal .form-control {
                border-radius: 2px;
                box-shadow: none;
                border-color: #dddddd;
            }

            .modal textarea.form-control {
                resize: vertical;
            }

            .modal .btn {
                border-radius: 2px;
                min-width: 100px;
            }

            .modal form label {
                font-weight: normal;
            }
        </style>
        <script>
            $(document).ready(function() {
                // Activate tooltip
                $('[data-toggle="tooltip"]').tooltip();

                // Select/Deselect checkboxes
                var checkbox = $('table tbody input[type="checkbox"]');
                $("#selectAll").click(function() {
                    if (this.checked) {
                        checkbox.each(function() {
                            this.checked = true;
                        });
                    } else {
                        checkbox.each(function() {
                            this.checked = false;
                        });
                    }
                });
                checkbox.click(function() {
                    if (!this.checked) {
                        $("#selectAll").prop("checked", false);
                    }
                });
            });
        </script>
    </head>

    <body>
        <h1 class="mt-4">Green House Monitoring System</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Devices</li>
        </ol>
        <div class="container-xl">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h2>Manage <b>Devices</b></h2>
                            </div>
                            <div class="col-sm-6">
                                <a href="#addDeviceModal" class="btn btn-success" data-toggle="modal"><i
                                        class="material-icons">&#xE147;</i> <span>Add New Device</span></a>
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="selectAll">
                                        <label for="selectAll"></label>
                                    </span>
                                </th>
                                <th>ID</th>
                                <th>Device Name</th>
                                <th>Device Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="deviceTableBody">
                            <!-- Device data will be filled here by JavaScript -->
                        </tbody>
                    </table>
                    <div class="clearfix">
                        <div class="hint-text"><b>showing data devices</b></div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <!-- POST Modal HTML -->
        <div id="addDeviceModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="createDeviceForm">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">Add Device</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Device Name</label>
                                <input type="text" id="device_name" name="device_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Device Type</label>
                                <select id="device_type" name="device_type" class="form-control" required>
                                    <option value="Sensor">Sensor</option>
                                    <option value="Actuator">Actuator</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-success" value="Add">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- PUT Modal HTML -->
        <div id="editDeviceModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="updateDeviceForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="update_id" name="id">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Device</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Device Name</label>
                                <input type="text" id="update_device_name" name="device_name" class="form-control"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Device Type</label>
                                <select id="update_device_type" name="device_type" class="form-control" required>
                                    <option value="Sensor">Sensor</option>
                                    <option value="Actuator">Actuator</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-info" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Modal HTML -->
        <div id="deleteDeviceModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="deleteDeviceForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Device</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete these Records?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                fetchDevices();

                setInterval(fetchDevices, 5000);
                // Fetch all transducers
                function fetchDevices() {
                    axios.get('/api/devices')
                        .then(response => {
                            let devices = response.data;
                            let deviceTableBody = $('#deviceTableBody');
                            deviceTableBody.empty();
                            devices.forEach(device => {
                                deviceTableBody.append(`
                        <tr>
                            <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll${device.id}" name="options[]" value="${device.id}">
                                    <label for="checkbox${device.id}"></label>
                                </span>
                            </td>
                            <td><a href="/api/device/${device.id}" class="device-detail">${device.id}</a></td>
                            <td>${device.device_name}</td>
                            <td>${device.device_type}</td>
                            <td>
                                <a href="#editDeviceModal" class="edit" data-toggle="modal" onclick="editDevice(${device.id})"><i
                                        class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                <a href="#deleteDeviceModal" class="delete" data-toggle="modal" onclick="deleteDevice(${device.id})"><i
                                        class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                            </td>
                        </tr>
                    `);
                            });
                            addCheckboxEventListeners();
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }

                // Create new device
                $('#createDeviceForm').submit(function(event) {
                    event.preventDefault();
                    let formData = $(this).serialize();
                    axios.post('/api/devices', formData)
                        .then(response => {
                            alert(response.data.message);
                            fetchDevices();
                            $('#createDeviceForm')[0].reset();
                            $('#addDeviceModal').modal('hide');
                        })
                        .catch(error => {
                            console.log(error);
                        });
                });

                // Edit device
                window.editDevice = function(id) {
                    axios.get(`/api/devices/${id}`)
                        .then(response => {
                            let device = response.data;
                            $('#update_id').val(device.id);
                            $('#update_device_name').val(device.device_name);
                            $('#update_device_type').val(device.device_type);
                        })
                        .catch(error => {
                            console.log(error);
                        });
                };

                // Update device
                $('#updateDeviceForm').submit(function(event) {
                    event.preventDefault();
                    let id = $('#update_id').val();
                    let formData = $(this).serialize();
                    axios.put(`/api/devices/${id}`, formData)
                        .then(response => {
                            alert(response.data.message);
                            fetchDevices();
                            $('#updateDeviceForm')[0].reset();
                            $('#editDeviceModal').modal('hide');
                        })
                        .catch(error => {
                            console.log(error);
                        });
                });

                // Delete transducer
                window.deleteDevice = function(id) {
                    $('#deleteDeviceForm').submit(function(event) {
                        event.preventDefault();
                        axios.delete(`/api/devices/${id}`)
                            .then(response => {
                                alert(response.data.message);
                                fetchDevices();
                                $('#deleteDeviceModal').modal('hide');
                            })
                            .catch(error => {
                                console.log(error);
                            });
                    });
                };
            });


            // Add event listeners to checkboxes
            function addCheckboxEventListeners() {
                var checkbox = $('table tbody input[type="checkbox"]');
                $("#selectAll").off('click').on('click', function() {
                    if (this.checked) {
                        checkbox.each(function() {
                            this.checked = true;
                        });
                    } else {
                        checkbox.each(function() {
                            this.checked = false;
                        });
                    }
                });
                checkbox.off('click').on('click', function() {
                    if (!this.checked) {
                        $("#selectAll").prop("checked", false);
                    }
                });
            }
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>
@endsection
