<!DOCTYPE html>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>My tree - DSS</title>
    </head>
    <body>

<?php

function showSkills($data)
{
    global $dss;
    $sql = "SELECT `sname`, `contact` FROM `DSS_skills` WHERE `id`=" . $data;
    $skidata = $dss->query($sql)->fetch_assoc();
    echo "<li>" . $skidata["sname"] . "</li>";
    if(isset($skidata["contact"]))
    {
        $iter = -1;
        echo "<ul>";
        do
        {
            $skills= 0;
            $iter++;
            while(isset($skidata["contact"][$iter]) && $skidata["contact"][$iter] > '0' && $skidata["contact"][$iter] < '9')
            {
                $skills *= 10;
                $skills += $skidata["contact"][$iter] - '0';
                $iter++;
            }
            showSkills($skills);
        }
        while(isset($skidata["contact"][$iter]) && $skidata["contact"][$iter] == ',');
        echo "</ul>";
    }
    // do
    // {
    //     $skill= 0;
    //     $iter++;
    //     while(isset($data["contact"][$iter]) && $data["contact"][$iter] > '0' && $data["contact"][$iter] < '9')
    //     {
    //         $skills *= 10;
    //         $skills += $data["contact"][0] - '0';
    //         $iter++;
    //     }
    //     echo "<ul>" .
    // }
    // while(isset($data["dream"][$iter]) && $data["dream"][$iter] == ',');


}

session_start();
if(isset($_SESSION["id"]))
{
    $dss = new mysqli("localhost", "root", "rootadmin", "DSS");
    $dss->set_charset("utf8");
    $sql = "SELECT `skills`, `dream` FROM `DSS_user` WHERE `uid`=" . $_SESSION["id"];
    echo "<p>" . $_SESSION["user"] . ", here are your dreaming careers:</p>";
    $usrdata = $dss->query($sql)->fetch_assoc();

    $iter = -1;
    do
    {
        $iter++;
        $dream[0] = 0;
        $dream[1] = 0;
        while(isset($usrdata["dream"][$iter]) && $usrdata["dream"][$iter] > '0' && $usrdata["dream"][$iter] < '9')
        {
            $dream[0] *= 10;
            $dream[0] += $usrdata["dream"][0] - '0';
            $iter++;
        }
        $iter++;
        while(isset($usrdata["dream"][$iter]) && $usrdata["dream"][$iter] > '0' && $usrdata["dream"][$iter] < '9')
        {
            $dream[1] *= 10;
            $dream[1] += $usrdata["dream"][0] - '0';
            $iter++;
        }
        $sql = "SELECT `dname`, `contact` FROM `DSS_dream` WHERE `dcat`=" . $dream[0] . " AND `did` = " . $dream[1] . ";";
        $dredata = $dss->query($sql)->fetch_assoc();
        echo "<ul><h3>" . $dredata["dname"] . "</h3>    ";
        $jter = -1;
        do
        {
            $skill= 0;
            $jter++;
            while(isset($dredata["contact"][$jter]) && $dredata["contact"][$jter] > '0' && $dredata["contact"][$jter] < '9')
            {
                $skill *= 10;
                $skill += $dredata["contact"][0] - '0';
                $jter++;
            }
            showSkills($skill);
        }
        while(isset($dredata["dream"][$jter]) && $dredata["dream"][$jter] == ',');
        echo "</ul>";
    }
    while(isset($usrdata["dream"][$iter]) && $usrdata["dream"][$iter] == ',');
?>
    <button type="button" name="tree" onclick="javascript:window.location.href='../index.php'">home</button>
<?php
}
else
{
?>
<script type="text/javascript">
    alert('Please login first!');
    window.location.href="/DSS/";
</script>
<?php
}
?>
