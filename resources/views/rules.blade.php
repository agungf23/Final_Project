@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Rule Management</title>
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
            <li class="breadcrumb-item active">rule</li>
        </ol>
        <div class="container-xl">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h2>Manage <b>rule</b></h2>
                            </div>
                            <div class="col-sm-6">
                                <a href="#addRuleModal" class="btn btn-success" data-toggle="modal"><i
                                        class="material-icons">&#xE147;</i> <span>Add New Data</span></a>
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
                                <th>Rule Cluster ID</th>
                                <th>Sensor ID</th>
                                <th>Sensor Operator</th>
                                <th>Sensor Value</th>
                                <th>Actuator ID</th>
                                <th>Actuator Value</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="ruleTableBody">
                            <!-- Data data will be filled here by JavaScript -->
                        </tbody>
                    </table>
                    <div class="clearfix">
                        <div class="hint-text"><b>showing rules</b></div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <!-- POST Modal HTML -->
        <div id="addRuleModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="createRuleForm">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">Add Rule</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Rule Cluster ID</label>
                                <input type="number" id="rule_cluster_id" name="rule_cluster_id" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Sensor ID</label>
                                <input type="number" id="sensor_id" name="sensor_id" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Sensor Operator</label>
                                <select id="sensor_operator" name="sensor_operator" class="form-control" required>
                                    <option value="More Than">More Than</option>
                                    <option value="Less Than">Less Than</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Sensor Value</label>
                                <input type="number" id="sensor_value" name="sensor_value" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Actuator ID</label>
                                <input type="number" id="actuator_id" name="actuator_id" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Actuator Value</label>
                                <input type="number" id="actuator_value" name="actuator_value" class="form-control" required>
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
        <div id="editRuleModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="updateRuleForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="update_id" name="id">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Rule</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Rule Cluster ID</label>
                                <input type="number" id="update_rule_cluster_id" name="rule_cluster_id" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Sensor ID</label>
                                <input type="number" id="update_sensor_id" name="sensor_id" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Sensor Operator</label>
                                <select id="update_sensor_operator" name="sensor_operator" class="form-control">
                                    <option value="More Than">More Than</option>
                                    <option value="Less Than">Less Than</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Sensor Value</label>
                                <input type="number" id="update_sensor_value" name="sensor_value" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Actuator ID</label>
                                <input type="number" id="update_actuator_id" name="actuator_id" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Actuator Value</label>
                                <input type="number" id="update_actuator_value" name="actuator_value" class="form-control">
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
        <div id="deleteRuleModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="deleteRuleForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Rule</h4>
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
                fetchRules();

                setInterval(fetchRules, 5000);
                // Fetch all rules
                function fetchRules() {
                    axios.get('/api/rules')
                        .then(response => {
                            let rule = response.data;
                            let ruleTableBody = $('#ruleTableBody');
                            ruleTableBody.empty();
                            rule.forEach(rule => {
                                ruleTableBody.append(`
                        <tr>
                            <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll${rule.id}" name="options[]" value="${rule.id}">
                                    <label for="checkbox${rule.id}"></label>
                                </span>
                            </td>
                            <td>${rule.id}</td>
                            <td>${rule.rule_cluster_id}</td>
                            <td>${rule.sensor_id}</td>
                            <td>${rule.sensor_operator}</td>
                            <td>${rule.sensor_value}</td>
                            <td>${rule.actuator_id}</td>
                            <td>${rule.actuator_value}</td>
                            <td>
                                <a href="#editRuleModal" class="edit" data-toggle="modal" onclick="editRule(${rule.id})"><i
                                        class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                <a href="#deleteRuleModal" class="delete" data-toggle="modal" onclick="deleteRule(${rule.id})"><i
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

                // Create new rules
                $('#createRuleForm').submit(function(event) {
                    event.preventDefault();
                    let formData = $(this).serialize();
                    axios.post('/api/rules', formData)
                        .then(response => {
                            alert(response.data.message);
                            fetchRules();
                            $('#createRuleForm')[0].reset();
                            $('#addRuleModal').modal('hide');
                        })
                        .catch(error => {
                            console.log(error);
                        });
                });

                // Edit rules
                window.editRule = function(id) {
                    axios.get(`/api/rule/${id}`)
                        .then(response => {
                            let rule = response.data;
                            $('#update_id').val(rule.id);
                            $('#update_rule_cluster_id').val(rule.rule_cluster_id);
                            $('#update_sensor_id').val(rule.sensor_id);
                            $('#update_sensor_operator').val(rule.sensor_operator);
                            $('#update_sensor_value').val(rule.sensor_value);
                            $('#update_actuator_id').val(rule.actuator_id);
                            $('#update_actuator_value').val(rule.actuator_value);
                        })
                        .catch(error => {
                            console.log(error);
                        });
                };

                // Update rule
                $('#updateRuleForm').submit(function(event) {
                    event.preventDefault();
                    let id = $('#update_id').val();
                    let formData = $(this).serialize();
                    axios.put(`/api/rule/${id}`, formData)
                        .then(response => {
                            alert(response.data.message);
                            fetchRules();
                            $('#updateRuleForm')[0].reset();
                            $('#editRuleModal').modal('hide');
                        })
                        .catch(error => {
                            console.log(error);
                        });
                });

                // Delete data
                window.deleteRule = function(id) {
                    $('#deleteRuleForm').submit(function(event) {
                        event.preventDefault();
                        axios.delete(`/api/rule/${id}`)
                            .then(response => {
                                alert(response.data.message);
                                fetchrule();
                                $('#deleteRuleModal').modal('hide');
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
        <footer class="breadcrumb mb-4">
            <div class="container-fluid px-4">
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2023</div>
                    <div class="text-center text-md-start">
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>
@endsection
