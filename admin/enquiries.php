<?php include('includes/header.php'); ?>

 <h1>Enquiries</h1>

<?php
include('../includes/dbConnect.php');

$query = $conn->prepare("SELECT
enquiry.id enquiryid,
enquiry.name enquiryname,
enquiry.email enquiryemail,
enquiry.created_at received,
activity.name activityname,
response.id responseid
FROM enquiry LEFT JOIN response ON response.enquiry = enquiry.id
LEFT JOIN activity ON activity.id = enquiry.activity;");

$query->execute();
$count = $query->rowCount();

if($count > 0) {
    ?>

    <p>Below are a list of enquiries</p>
<!--TODO: MAKE TABLES REPONSIVE-->
    <table class="table">
        <thead>
        <tr>
            <th># Enquiry Ref</th>
            <th>Name</th>
            <th class="sm-hide">Date Submitted</th>
            <th class="hide">Activity</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
    <?php

    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach($results as $row){
    ?>
            <tr>
                <td>#<?php echo $row['enquiryid'];?></td>
                <td><strong><?php echo $row['enquiryname'];?></strong><br><em><a href="mailto:<?php echo $row['email'];?>"><?php echo $row['enquiryemail'];?></a></em></td>
                <td class="sm-hide"><i class="fa fa-calendar"></i> <?php echo $row['received'];?></td>
                <td class="hide"><strong><?php echo $row['activityname'];?></strong></td>
                <td>
                    <a href="view-enquiry.php?id=<?php echo $row['enquiryid'];?>" title="View Enquiry" class="table__button<?php echo ($row['responseid']==NULL ? " remove" : "");?>"><i class="fa fa-envelope<?php echo ($row['responseid']==NULL ? "" : "-open");?>"></i> <span>Read</span></a>
                    <a href="#<?php echo $row['enquiryid'];?>" title="Reply to Enquiry" class="table__button"><i class="fa fa-reply"></i> <span>Read</span></a>
                    <a href="#<?php echo $row['enquiryid'];?>" title="Delete Enquiry" class="table__button remove"><i class="fa fa-trash"></i> <span>Read</span></a>
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

