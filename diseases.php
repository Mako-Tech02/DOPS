<?php
include_once('includes/session.php');
$page_name = "diseases";
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
        $page = 'diseases';
    ?>
    <?php require('includes/header.php'); ?>
    <div class="container" style="padding-top: 80px;">
    <?php require('includes/pwd_check.php');?>

    <div class="container">
        
        
        <div class="card">
            <div class="card-header">
                <h2>List of Diseases</h2>
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
            </div>
            
            <div class="card-body table-responsive">
                <input type="text" id="diseaseSearch" class="form-control" placeholder="Search disease Names">
                <br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Disease</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="activeTableBody">
                        <?php
                            $sql = "SELECT * FROM diseases ORDER BY `disease_name`"; 
                            $result = $conn->query($sql);
                            $data = array();
                            if ($result->num_rows > 0) {
                                $i = 0;
                                while ($row = $result->fetch_assoc()) {
                                    $i ++;
                        ?>
                        <tr>
                            <td><?= $row["disease_name"]; ?></td>
                            <td>
                                <a href="disease_edit.php?id=<?= $row["disease_id"];?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="disease_delete.php?id=<?= $row["disease_id"];?>" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php
                            }
                        } else {
                            echo '<tr><td colspan="5">No data..</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('diseaseSearch').addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('#activeTableBody tr');

        tableRows.forEach(function(row) {
            const clientName = row.querySelector('td:first-child').textContent.toLowerCase();
            if (clientName.includes(searchValue)) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>

<?php require('includes/footer.php'); ?>
</body>
</html>
