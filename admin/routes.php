<?php
include("includes/secure.php");
include('includes/header.php'); ?>



 <h1>Enquiries</h1>

<p><a href="/admin/geo-json-importer.php" class="btn btn-small"><i class="fa fa-upload"></i> Import Geo jSon</a><br><strong style="color:red;">Testing Only:</strong> Please do not use this. It's a function I wrote for importing geoJson into categories in the DB.</p>

<?php
include('../includes/dbConnect.php');

$query = $conn->prepare("SELECT route.id routeid, route.name routename, route.enabled enabled, activity.name activityname FROM route LEFT JOIN activity ON route.activity = activity.id");

$query->execute();
$count = $query->rowCount();


if($count > 0) {
    ?>

    <p>Below are a list of enquiries</p>
    <table class="table">
        <thead>
        <tr>
            <th># Route ID</th>
            <th>Enabled</th>
            <th>Name</th>
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
                <td>#<?php echo $row['routeid'];?></td>
                <td><?php echo $row['enabled'];?></td>
                <td><strong><?php echo $row['routename'];?></strong><br></td>
                <td class="hide"><strong><?php echo $row['activityname'];?></strong></td>
                <td>
                    <a href="route-edit.php?id=<?php echo $row['routeid'];?>" title="View Enquiry" class="table__button"><i class="fa fa-pencil"></i> <span>Read</span></a>
<!--                    <a href="#--><?php //echo $row['enquiryid'];?><!--" title="Reply to Enquiry" class="table__button"><i class="fa fa-reply"></i> <span>Read</span></a>-->
                    <a href="javascript:alert('ToDo');" title="Delete Enquiry" class="table__button remove"><i class="fa fa-trash"></i> <span>Read</span></a>
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


include('includes/footer.php'); ?>

