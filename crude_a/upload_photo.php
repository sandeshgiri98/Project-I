<?php
 include_once('../register/connection.php');
 $selectQuery = "SELECT profile_pic FROM register ";
 $selectExe = mysqli_query($con, $selectQuery);
?>
<?php
    while ($row = mysqli_fetch_assoc($selectExe)) {
    $img = $row['image'];
    ?>
<td>
    <?php echo "<img src='../photoes/$img' alt='' height='auto'>";
    ?>
</td>
<td><button type="button" disabled>Status</button></td>

<?php
    }
 ?>
