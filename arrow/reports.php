<?php
require_once '../admin/config.php';
login_required();
if($_SESSION['reports'] == 0) {
        header('location: index.php');
} ?>

<?php include 'header.php'; ?>

    <!-- MAIN CONTENT -->
<div class="wrapper">
    <div class="inner-dot-separator margin20"></div>
        <div class="one-third">
            
            <h4><a href="contact_report.php" title="Click here to download this excel report">Contacts Report</a></h4>
            <p>This reports provides a list of all contacts, ordered by contact surname, then partner name. Information includes contact firstname and surname, job title, and contact information. Notes are also provided in a seperate column.</p>
        </div>
        <div class="one-third">
            <h4>Example Report</h4>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
        </div>
        <div class="one-third">
            <h4>Example Report</h4>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.</p>
        </div>
            <div class="clear"></div>
    <div class="inner-dot-separator margin20"></div>
</div>

