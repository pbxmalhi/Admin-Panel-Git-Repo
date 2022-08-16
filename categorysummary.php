<?php

// $connect = mysqli_connect("localhost", "root", "", "adminpanel") or die("Connection Failed");

include("classFunction.php");
$ob = new adminPanel();
if (isset($_REQUEST['delete'])) {
    $ob->deleteCatData($_POST);
}
if (isset($_REQUEST['srch'])) {
    $ob->searchData($_POST);
}

?>


<html>

<head>
    <title>Admin panel</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/color.css">
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
                    <h3 style="font-size:16px; font-weight:bold; color:#1C5978; text-align:left;margin-left:0px;">Category Manager</h3>
                    <hr style="margin:0px; width:600px; margin-bottom:10px" />
                    <p class="text-left">This section displays the list of Categories.</p>
                    <p class="bordered text-center" style="padding:3px"><a href="#" style="text-decoration:underline; color:blue; font-size:12px">Click here</a>
                        to create
                        <a href="./addcategory.php" style="text-decoration:underline; color:blue; font-size:12px">New Category</a>
                    </p>
                    <form method="post">
                        <table class="table1">
                            <tr class="table-1-head">
                                <td colspan="2" style="padding:8px 15px 8px 15px; background:#EBEBEB;border-bottom:1px solid">Search</td>
                            </tr>
                            <tr class="table-1-row">
                                <td style="padding:8px 15px 8px 15px">Search By Category Name</td>
                                <td><input type="text" style="height:20px; width:180px" name="catname"></td>

                            </tr>
                            <tr>
                                <td style="padding:8px 15px 8px 15px; width:250px">Search By Parent Category</td>
                                <td>
                                    <select style="width:180px">
                                        <option>
                                            < Select option>
                                        </option>
                                        <option>Login</option>
                                        <option>Index</option>
                                    </select>
                                    <input type="submit" class="srchbtn" style="margin-left:10px" name="catsrch" value="Search">
                                    <input type="submit" class="srchbtn" style="margin-left:10px" name="showall" value="Show ALL">
                                </td>
                            </tr>
                        </table>
                    </form>
                    <p style="padding-top:20px">Page 1 of 2, showing 10 records out of 13 total, starting on record 1, ending on 10</p>
                    <form method="post">
                        <table class="table2">
                            <thead>
                                <tr>
                                    <th style="width:50px">Sr. No</th>
                                    <th>Category Name</th>
                                    <th>Edit</th>
                                    <th style="width:100px">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $index = 1;
                                if (isset($_REQUEST['catsrch'])) {
                                    $datas = $ob->searchCatData($_POST);
                                } else {
                                    $datas = $ob->displayCatData();
                                }
                                foreach ($datas as $data) {

                                ?>


                                    <tr>
                                        <td><?php echo $index ?></td>
                                        <td><?php echo $data['categoryname'] ?></td>
                                        <td><a href="./addcategory.php?eid=<?php echo $data['id'] ?>"><img src="./Images/edit.jpg"></a></td>
                                        <td><input type="checkbox" name="deleteBox[]" value="<?php echo $data['id'] ?>"></td>
                                    </tr>
                                <?php
                                    $index++;
                                }
                                ?>
                                <tr>
                                    <td colspan="6" style="text-align: right; padding: 8px 8px;">

                                        <input type="submit" value="Delete" name="delete" class="srchbtn">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </section>

            </div>
    </aside>
    <div class="footer-line">
        <footer></footer>
    </div>

</body>

</html>