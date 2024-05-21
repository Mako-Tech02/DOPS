<?php
include_once('includes/session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DOPS</title>
    <link href="bootstrap.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <?php
        $page= 'dashboard';
    ?>
    <?php require('includes/header.php');?>
    <div class="container" style="padding-top: 80px;">
    <?php require('includes/pwd_check.php');?>
    
        <div class="container">
            <?php if(isset($_SESSION["error"]) && $_SESSION["error"] != ""){?>
                <div class="alert alert-danger">
                    <ul>
                        <?= $_SESSION["error"]; ?>
                    </ul>
                </div>
            <?php
                 $_SESSION["error"] = "";
            }?>
            <?php if(isset($_SESSION["success"]) && $_SESSION["success"] != ""){?>
                <div class="alert alert-success">
                    <?= $_SESSION["success"]; ?>
                </div>
            <?php
                 $_SESSION["success"] = "";
            }?>
            <div class="card bg-light text-dark">
                <div class="card-header">
                    <!-- <a href="employees.php" class="btn btn-primary">Back</a> -->
                    <h3>Dashboard <i class="fa fa-hospital-o"></i></h3>
                    <div class="row g-3 my-2">
                        <div class="col-md-3">
                            <?php if($_SESSION["User"]["is_admin"]){?>
                                <a href="employees.php" style="background-color: blue; color: blue; text-decoration: none">
                                <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                    <div>
                                        <h3 class="fs-2"><?= get_employees(); ?></h3>
                                        <p class="fs-5">Health Workers</p>
                                    </div>
                                    <i class="fas fa-users fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                                </div>
                                </a>
                            <?php }else{ ?>
                                
                                <a href="tasks.php" style="background-color: blue; color: blue; text-decoration: none"><div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                    <div>
                                        <h3 class="fs-2"><?= get_assignedProjects(); ?></h3>
                                        <p class="fs-5">Assigned Patients</p>
                                    </div>
                                    <i class="fas fa-project-diagram fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                                </div></a>
                            <?php } ?>
                        </div>
                        
                        
                        <div class="col-md-3">
                        <?php if($_SESSION["User"]["is_admin"]){?>
                        <a href="projects.php" style="background-color: blue; color: blue; text-decoration: none">
                            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                <div>
                                    <h3 class="fs-2"><?= get_projects(); ?></h3>
                                    <p class="fs-5">Patients</p>
                                </div>
                                <i
                                    class="fas fa-users fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                            </div>
                            </a>
                            <?php }else{ ?>
                                <a href="tasks.php" style="background-color: blue; color: blue; text-decoration: none"><div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                    <div>
                                        <h3 class="fs-2 "><?= get_hours(); ?></h3>
                                        <p class="fs-5">Hours</p>
                                    </div>
                                    <i class="fas fa-clock fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                                </div></a>
                            <?php } ?>
                        </div>
                        <div class="col-md-3">
                        <?php if($_SESSION["User"]["is_admin"]){?>
                        <a href="report.php" style="background-color: red; color: red; text-decoration: none">
                            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                <div>
                                    <h3 class="fs-2" style="color:red;"><?= displayOutbreakCount(); ?></h3>
                                    <p class="fs-5" style="color:red;">Possible Outbreaks</p>
                                </div>
                                <i
                                    class="fas fa-certificate fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                            </div>
                            </a>
                            <?php }else{ ?>
                                <!-- <a href="tasks.php" style="background-color: black; color: black; text-decoration: none"><div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                    <div>
                                        <h3 class="fs-2 "><?= get_hours(); ?></h3>
                                        <p class="fs-5">Hours</p>
                                    </div>
                                    <i class="fas fa-clock fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                                </div></a> -->
                            <?php } ?>
                        </div>
                        

                        <div class="col-md-3">
                        <?php if($_SESSION["User"]["is_admin"]){?>
                        <a href="clients.php" style="background-color: blue; color: blue; text-decoration: none">
                            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                <div>
                                    <h3 class="fs-2"><?= get_clients(); ?></h3>
                                    <p class="fs-5">Areas</p>
                                </div>
                                <i class="fas fa-podcast fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                            </div>
                            </a>
                            <?php }
                            else{ ?>
                                <!-- <a href="tasks.php" style="background-color: black; color: black; text-decoration: none"><div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                    <div>
                                        <h3 class="fs-2 "><?= get_hours(); ?></h3>
                                        <p class="fs-5">Hours</p>
                                    </div>
                                    <i class="fas fa-clock fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                                </div></a> -->
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-light text-dark my-3">
                
                <div class="card-header" >
                    <h3 style="color:red;">Possible Disease Outbreaks:</h3>
                </div>
                <div class="card-body">
                    <?php
                        // Function to fetch disease name from the database using ID
                        function getDiseaseNameById($diseaseId) {
                            global $conn;
                            
                            $sql = "SELECT disease_name FROM diseases WHERE disease_id = $diseaseId";
                            $result = $conn->query($sql);
                            
                            if ($result && $result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                return $row['disease_name'];
                            } else {
                                return "No possible outbreaks";
                            }
                        }

                        // Function to predict disease outbreaks
                        function predictOutbreak() {
                            global $conn;
                            $outbreakDiseases = array();

                            // Fetch diseases and count the number of patients recorded per disease
                            $sql = "SELECT disease_id, COUNT(*) AS patient_count FROM tasks GROUP BY disease_id HAVING COUNT(*) >= 3";
                            $result = $conn->query($sql);
                            
                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $diseaseId = $row['disease_id'];
                                    $outbreakDiseases[] = $diseaseId;
                                }
                            }

                            return $outbreakDiseases;
                        }

                        // Function to display the number of outbreaks
                        function displayOutbreakCount() {
                            $outbreakDiseases = predictOutbreak();
                            return count($outbreakDiseases);
                        }

                        // Display outbreaks on the dashboard
                        $outbreakDiseases = predictOutbreak();
                        $outbreakMessage = "";
                        if (!empty($outbreakDiseases)) {
                            $outbreakMessage .= "<ul>";
                            foreach ($outbreakDiseases as $diseaseId) {
                                $diseaseName = getDiseaseNameById($diseaseId);
                                $outbreakMessage .= "<li >$diseaseName</li>";
                            }
                            $outbreakMessage .= "</ul>";
                        } else {
                            $outbreakMessage .= "<p>No outbreaks detected.</p>";
                        }

                        echo $outbreakMessage;
                    ?>
                </div>
            </div>
            <div class="col-md-12">
                                 <?php if($_SESSION["User"]["is_admin"]){?>
                             <div class="card-body">
                             <div class="row my-2">
                                 <h3 class="fs-4 mb-3">Recently Assigned Patients</h3>
                                 <div class="col">
                                 <div class="card">
                
                <div class="card-body">
                    <?php if(isset($_SESSION["error"]) && $_SESSION["error"] != ""){?>
                        <div class="alert alert-danger">
                            <?= $_SESSION["error"]; ?>
                        </div>
                    <?php
                        $_SESSION["error"] = "";
                    }?>
                    <?php if(isset($_SESSION["success"]) && $_SESSION["success"] != ""){?>
                        <div class="alert alert-success">
                            <?= $_SESSION["success"]; ?>
                        </div>
                    <?php
                        $_SESSION["success"] = "";
                    }?>
                    <div class="card-body table-responsive">
                        <table class="table table-hover ">
                        <thead>
                            <tr>
                                <!-- <th>ID</th> -->
                                <th>Area</th>
                                <th>Patient</th>
                                <th>Health Worker</th>
                                <!-- <th>Rate</th> -->
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody id="activeTableBody">
                            <?php

                                $sql = "SELECT * FROM project_users
                                LEFT JOIN projects ON project_users.project_id = projects.project_id
                                LEFT JOIN clients ON projects.client_id = clients.client_id
                                LEFT JOIN employees ON project_users.employee_id = employees.employee_id
                                LEFT JOIN employee_project_rate ON employee_project_rate.employee_id = employees.employee_id  ORDER BY `client_name` ASC LIMIT 5
                                ";
                                $result = $conn->query($sql);
                                
                                $data = array();
                                
                                if ($result->num_rows > 0) {
                                    $i = 0;
                                    while ($row = $result->fetch_assoc()) {
                                        $i ++;
                                        ?>
                                        <tr>
                                            <!-- <td><?= $i; ?></td> -->
                                            <td><?= $row["client_name"]; ?></td>
                                            <td><?= $row["project_name"]; ?></td>
                                            <td><?= $row["first_name"].' '.$row['last_name']; ?></td>
                                            <!-- <td>R <?= $row["rate"]; ?></td> -->
                                            <!-- <td>
                                                <a href="assign_edit.php?id=<?= $row["id"];?>" class="btn btn-sm btn-primary">Edit</a>
                                                <a href="assign_delete.php?id=<?= $row["id"];?>" class="btn btn-sm btn-danger">Delete</a>
                                            </td> -->
                                        </tr>
                            <?php
                                    }
                                }else{
                                    echo '<tr><td colspan="5">No data..</td></tr>';
                                }
                            ?>
                            <!-- Existing or dynamically populated table rows will go here -->
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
                                 </div>
                             </div>
                            </div>
                            <?php }else{ ?>
                                <div class="card-body">
                                <div class="row my-2">
                                    <h3 class="fs-4 mb-3">Recently Attended Patients</h3>
                                    <div class="col">
                                    <div class="card-body">
                    <?php if(isset($_SESSION["error"]) && $_SESSION["error"] != ""){?>
                        <div class="alert alert-danger">
                            <?= $_SESSION["error"]; ?>
                        </div>
                    <?php
                        $_SESSION["error"] = "";
                    }?>
                    <?php if(isset($_SESSION["success"]) && $_SESSION["success"] != ""){?>
                        <div class="alert alert-success">
                            <?= $_SESSION["success"]; ?>
                        </div>
                    <?php
                        $_SESSION["success"] = "";
                    }?>
                    <div class="card-body table-responsive">
                         <table class="table table-hover">
                <thead>
                    <tr>
                        <!-- <th>ID</th> -->
                        <th>Area</th>
                        <th>Patient</th>
                        <th style="width: 30%;">Description</th>
                        <!-- <th>Rate</th> -->
                        <th>Start</th>
                        <th>End</th>
                        <th>Hours</th>
                        <!-- <th>Actions</th> -->
                    </tr>
                </thead>
                <tbody id="activeTableBody">
                    <?php
                        // $employee_id = $_SESSION["User"]["employee_id"];
                        // $sql = "SELECT * FROM timesheets 
                        // left join employees ON timesheets.employee_id = employees.employee_id
                        // left join tasks ON timesheets.task_id = tasks.task_id
                        // left join projects ON tasks.project_id = projects.project_id
                        // left join project_users ON project_users.project_id = projects.project_id
                        // left join clients ON projects.client_id = clients.client_id
                        // where timesheets.active = '1' AND timesheets.employee_id = '$employee_id' ORDER BY `timesheet_id` DESC LIMIT 5"; // Adjust the SQL query as needed
                        // $result = $conn->query($sql);

                        $employee_id = $_SESSION["User"]["employee_id"];
                        $sql = "SELECT *, COUNT(timesheets.task_id) as count, (SELECT rate FROM project_users WHERE project_id = tasks.project_id AND employee_id = timesheets.employee_id) as rate FROM timesheets 
                        left join employees ON timesheets.employee_id = employees.employee_id
                        left join tasks ON timesheets.task_id = tasks.task_id
                        left join projects ON tasks.project_id = projects.project_id
                        left join clients ON projects.client_id = clients.client_id
                        where timesheets.active = '1' AND timesheets.employee_id = '$employee_id'
                        GROUP BY task_name"; // Adjust the SQL query as needed
                        $result = $conn->query($sql);
                        
                        
                        $data = array();
                        
                        if ($result->num_rows > 0) {
                            $i = 0;
                            while ($row = $result->fetch_assoc()) {
                                $i ++;
                                ?>
                                <tr>
                                    <!-- <td><?= $i; ?></td> -->
                                    <td><?= $row["client_name"]; ?></td>
                                    <td><?= $row["project_name"]; ?></td>
                                    <td style="width: 30%;"><?= $row["task_name"]; ?></td>
                                    <!-- <td>R <?= $row["rate"]; ?></td> -->
                                    <td><?= $row["start"]; ?></td>
                                    <td><?= $row["end"]; ?></td>
                                    <td><?= $row["hours"]; ?></td>
                                    <!-- <td>
                                        <a href="task_edit.php?id=<?= $row["task_id"];?>" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="task_delete.php?id=<?= $row["task_id"];?>" class="btn btn-sm btn-danger">Delete</a>
                                    </td> -->
                                </tr>
                    <?php
                            }
                        }else{
                            echo '<tr><td colspan="5">No data..</td></tr>';
                        }
                    ?>
                    <!-- Existing or dynamically populated table rows will go here -->
                </tbody>
                         </table>
                    </div>
                </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                </div>
                
            </div>
        </div>
    </div>
    
    <?php require('includes/footer.php');?>
    <script src="script.js"></script>
</body>
</html>


<?php

function get_employees(){
    global $conn;

    $sql = "SELECT * FROM employees "; 
    $result = $conn->query($sql);
                        
    return $result->num_rows;
}

function get_clients(){
    global $conn;

    $sql = "SELECT * FROM clients "; 
    $result = $conn->query($sql);
                        
    return $result->num_rows;
}

function get_projects(){
    global $conn;

    $sql = "SELECT * FROM projects "; 
    $result = $conn->query($sql);
                        
    return $result->num_rows;
}
function get_outbreaks(){
    global $conn;
    $sql = "SELECT * FROM projects
    left join diseases ON projects.disease_id = diseases.disease_id
    WHERE diseases.disease_id = 2 "; 
    $result = $conn->query($sql);
                        
    return $result->num_rows;
}
function get_completed(){
    global $conn;
    $sql = "SELECT * FROM projects
    left join status ON projects.status_id = status.status_id
    WHERE status.status_id = 3 "; 
    $result = $conn->query($sql);
                        
    return $result->num_rows;
}
function get_hours(){
    global $conn;
    $zero = 0;
    if($_SESSION["User"]["is_admin"]){
        $sql = "SELECT SUM(`hours`) as `hours` FROM timesheets
            WHERE timesheets.active = 1 ";
    }else{
        $sql = "SELECT SUM(`hours`) as `hours` FROM timesheets
            WHERE employee_id = '".$_SESSION["User"]["employee_id"]."' AND timesheets.active = 1  "; 
    }
    
    $result = $conn->query($sql);
                        
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row["hours"];
    }else{
        return 0;
       
    }
}
function get_assignedProjects(){
    global $conn;

    $sql = "SELECT * FROM projects 
    WHERE project_id 
    IN (SELECT p.project_id FROM project_users p 
        WHERE p.project_id = projects.project_id 
        AND p.employee_id = '".$_SESSION["User"]["employee_id"]."') "; 
    $result = $conn->query($sql);
                        
    return $result->num_rows;
}

function get_recents(){
    global $conn;

    $sql = "SELECT * FROM projects 
    WHERE project_id 
    IN (SELECT p.project_id FROM project_users p 
        WHERE p.project_id = projects.project_id 
        AND p.employee_id = '".$_SESSION["User"]["employee_id"]."') "; 
    $result = $conn->query($sql);
                        
    return $result->num_rows;
}


function get_tasks(){
    global $conn;

    if($_SESSION["User"]["is_admin"]){
        $sql = "SELECT * FROM tasks
        LEFT JOIN projects ON tasks.project_id = projects.project_id
        LEFT JOIN timesheets ON timesheets.task_id = tasks.task_id
        WHERE timesheets.active = 1 "; 
    }else{
        $sql = "SELECT * FROM tasks
        LEFT JOIN projects ON tasks.project_id = projects.project_id
        LEFT JOIN timesheets ON timesheets.task_id = tasks.task_id
        WHERE timesheets.employee_id = '".$_SESSION["User"]["employee_id"]."' AND timesheets.active = 1 "; 
    }
    
    $result = $conn->query($sql);
                        
    return $result->num_rows;
}

