<?php

$email = $_SESSION['email'];
$_SESSION['email'] = $email;
include('include/connect_db.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gift - Gallary</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .fa {
            font-size: 50px;
            cursor: pointer;
            user-select: none;
        }

        .fa:hover {
            color: darkblue;
        }
    </style>
<body>
<?php include('include/header.php'); ?>
</body>
</html>



<!-- main header end -->

<!-- Sub banner start -->
<div class="sub-banner overview-bgi">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>Properties Grid</h1>
            <ul class="breadcrumbs">
                <li><a href="index.html">Home</a></li>
                <li class="active">Properties Grid</li>
            </ul>
        </div>
    </div>
</div>
<!-- Sub banner end -->

<!-- Properties list fullwidth start -->
<div class="properties-list-fullwidth content-area-2">
    <div class="container">
        <center>
            <form action="" method="GET" name="">
                <table>
                    <tr>
                        <td><input type="text" name="k" placeholder="Search for something" autocomplete="off"></td>
                        <td><input type="submit" name="" value="Search"></td>
                    </tr>
                </table>
            </form>
        </center>
        <!-- <center>
            <form action="" method="GET" name="">
                <table>
                    <tr>
                        <form class="example" action="/action_page.php" style="margin:auto;max-width:300px">
                            <input type="text" placeholder="Search.." name="search2">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </tr>
                </table>
            </form>
        </center> -->
        <div class="option-bar d-none d-xl-block d-lg-block d-md-block d-sm-block">
            <div class="row clearfix">
                <div class="col-xl-4 col-lg-5 col-md-5 col-sm-5">
                    <h4>
                        <span class="heading-icon">
                            <i class="fa fa-caret-right icon-design"></i>
                            <i class="fa fa-th-large"></i>
                        </span>
                        <span class="heading">Properties Grid</span>
                    </h4>
                </div>
                <div class="col-xl-8 col-lg-7 col-md-7 col-sm-7">
                    <div class="sorting-options clearfix">
                        <a href="properties-list-fullwidth.html" class="change-view-btn"><i class="fa fa-th-list"></i></a>
                        <a href="properties-grid-fullwidth.html" class="change-view-btn active-view-btn"><i class="fa fa-th-large"></i></a>
                    </div>
                    <div class="search-area">
                        <select class="selectpicker search-fields" name="location">
                            <option>High to Low</option>
                            <option>Low to High</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <?php

            // CHECK TO SEE IF THE KEYWORDS WERE PROVIDED
            if (isset($_GET['k']) && $_GET['k'] != '') {

                // save the keywords from the url
                $k = trim($_GET['k']);

                // create a base query and words string
                $query_string = "SELECT * FROM property WHERE ";
                $display_words = "";

                // seperate each of the keywords
                $keywords = explode(' ', $k);
                foreach ($keywords as $word) {
                    $query_string .= " keywords LIKE '%" . $word . "%' OR ";
                    $display_words .= $word . " ";
                }
                $query_string = substr($query_string, 0, strlen($query_string) - 3);

                // connect to the database


                $query = $con->query($query_string);
                $result_count = mysqli_num_rows($query);

                // check to see if any results were returned
                if ($result_count > 0) {

                    // display search result count to user
                    echo '<br /><div class="right"><b><u>' . $result_count . '</u></b> results found</div>';
                    echo 'Your search for <i>' . $display_words . '</i> <hr /><br />';
            ?>
                    <div class="row">
                        <?php
                        include 'include/config.php';
                        
                        $i = 0;
                        // display all the search results to the user
                        while ($res = mysqli_fetch_assoc($query)) {
                            $id = $res['id'];
                            
                            $result = mysqli_query($con, "select * from reservation where propertyId='$id'");
                            $row = mysqli_fetch_array($result);

                            if ($row) {

                                $reservedDate = $row['date'];

                                //Convert the variable date using strtotime and 30 minutes then format it again on the desired date format
                                $add_min = date("Y-m-d H:i:s", strtotime($reservedDate . "+48 hours"));
                                $currentDate = date("Y-m-d H:i:s");

                                if ($currentDate > $add_min) {
                                    goto PropertyDetail;
                                }
                            } else {
                                PropertyDetail:
                                $result = mysqli_query($con, "select * from image where pid='$id'");
                                $row = mysqli_fetch_array($result);
                                $img = $row['link'];

                        ?>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="property-box">
                                        <div class="property-thumbnail">
                                            <a href="properties-details.html" class="property-img">
                                                <div class="tag button alt featured">Featured</div>

                                                <div class="price-ratings-box">
                                                    <p class="price">
                                                        <?php echo number_format($res['price'],2); ?>
                                                    </p>
                                                    <div class="ratings">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                </div>



                                                <?php echo '<img src="assets/img/uploads/' . $img . ' " class="img-fluid" />'; ?>

                                            </a>
                                            <div class="property-overlay">
                                                <a href="properties-details.php?id=<?php echo $id; ?>" class="overlay-link">
                                                    <i class="fa fa-link"></i>
                                                </a>
                                                <a class="overlay-link property-video" title="Test Title">
                                                    <i class="fa fa-video-camera"></i>
                                                </a>
                                                <div class="property-magnify-gallery">
                                                    <a href="assets/img/uploads/<?php echo $img; ?>" class="overlay-link">
                                                        <i class="fa fa-expand"></i>
                                                    </a>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h1 class="title">
                                                <a href="properties-details.php?id=<?php echo $id; ?>"><?php echo $res['property_title']; ?></a>
                                            </h1>
                                            <div class="location">
                                                <a href="properties-details.php?id=<?php echo $id; ?>">
                                                    <i class="fa fa-map-marker"></i>
                                                    <?php echo $res['address']; ?>
                                                </a>
                                            </div>

                                            <a href="?id=<?php echo $id;?>">
                                                <!-- if u change this to  <a href="#?id=<?php echo $id;?>"> notice the # it wont refresh but the id is null -->
                                                <?php
                                                $bookmarks = mysqli_query($con, "select propertyID from bookmarks where propertyID='$id'AND CustMail='$email' ");
                                                if ($bookmared = mysqli_fetch_array($bookmarks)) {   
                                                    ?> 
                                                    <i   class="fa fa-bookmark"> &nbsp&nbsp Bookmarked  </i> 
                                                    <?php 
                                                }
                                                else
                                                {?>
                                                    <i onclick="bookmarked(this)" class="fa fa-bookmark-o"> &nbsp&nbsp Bookmark/Favorite </i> 
                                                <?php  
                                                }   
                                                ?>   
                                            </a>
                                            
                                            <?php
                                            while ($i == 1) {
                                                $con->query("INSERT INTO bookmarks(CustMail,propertyID) VALUES ('$email','$id')");
                                                $i += 1;
                                            }
                                            ?>

                                            <ul class="facilities-list clearfix">
                                                <li>
                                                    <i class="flaticon-bed"></i>
                                                    <?php echo $res['bedroom']; ?> : Bedroom
                                                </li>
                                                <li>
                                                    <i class="flaticon-bath"></i>
                                                    <?php echo $res['hall']; ?> : Hall
                                                </li>
                                                <li>
                                                    <i class="flaticon-square-layouting-with-black-square-in-east-area"></i><?php echo number_format($res['price'],2); ?>Br./Sqm.
                                                </li>
                                                <li>
                                                    <i class="fa fa-coffee"></i>
                                                    <?php echo $res['kitchen']; ?> : kitchen
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="footer">
                                            <a href="#">
                                                <i class="fa fa-user"></i>
                                                <?php echo $u_name; ?>
                                            </a>
                                            <span>
                                                <i class="fa fa-calendar-o"></i><?php echo $res['date']; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                    <?php }
                        }

                        echo '</table>';
                    } else
                        echo 'No results found. Please search something else.';
                } else {
                    ?>
                    <div class="subtitle">
                        <?php
                        $r = $con->query("SELECT * FROM property");
                        $num_rows = mysqli_num_rows($r);
                        echo "$num_rows Properties Found";
                        ?>
                    </div>


                    <div class="row">
                        <?php
                        include 'include/config.php';
                        $query = mysqli_query($con, "select * from property");
                        $i = 0;
                        while ($res = mysqli_fetch_array($query)) {

                            $id = $res['id'];
                            $empId=$res['registeredBy'];
                            $query1 = mysqli_query($con, "select firstName,lastName from employee where empId='$empId'");
                            $sales = mysqli_fetch_array($query1);
                            $u_name = ucfirst($sales['firstName']) . " " . $sales['lastName'];

                            $result = mysqli_query($con, "select * from reservation where propertyId='$id'");
                            $row = mysqli_fetch_array($result);

                            if ($row) {

                                $reservedDate = $row['date'];

                                //Convert the variable date using strtotime and 30 minutes then format it again on the desired date format
                                $add_min = date("Y-m-d H:i:s", strtotime($reservedDate . "+48 hours"));
                                $currentDate = date("Y-m-d H:i:s");

                                if ($currentDate > $add_min) {
                                    goto PropertyDetail2;
                                }
                            } else {
                                PropertyDetail2:
                                $result = mysqli_query($con, "select * from image where pid='$id'");
                                $row = mysqli_fetch_array($result);
                                $img = $row['link'];
                        ?>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="property-box">
                                        <div class="property-thumbnail">
                                            <a href="properties-details.php" class="property-img">
                                                <div class="tag button alt featured">Featured</div>

                                                <div class="price-ratings-box">
                                                    <p class="price">
                                                        <?php echo number_format($res['price'],2); ?>
                                                    </p>
                                                    <div class="ratings">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                </div>
                                                <?php echo '<img src="assets/img/uploads/' . $img . ' " class="img-fluid" />'; ?>
                                            </a>
                                            <div class="property-overlay">
                                                <a href="properties-details.php?id=<?php echo $id; ?>" class="overlay-link">
                                                    <i class="fa fa-link"></i>
                                                </a>
                                                <a class="overlay-link property-video" title="Test Title">
                                                    <i class="fa fa-video-camera"></i>
                                                </a>
                                                <div class="property-magnify-gallery">
                                                    <a href="assets/img/uploads/<?php echo $img; ?>" class="overlay-link">
                                                        <i class="fa fa-expand"></i>
                                                    </a>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h1 class="title">
                                                <a href="properties-details.php?id=<?php echo $id; ?>"><?php echo $res['property_title']; ?></a>
                                            </h1>
                                            <div class="location">
                                                <a href="properties-details.php?id=<?php echo $id; ?>">
                                                    <i class="fa fa-map-marker"></i>
                                                    <?php echo $res['address']; ?>
                                                </a>
                                            </div>
                                            <a href="?id=<?php echo $id;?>">
                                                <!-- if u change this to  <a href="#?id=<?php echo $id;?>"> notice the # it wont refresh but the id is null -->
                                                <?php
                                                $bookmarks = mysqli_query($con, "select propertyID from bookmarks where propertyID='$id'AND CustMail='$email' ");
                                                if ($bookmared = mysqli_fetch_array($bookmarks)) {   
                                                    ?> 
                                                    <i   class="fa fa-bookmark"> &nbsp&nbsp Bookmarked  </i> 
                                                    <?php 
                                                }
                                                else
                                                {?>
                                                    <i onclick="bookmarked(this)" class="fa fa-bookmark-o"> &nbsp&nbsp Bookmark/Favorite </i> 
                                                <?php  
                                                }   
                                                ?>   
                                            </a>

                                            <ul class="facilities-list clearfix">
                                                <li>
                                                    <i class="flaticon-bed"></i>
                                                    <?php echo $res['bedroom']; ?> : Bedroom
                                                </li>
                                                <li>
                                                    <i class="flaticon-bath"></i>
                                                    <?php echo $res['hall']; ?> : Hall
                                                </li>
                                                <li>
                                                    <i class="flaticon-square-layouting-with-black-square-in-east-area"></i><?php echo number_format($res['price'],2); ?>Br./Sqm.
                                                </li>
                                                <li>
                                                    <i class="fa fa-coffee"></i>
                                                    <?php echo $res['kitchen']; ?> : kitchen
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="footer">
                                            <a href="#">
                                                <i class="fa fa-user"></i>
                                                <?php echo $u_name; ?>
                                            </a>
                                            <span>
                                                <i class="fa fa-calendar-o"></i><?php echo $res['date']; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                    <?php
                            }
                        }
                    }
                    
                    ?>
                    
                    <script>
                        function bookmarked(x) 
                        {
                            
                            <?php
                            include 'include/config.php';
                                $id=$_GET['id']; 
                                $bookmarks = mysqli_query($con, "select propertyID from bookmarks where propertyID='$id' ");
                                if ($bookmared = mysqli_fetch_array($bookmarks)) {
                                    //$duplication='<font color="Red"><strong><em>This property is Already Resereved.</em> </strong></font>';
                                    
                                }else
                                {
                                    if($id!=0){
                                        $con->query("INSERT INTO bookmarks(CustMail,propertyID,created) VALUES ('$email','$id',now())") ;
                                    }
                                  
                                } 
                            
                            ?>
                            
                            alert("Bookmarked Successfully.<?php echo $duplication;?>");
                            x.classList.toggle("fa-bookmark-o");
                             x.classList.toggle("fa-bookmark"); 
                        }
                    </script>
                    </div>
                 </div>
        </div>
    </div>
</div>


<!-- Properties list fullwidth end -->
<!-- Property Video Modal -->

<!-- Footer start -->

<?php //include ('include/footer.php');?>  