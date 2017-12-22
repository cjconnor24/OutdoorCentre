<?php
include("includes/secure.php");
include('includes/header.php'); ?>

 <h1>Enquiries</h1>

<?php
include('../includes/dbConnect.php');

$query = $conn->prepare("SELECT * from newsletter;");

$query->execute();
$count = $query->rowCount();

if($count > 0) {
    ?>

    <p>Below are the current users signed up to the mailing list.</p>

    <a href="/admin/newsletter-download.php" class="btn"><i class="fa fa-download"></i> Export List as CSV</a>

    <table class="table">
        <thead>
        <tr>
            <th class="hide"># User Id</th>
            <th>Email</th>
            <td>Actions</td>
        </tr>
        </thead>
        <tbody>
    <?php
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach($results as $row){
    ?>
            <tr>
                <td class="hide">#<?php echo $row['id'];?></td>
                <td><strong><a href="mailto:<?php echo $row['email'];?>"><?php echo $row['email'];?></a></strong><br><em></a></em></td>
                <td>
                    <a href="mailto:<?php echo $row['email'];?>" title="Email User" class="table__button"><i class="fa fa-envelope"></i>
                        <span>Read</span></a>
                    <a href="#<?php echo $row['id'];?>" title="Remove From Mailing List" class="table__button remove"><i class="fa fa-trash"></i>
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

