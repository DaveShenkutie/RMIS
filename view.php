<?php
// Check if user has requested to get detail
if (isset($_POST["get_data"])) {
    // Get the ID of customer user has selected
    $id = $_POST["id"];

    // Connecting with database

    include('include/connect_db.php');


    // Getting specific customer's detail
    $sql = "SELECT * FROM inquiry WHERE id='$id'";
    $result = $con->query("$sql") or die(mysqli_connect_error());
    $row = $result->fetch();

    // Important to echo the record in JSON format
    echo json_encode($row);

    // Important to stop further executing the script on AJAX by following line
    exit();
}
?>

<?php
// Connecting with database and executing query
include('include/connect_db.php');
$sql = "SELECT * FROM inquiry";
$result = $con->query("$sql") or die(mysqli_connect_error());
?>

<!-- Include bootstrap & jQuery -->
<link rel="stylesheet" href="assets/bootstrap.css" />
<script src="assets/jquery-3.3.1.min.js"></script>
<script src="assets/bootstrap.js"></script>

<!-- Creating table heading -->
<div class="container">
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Subject</th>
            <th>Email</th>
        </tr>

        <!-- Display dynamic records from database -->
        <?php while ( $row = $result->fetch()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['subject'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <!--Button to display details -->
                <td>
                    <button class="btn btn-primary" onclick="loadData(this.getAttribute('data-id'));" data-id="<?php echo $row['id']; ?>">
                        Details
                    </button>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<script>
    function loadData(id) {
        console.log(id);
        $.ajax({
            url: "view.php",
            method: "POST",
            data: {
                get_data: 1,
                id: id
            },
            success: function(response) {
                response = JSON.parse(response);
                console.log(response);
                var html = "";

                // Displaying city
                html += "<div class='row'>";
                html += "<div class='col-md-6'>Message</div>";
                html += "<div class='col-md-6'>" + response.message + "</div>";
                html += "</div>";

                // And now assign this HTML layout in pop-up body
                $("#modal-body").html(html);

                $("#myModal").modal();
            }
        });
    }
</script>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">
                    Customer Detail
                </h4>

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ??
                </button>
            </div>

            <div id="modal-body">
                Press ESC button to exit.
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    OK
                </button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

</div><!-- /.modal -->