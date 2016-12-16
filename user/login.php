<?php
$dss = new mysqli("localhost", "root", "rootadmin", "DSS");
$sql = "SELECT * FROM `DSS_user` WHERE `username`='" . $_POST["name"] . "';";
$res = $dss->query($sql)->fetch_assoc();
if($res["password"] == $_POST["pass"])
{
    session_start();
    $_SESSION["id"] = $res["uid"];
    $_SESSION["user"] = $res["nickname"];
}
?>
<script type="text/javascript">
    window.location.href="/DSS/"
</script>
