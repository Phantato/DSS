<?php
session_start();
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>DSS</title>
        <script type="text/javascript">
            function userop(url)
            {
                    form=document.getElementsByClassName('userop')[0];
                    form.action=url;
                    form.submit();
            }
        </script>
    </head>
    <body>
<?php
if(isset($_SESSION["id"]))
{
    echo "<p>Welcom, " . $_SESSION["user"] . "</p>";
?>
<button type="button" name="tree" onclick="javascript:window.location.href='./tree/index.php'">tree</button>
<button type="button" name="logout" onclick="javascript:window.location.href='./user/logout.php'">logout</button>
<?php
}
else
{
?>
        <form class="userop" action="" method="post">
            <input type="text" name="name" value="" placeholder="username" />
            <input type="password" name="pass" value="" placeholder="password" />
            <input type="button" name="login" value="login" onclick="javascript:userop('user/login.php')">
            <input type="button" name="register" value="register" onclick="javascript:userop('user/register.php')">
        </form>

<?php
}
?>
    </body>
</html>
