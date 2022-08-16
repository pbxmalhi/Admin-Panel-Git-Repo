<?php
include("classFunction.php");
$ob = new adminPanel();
if (isset($_REQUEST['save'])) {
    $ob->changePassword($_POST);
}

?>



<html>

<head>
    <title>Admin panel</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/color.css">
    <script src="js/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '.tinymce'
        });
    </script>
</head>

<body>
    <?php
    include("header.php");
    ?>
    </div>
    <div class="col-md-12" style="background:#1C5978">
        <div class="container">
            <div class="col-md-3">
                <p style="color:white; font-weight:bold; font-family:arial; font-size:12px; margin:7px 0px; float:left; letter-spacing:1; word-spacing:3"><?php echo date('l, d-m-y') ?></p>
            </div>
        </div>
    </div>
    <aside>
        <div class="container ">
            <?php
            include("sidemenu.php")
            ?>
            <div class="col-md-10 main-section">
                <section>
                    <h3 style="font-size:16px; font-weight:bold; color:#1C5978; text-align:left;margin-left:0px;">Page Manager</h3>
                    <hr style="margin:0px; width:600px; margin-bottom:10px" />
                    <!--font: font-style font-variant font-weight font-size/line-height font-family -->
                    <div style=" background:#F3F1F1;border:1px solid silver; font: bold 13px/13px arial ;padding:5px 0px 5px 15px ">Add Page</div>
                    <div>
                        <form method="post">
                            <table class="addpage-table">
                                <tr>
                                    <td style="width:250px; text-align:right">Enter User Name<span style="color:red">*</span></td>
                                    <td>
                                        <input type="text" name="username" style="width:200px">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:250px; text-align:right">Enter Old Password<span style="color:red">*</span></td>
                                    <td>
                                        <input type="password" name="oldpass" style="width:200px">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:250px; text-align:right">Enter New Password<span style="color:red">*</span></td>
                                    <td>
                                        <input type="password" name="newpass" style="width:200px">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:250px; text-align:right">Confirm New Password<span style="color:red">*</span></td>
                                    <td>
                                        <input type="text" name="confirmpass" style="width:200px">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div style="padding-left:25%"><input type="submit" value="Save" name="save" class="savebtn">
                                            &nbsp;&nbsp;
                                            <a href="./changepassword.php" class="cnclbtn">Cancel</a>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </section>

            </div>
    </aside>
    <div class="footer-line" style="margin-top:15px">
        <footer></footer>
    </div>

</body>

</html>