<?php
class adminPanel
{
    private $servername = "localhost";
    private $username = "root";
    private $userpass = "";
    private $database = "adminpanel";
    private $connect;


    // **************Default calling database connection function**************
    public function __construct()
    {
        $this->connect = new mysqli($this->servername, $this->username, $this->userpass, $this->database);
        if (mysqli_connect_error()) {
            echo "Connection Failed";
        } else {
            return $this->connect;
        }
    }




    //*****************************************LOGIN AREA*****************************************

    // ********************Function to check login authentication********************
    public function auth()
    {
        $username = $this->connect->real_escape_string($_POST['username']);
        $password = $this->connect->real_escape_string($_POST['userpass']);
        $query = "select * from login where username='$username' and password='$password'";
        $result = $this->connect->query($query);
        if ($result->num_rows > 0) {
            header("location:pagesummary.php");  // If we add whitespace after and before : then it will throw an error
        } else {
            echo "Authentication Failed";
        }
        exit;
    }







    //*****************************************PAGE AREA*****************************************
    // *******************Function to insert data and update data in database*******************
    public function insertData($post)
    {
        $name = $this->connect->real_escape_string($_POST['name']);
        $content = $this->connect->real_escape_string($_POST['content']);
        if (isset($_POST['status'])) {
            $statusCheck = $_POST['status'];
            if ($statusCheck == 'on') {
                $status = 1;
            }
        } else {

            $status = 0;
        }
        if (!empty($_REQUEST['editid'])) {
            $id = $_REQUEST['editid'];
            $query = "update page set name = '$name', content = '$content', status = '$status' where id = '$id'";
            $result = $this->connect->query($query);
            if ($result == true) {
                header("location:pagesummary.php");
            } else {
                echo "There is an error in the code";
            }
        } else {
            $query = "insert into page (name, content, status) values('$name', '$content', $status)";
            $result = $this->connect->query($query);
            if ($result == true) {
                header("location:addpage.php");
            } else {
                echo "There is an error in the code";
            }
        }
    }


