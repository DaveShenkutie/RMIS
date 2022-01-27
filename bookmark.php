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
    <title>Bookmarked Properties</title>
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
</head>
<?php

include('include/header.php');
include('include/connect_db.php');
?>

<div class="sub-banner overview-bgi">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>Bookmarks</h1>
            <ul class="breadcrumbs">
                <li><a href="index.php">Home</a></li>
                <li class="active">Bookmarks</li>
            </ul>
        </div>
    </div>
</div>


<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="contact-1 content-area-7">
                <div class="container">
                    <div class="main-title">
                        <h1>Bookmarks</h1>
                        <p>Your List of Bookmarks</p>
                    </div>

                    <div class="container-fluid px-4">
                       
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php"></a></li>
                            
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                Bookmarks are properties that you save into your gallery, you can add properties that you like to bookmarks by pressing the book mark icon for later easy access.
                                <!-- <a target="_blank" href="https://datatables.net/">official DataTables documentation</a> -->
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Bookmarks
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <?php
                                    include 'include/config.php';
                                    $query1 = mysqli_query($con, "select * from users where Email='$email'");
                                    $sales = mysqli_fetch_array($query1);

                                    $u_name = ucfirst($sales['FirstName'])." ".$sales['LastName'];

                                    $bookmarks = mysqli_query($con, "select * from bookmarks where CustMail='$email'");
                                    $i = 0;
                                    while ($bookmark = mysqli_fetch_array($bookmarks)) {
                                        
                                        $id = $bookmark['propertyID'];
                                        $query = mysqli_query($con, "select * from property where id='$id'");
                                        $res = mysqli_fetch_array($query);

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
                                                                <?php echo $res['price']; ?>
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
                                                        <i  onclick="bookmarked(this)" class="fa fa-bookmark"> &nbsp&nbsp Bookmarked  </i> 
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
                                                            <i class="flaticon-square-layouting-with-black-square-in-east-area"></i><?php echo $res['price']; ?>Br./Sqm.
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
                                                        <i class="fa fa-calendar-o"></i><?php echo $bookmark['created']; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php  
                                        }
                                    
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<script>
    function bookmarked(x) 
    {
        x.classList.toggle("fa-bookmark");
        x.classList.toggle("fa-bookmark-o");
        <?php
            $id=$_GET['id'];
            $con->query("DELETE FROM bookmarks WHERE propertyID=$id") ;
        ?> 
    }
</script>
<?php include('include/footer.php'); ?>

<body>

</body>

</html>