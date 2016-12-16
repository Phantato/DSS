<?php
$dss = new mysqli("localhost", "root", "rootadmin", "DSS");
if($dss->query("SELECT * FROM `DSS_user` WHERE `username`='" . $_POST["name"] . "';")->fetch_assoc())
{
?>
<script type="text/javascript">
    alert('Username exists!');
</script>
<?php
}
else
{
    $uid = $dss->query("SELECT * FROM `DSS_user`")->num_rows+1;
    $sql = "INSERT INTO `DSS_user` (`username`, `password`, `nickname`) VALUES ('" . $_POST["name"] . "', '" . $_POST["pass"] . "', 'guest" . $uid . "');";
    $dss->query($sql);
    session_start();
    $_SESSION["id"] = $uid;
    $_SESSION["user"] = "guest" . $uid;
}
?>
<script type="text/javascript">
    window.location.href="/DSS/"
</script>