    //***********************Display data in table from database***********************
    public function displayData()
    {
        $query = "select * from page";
        $result = $this->connect->query($query);
        if ($result->num_rows > 0) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            echo "There is an error in the code";
        }
    }


    // **********************Deleting data from database in pagesummary file**********************
    public function deleteData($post)
    {
        $checked = $_POST['deleteBox'];
        for ($i = 0; $i < count($checked); $i++) {
            $deleteId = $checked[$i];
            $query = "delete from page where id = $deleteId";
            $result = $this->connect->query($query);
            if ($result == true) {
                header("location:pagesummary.php");
            } else {
                echo "There is an error in the code";
            }
        }
    }


    //***************************Searching data from the database***************************
    public function searchData($post)
    {
        $name = $this->connect->real_escape_string($_POST['pagename']);
        $query = "select * from page where name like '%$name%'";
        $result = $this->connect->query($query);
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            echo "<h3>Page Not Found!</h3>";
            $query = "select * from page";
            $result = $this->connect->query($query);
            if ($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data;
            } else {
                echo "There is an error in the code";
            }
        }
    }


    // ********************Showing editable data in feilds the data in the database********************
    public function editData($id)
    {
        $query = "select * from page where id = $id";
        $result = $this->connect->query($query);
        if ($result == true) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            echo "There is an error in the code";
        }
    }








    //********************************************CATEGORY AREA********************************************

    //***********************Adding Category into the database and updating data***********************
    public function insertCategory($post)
    {
        $cname = $this->connect->real_escape_string($_POST['catname']);
        if (!empty($_REQUEST['editid'])) {
            $id = $_REQUEST['editid'];
            $query = "update category set categoryname='$cname' where id=$id";
            $result = $this->connect->query($query);
            if ($result == true) {
                header("Location:categorysummary.php");
            } else {
                echo "There is an error in the code";
            }
        } else {
            $query = "insert into category (categoryname) values('$cname')";
            $result = $this->connect->query($query);
            if ($result == true) {
                header("Location:addcategory.php");
            } else {
                echo "There is an error in the code";
            }
        }
    }

    // *****************Showing editable category data in feilds the data in the database*****************
    public function editcatData($id)
    {
        $query = "select * from category where id = $id";
        $result = $this->connect->query($query);
        if ($result == true) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            echo "There is an error in the code";
        }
    }

    //*****************************Display data in table from database*****************************
    public function displayCatData()
    {
        $query = "select * from category";
        $result = $this->connect->query($query);
        if ($result->num_rows > 0) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            echo "There is an error in the code";
        }
    }


    //*******************************Searching data from the database*******************************
    public function searchCatData($post)
    {
        $name = $this->connect->real_escape_string($_POST['catname']);
        $query = "select * from category where categoryname like '%$name%'";
        $result = $this->connect->query($query);
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            echo "<h3>Category Not Found!</h3>";
            $query = "select * from category";
            $result = $this->connect->query($query);
            if ($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data;
            } else {
                echo "There is an error in the code";
            }
        }
    }


    // **********************Deleting data from database in categorysummary file**********************
    public function deleteCatData($post)
    {
        $checked = $_POST['deleteBox'];
        for ($i = 0; $i < count($checked); $i++) {
            $deleteId = $checked[$i];
            $query = "delete from category where id = $deleteId";
            $result = $this->connect->query($query);
            if ($result == true) {
                header("location:categorysummary.php");
            } else {
                echo "There is an error in the code";
            }
        }
    }








    // ********************************************PRODUCT AREA********************************************

    //*************************Category Fetch for product category*************************
    public function fetchCategory()
    {
        $query = "select categoryname from category";
        $result = $this->connect->query($query);
        if ($result->num_rows > 0) {
            $catData = array();
            while ($row = $result->fetch_assoc()) {
                $catData[] = $row;
            }
            return $catData;
        } else {
            echo "There is an error in the code";
        }
    }


    //****************Insert product data into product database and update data in database****************
    public function productInsert()
    {
        $category = $this->connect->real_escape_string($_POST['category']);
        $getcategoryid = "select id from category where categoryname = '$category'";
        $categoryidresult = $this->connect->query($getcategoryid);
        $categoryidfetch = $categoryidresult->fetch_assoc();
        $categoryid = $categoryidfetch['id'];
        $name = $this->connect->real_escape_string($_POST['pname']);
        $description = $this->connect->real_escape_string($_POST['pdesc']);
        $price = $this->connect->real_escape_string($_POST['pprice']);
        $filename = $_FILES['filename']['name'];
        $filepath = $_FILES['filename']['tmp_name'];
        $getextension = explode(".", $filename);
        $extension = $getextension[1];
        $query = "show table status like 'product'";
        $result = $this->connect->query($query);
        $row = $result->fetch_assoc();
        if (!empty($_REQUEST['editid'])) {
            $id = $_REQUEST['editid'];
            $newfilename = $id . "." . "$extension";
            $query = "select productimage from product where id = $id";
            $result = $this->connect->query($query);
            $row = $result->fetch_assoc();
            unlink('./upload/' . $row['productimage']);
            $query = "update product set category_id = $categoryid, productname = '$name', productdesc = '$description', productprice = '$price', productimage = '$newfilename' where id = $id";
            $result = $this->connect->query($query);
            if ($result == true) {
                move_uploaded_file($filepath, "./upload/" . $newfilename);
                header("Location:productsummary.php");
            } else {
                echo "There is an error in the code";
            }
            clearstatcache();
            exit;
        } else {
            echo "Bi";
            $id = $row['Auto_increment'];
            $newfilename = $id . "." . $extension;
            $query = "insert into product(category_id, productname, productdesc, productprice, productimage) values($categoryid,'$name','$description',$price, '$newfilename')";
            $result = $this->connect->query($query);
            if ($result == true) {
                move_uploaded_file($filepath, "./upload/" . $newfilename);
                header("Location:addproduct.php");
            } else {
                echo "There is an error in the code";
            }
            clearstatcache();
            exit;
        }
    }


    //**********************Display product data from database to webpage**********************
    public function productDisplay()
    {
        //Here in query we are using SQL Joins
        $query = "select p.*, c.categoryname from product p, category c where c.id = p.category_id";
        $result = $this->connect->query($query);
        if ($result->num_rows > 0) {
            $pdata = array();
            while ($row = $result->fetch_assoc()) {
                $pdata[] = $row;
            }
            return $pdata;
        } else {
            echo "There is an error in the code";
        }
    }

    //*************************Display product data in edit feilds*************************
    public function productEdit($id)
    {
        $query = "select * from product where id = $id";
        $result = $this->connect->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            echo "There is an error in the code";
        }
    }

    //********************Function to dispaly category name using category id********************
    public function getcatid($id)
    {
        $query = "select * from product where id = $id";
        $result = $this->connect->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $catid = $row['category_id'];
            $query = "select categoryname from category where id = $catid";
            $result = $this->connect->query($query);
            $getcatid = $result->fetch_assoc();
            $catname = $getcatid['categoryname'];
            return $catname;
        } else {
            echo "There is an error in the code";
        }
    }


    //************************Function to delete multiple entries************************
    public function productDelete($post)
    {
        $checked = $_POST['deleteBox'];
        for ($i = 0; $i < count($checked); $i++) {
            $deleteid = $checked[$i];
            $query = "select productimage from product where id = $deleteid";
            $result = $this->connect->query($query);
            $row = $result->fetch_assoc();
            unlink('./upload/' . $row['productimage']);
            $query = "delete from product where id = $deleteid";
            $result = $this->connect->query($query);
        }
        if ($result == true) {
            header("Location:productsummary.php");
        } else {
            echo "Select atleast 1 particular to delete";
        }
    }


    //*********************Searching product using product name*********************
    public function productSearch()
    {
        $pname = $this->connect->real_escape_string($_REQUEST['pname']);
        $query = "select p.*, c.categoryname from product p, category c where c.id = p.category_id and productname like '%$pname%'";
        $result = $this->connect->query($query);
        if ($result->num_rows > 0) {
            $searchResult = array();
            while ($row = $result->fetch_assoc()) {
                $searchResult[] = $row;
            }
            return $searchResult;
        } else {
            echo "<h3>Product Not Found!</h3>";
            $query = "select p.*, c.categoryname from product p, category c where c.id = p.category_id";
            $result = $this->connect->query($query);
            if ($result->num_rows > 0) {
                $pdata = array();
                while ($row = $result->fetch_assoc()) {
                    $pdata[] = $row;
                }
                return $pdata;
            } else {
                echo "There is an error in the code";
            }
        }
    }






    //*********************************CHANGE PASSWORD AREA*********************************
    //Function to change the passwords of the user
    public function changePassword($post)
    {
        $username = $this->connect->real_escape_string($_REQUEST['username']);
        $oldpassword = $this->connect->real_escape_string($_REQUEST['oldpass']);
        $newpassword = $this->connect->real_escape_string($_REQUEST['newpass']);
        $confirmpassword = $this->connect->real_escape_string($_REQUEST['confirmpass']);
        $query = "select * from login where username = '$username' and  password = '$oldpassword'";
        $result = $this->connect->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id = $row['id'];
            if ($newpassword == $confirmpassword) {
                $query = "update login set password = '$newpassword' where id=$id";
                $result = $this->connect->query($query);
                if ($result == true) {
?>
                    <script>
                        alert("Password Changed Successfully");
                    </script>
                <?php
                } else {
                    echo "There is an error in the code";
                }
            } else {
                ?>
                <script>
                    alert("New Password doesn't matches with Confirm Password");
                </script>
            <?php
            }
        } else {
            ?>
            <script>
                alert("Old Password is wrong.");
            </script>
<?php
        }
    }
}
