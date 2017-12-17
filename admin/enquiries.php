<?php include('includes/header.php'); ?>

 <h1>Enquiries</h1>
<p>Below are a list of enquiries</p>

<table class="table">
        <thead>
        <tr>
                <th># Enquiry Ref</th>
                <th>Name</th>
                <th>Date Submitted</th>
                <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php for($i = 0;$i<300;$i++){?>
        <tr>
                <td>#1234</td>
                <td><strong>Christopher Connor </strong><br><em><a href="#">cjconnor24@hotmail.com</a></em></td>
                <td><i class="fa fa-calendar"></i> 11/12/2017</td>
                <td>
                        <a href="#" title="View Enquiry" class="table__button"><i class="fa fa-envelope-open"></i> <span>Read</span></a>
                        <a href="#"title="Reply to Enquiry" class="table__button"><i class="fa fa-reply"></i> <span>Read</span></a>
                        <a href="#" title="Delete Enquiry" class="table__button"><i class="fa fa-trash"></i> <span>Read</span></a>
                </td>
        </tr>
        <?php } ?>
        </tbody>
</table>

<?php include('includes/footer.php'); ?>

