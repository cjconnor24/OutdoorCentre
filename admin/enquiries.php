<?php include('includes/header.php'); ?>

 <h1>Enquiries</h1>

<?php
include('../includes/dbConnect.php');

$query = $conn->prepare("SELECT enquiry.id, enquiry.name, enquiry.email, enquiry.created_at, activity.name AS activity FROM enquiry LEFT JOIN activity ON enquiry.activity = activity.id");

$query->execute();
$count = $query->rowCount();

if($count > 0) {
    ?>

    <p>Below are a list of enquiries</p>

    <table class="table">
        <thead>
        <tr>
            <th># Enquiry Ref</th>
            <th>Name</th>
            <th>Date Submitted</th>
            <th>Activity</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
    <?php
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach($results as $row){
    ?>
            <tr>
                <td>#<?php echo $row['id'];?></td>
                <td><strong><?php echo $row['name'];?></strong><br><em><a href="mailto:<?php echo $row['email'];?>"><?php echo $row['email'];?></a></em></td>
                <td><i class="fa fa-calendar"></i> <?php echo $row['created_at'];?></td>
                <td><strong><?php echo $row['activity'];?></strong></td>
                <td>
                    <a href="#<?php echo $row['id'];?>" title="View Enquiry" class="table__button"><i class="fa fa-envelope-open"></i> <span>Read</span></a>
                    <a href="#<?php echo $row['id'];?>" title="Reply to Enquiry" class="table__button"><i class="fa fa-reply"></i>
                        <span>Read</span></a>
                    <a href="#<?php echo $row['id'];?>" title="Delete Enquiry" class="table__button remove"><i class="fa fa-trash"></i>
                        <span>Read</span></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <?php
} else {
    ?>
    <p>There are currently no enquiries.</p>
<?php
}
?>

<?php include('includes/footer.php'); ?>

