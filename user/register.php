<?php
$dss = new mysqli("localhost", "root", "rootadmin", "DSS");
$uid = $dss->query("SELECT * FROM `DSS_user`")->num_rows+1;
$sql = "INSERT INTO `DSS_user` (`username`, `password`, `nickname`) VALUES ('" . $_POST["name"] . "', '" . $_POST["pass"] . "', 'guest" . $uid . "')";
$dss->query($sql);
session_start();
$_SESSION["id"] = $uid;
$_SESSION["user"] = "guest" . $uid;
?>
<script type="text/javascript">
    history.go(-1);
</script>
