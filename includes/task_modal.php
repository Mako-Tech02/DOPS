<?php
include_once('includes/session.php');
include('includes/db.php');
$current_date = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://unpkg.com/@jarstone/dselect/dist/js/dselect.js"></script>
</head>
<body>
    <div id="myModal" class="modal">
        <div class="modal-content table-responsive">
            <div class="modal-header">
                <h3 class="modal-title">Add New Patient Details</h3>
                <div class="float-end"><span class="close">&times;</span></div>
            </div>
            <div id="alertMsg"></div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Details</th>
                        <th>Patient</th>
                        <th>Date</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Hours</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- Existing or dynamically populated table rows will go here -->
                </tbody>
            </table>
            <fieldset>
                <legend>Total Hours: <span id="totalHours"></span></legend>
                <form id="insertForm" method="post" action="submit_all.php">
                    <input type="hidden" name="user_id" value="<?= $_SESSION["User"]["employee_id"]; ?>"/>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="project_id">Patient</label>
                            <select name="project_id" id="project_id" class="form-control">
                                <option value="" selected>Select Patient</option>
                                <?php 
                                    $sql = "SELECT * FROM projects WHERE project_id IN (SELECT project_id FROM project_users WHERE employee_id = '".$_SESSION["User"]["employee_id"]."')"; 
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value=\"{$row['project_id']}\">{$row['project_name']}</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" min="<?= $current_date; ?>"/>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label for="time_start">Start</label>
                            <input type="time" class="form-control" id="time_start" name="start"/>
                        </div>
                        <div class="col">
                            <label for="time_end">End</label>
                            <input type="time" class="form-control" id="time_end" name="end"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <textarea class="form-control" placeholder="Task Description" name="description" required></textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <button type="button" class="btn btn-primary form-control" id="submitForm">Add Details</button>
                        </div>
                        <div class="col">
                            <a href="submit_all.php?submit=all" class="btn btn-primary form-control">Submit All</a>
                        </div>
                    </div>
                </form>
            </fieldset>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        var select_box_element = document.querySelector('#project_id');
        dselect(select_box_element, {
            search: true
        });

        flatpickr('#date', {
            enableTime: false,
            minDate: 'today'
        });

        flatpickr('#time_start', {
            enableTime: true,
            noCalendar: true,
            dateFormat: 'H:i',
        });

        flatpickr('#time_end', {
            enableTime: true,
            noCalendar: true,
            dateFormat: 'H:i',
        });

        function updateHoursAndDuration() {
            const startTimeInput = document.getElementById('time_start');
            const endTimeInput = document.getElementById('time_end');
            const durationCombined = document.getElementById('duration_combined');

            if (startTimeInput && endTimeInput && durationCombined) {
                const startTime = startTimeInput.value;
                const endTime = endTimeInput.value;

                if (startTime && endTime) {
                    const startMoment = moment(startTime, 'HH:mm');
                    const endMoment = moment(endTime, 'HH:mm');
                    const durationMinutes = endMoment.diff(startMoment, 'minutes');

                    // Convert durationMinutes to a decimal fraction of an hour
                    const durationHours = durationMinutes / 60;

                    // Round the decimal to two decimal places
                    const formattedDuration = durationHours.toFixed(2);

                    durationCombined.value = formattedDuration;
                } else {
                    durationCombined.value = '0.00';
                }
            }
        }

        document.getElementById('time_start').addEventListener('change', updateHoursAndDuration);
        document.getElementById('time_end').addEventListener('change', updateHoursAndDuration);

        const startTimeInput = document.getElementById('time_start');
        const endTimeInput = document.getElementById('time_end');

        startTimeInput.addEventListener('input', function() {
            endTimeInput.min = startTimeInput.value;
            if (endTimeInput.value < startTimeInput.value) {
                endTimeInput.value = startTimeInput.value;
            }
        });

        endTimeInput.addEventListener('input', function() {
            if (endTimeInput.value < startTimeInput.value) {
                endTimeInput.value = startTimeInput.value;
            }
        });
    </script>
</body>
</html>
