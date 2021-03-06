<?php

include('includes/dbConnect.php');

$query = $conn->prepare("SELECT id, name FROM activity ORDER BY name ASC;");
$query->execute();
$navactivities = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<ul class="nav__menu open">
    <li><a href="/">Home</a></li>
    <li><a href="about-us.php">About Us</a></li>
    <li><a href="/facilities.php">Facilities</a>
        <ul class="nav__submenu">
            <li><a href="/equipment-hire.php">Equipment Hire</a></li>

        </ul>
    </li>
    <li><a href="activity.php">Activities</a>
        <ul class="nav__submenu">
            <?php
            foreach($navactivities as $activity) {
                ?>
                <li><a href="/activity-page.php?activity=<?php echo $activity['id'];?>"><img src="/img/activities/<?php echo str_replace(' ','-',strtolower($activity['name']));?>-thumb.jpg"
                                                                 alt="Placeholder"><?php echo $activity['name'];?></a></li>
                <?php
            }
            ?>
        </ul>
    </li>
    <li><a href="contact.php">Contact Us</a></li>
</ul>