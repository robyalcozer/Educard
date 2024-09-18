<!-- for implementing data from dbms 

<?php
$query = "SELECT * FROM subjects WHERE id=2";
$result = executeQuery($query);

while ($row = mysqli_fetch_assoc($result)) {
    ?>

<div class="box" style="background-color:#D4FF9C;">
    <h2 style="padding: 5px 20px;"><?php echo $row["subject_name"]; ?></h2>
    <img src="<?php echo $row["image"]; ?>" style="height: 80px; width: 60px; float: right; padding: 0 12px 20px; margin-top: -22px;">
</div>

<?php
}
?> -->