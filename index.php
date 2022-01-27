<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <?php
    include('include/header.php'); 

    $email = $_SESSION['email'];
    $_SESSION['email'] = $email;
    ?>
    <!-- main header end -->

    <!-- Banner start -->
    <div class="banner banner-bg" id="particles-banner-wrapper">
        <div id="particles-banner"></div>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item item-bg active">
                    <div class="carousel-caption banner-slider-inner d-flex h-100 text-left">
                        <div class="carousel-content container">
                            <div class="t-center">
                                <h2 data-animation="animated fadeInDown delay-01s"> Gift Real Estate </h2>
                                <h2 data-animation="animated fadeInUp delay-10s">
                                    <hr size="10" width="50%" color="white">
                                </h2>
                                <p class="text-p" data-animation="animated fadeInUp delay-05s">
                                    "It takes hands to build a house but only hearts can build a home!"
                                </p>
                                <?php
                                // <a data-animation="animated fadeInUp delay-10s" href="#" class="btn btn-lg btn-theme">Get Started Now</a>
                                // <a data-animation="animated fadeInUp delay-10s" href="#" class="btn btn-lg btn-white-lg-outline">Free Download</a> 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item item-bg">
                    <div class="carousel-caption banner-slider-inner d-flex h-100 text-left">
                        <div class="carousel-content container">
                            <div class="t-right">
                                <h2 data-animation="animated fadeInDown delay-05s">Find Your Dream Properties</h2>
                                <p class="text-p" data-animation="animated fadeInUp delay-05s">
                                    "It takes hands to build a house but only hearts can build a home!"
                                </p>
                                <?php
                                // <a data-animation="animated fadeInUp delay-10s" href="#" class="btn btn-lg btn-theme">Get Started Now</a>
                                // <a data-animation="animated fadeInUp delay-10s" href="#" class="btn btn-lg btn-white-lg-outline">Free Download</a> 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item item-bg">
                    <div class="carousel-caption banner-slider-inner d-flex h-100 text-left">
                        <div class="carousel-content container">
                            <div class="t-left">
                                <h2 data-animation="animated fadeInUp delay-05s">Best Place to Buy Homes</h2>
                                <p class="text-p" data-animation="animated fadeInUp delay-10s">
                                    "It takes hands to build a house but only hearts can build a home!"
                                </p>
                                <?php
                                // <a data-animation="animated fadeInUp delay-10s" href="#" class="btn btn-lg btn-theme">Get Started Now</a>
                                // <a data-animation="animated fadeInUp delay-10s" href="#" class="btn btn-lg btn-white-lg-outline">Free Download</a> 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner end -->
    <!-- getting property detail from db -->
    

    <!-- Featured properties start -->
    <div class="featured-properties content-area-19">
        <div class="container">
            <div class="main-title">
                <h1>Featured Properties</h1>
                <p>It is a great time to acquire a real estate because you can put your money to good value. Here are our current products.</p>
            </div>
            <div class="row">
                <?php
                include 'connect_db.php';
                $result = $con->query("SELECT * FROM property")  or die(mysql_error());
                $i=1;
                while (($row = $result->fetch())&&($i<5)) {
                    $id = $row['id'];
                    ++$i;
                    $result1 = $con->query("SELECT * FROM image where pid=$id")  or die(mysql_error());
                    $row1 = $result1->fetch();
                    $link = $row1['link'];
                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 wow fadeInLeft delay-04s">
                        <div class="card property-box-2">
                            <div class="property-thumbnail">
                                <a href="properties.php" class="property-img">
                                    <?php echo '<img src="assets/img/uploads/' . $link . ' " class="img-fluid" />'; ?>

                                </a>
                                <div class="property-overlay">
                                    <a href="properties.php" class="overlay-link">
                                        <i class="fa fa-link"></i>
                                    </a>
                                    <a class="overlay-link property-video" title="detail view">
                                        <i class="fa fa-video-camera"></i>
                                    </a>
                                    <div class="property-magnify-gallery">
                                        <a href="assets/img/uploads/<?php echo $link; ?>" class="overlay-link">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                        <a href="assets/img/uploads/<?php echo $link; ?>" class="hidden"></a>
                                        <a href="assets/img/uploads/<?php echo $link; ?>" class="hidden"></a>
                                    </div>
                                </div>
                            </div>
                            <!-- detail -->
                            <div class="detail">
                                <h5 class="title"><a href="properties.php"><?php echo $row['property_title'] ?></a></h5>
                                
                                <h4 class="price">
                                  Birr  <?php echo  number_format($row['price'],2); ?> <br>
                                    
                                </h4>
                                <div class="location">
                                    <a href="properties.php">
                                        <i class="flaticon-facebook-placeholder-for-locate-places-on-maps"></i><?php echo $row['address']; ?>
                                    </a>
                                </div>
                                <p><?php echo $row['description'] ?>
                            </div>
                                
                        </div>
                    </div>
                <?php
                }
                ?>
                
                
            </div>
        </div>
    </div>
    <!-- Featured properties end -->


    <!-- Recent Properties start -->
    <div class="recent-properties content-area-2">
        <div class="container">
            <div class="main-title">
                <h1>Recent Properties</h1>
                <p>Quality is never an accident; it is always the result of high intention, sincere effort, intelligent direction and skillful execution;</p>
            </div>

            <div class="row">
            <?php
            include 'include/config.php';
            $query = mysqli_query($con, "SELECT * FROM property ORDER BY date DESC");
            $i = 1;
            while (($res = mysqli_fetch_array($query))&&($i<5)) {
                $id = $res['id'];
                ++$i;
                $result = mysqli_query($con, "select * from image where pid='$id'");
                $row = mysqli_fetch_array($result);
                $img = $row['link'];
            ?>  
                <div class="col-lg-3 col-md-6 col-sm-6 wow fadeInLeft delay-04s">
                    <div class="property-box-8">
                        <div class="property-photo">
                            <img src="assets/img/uploads/<?php echo $img; ?>" alt="property-6" class="img-fluid">
                            <div class="date-box">buy/rent</div>
                        </div>
                        <div class="detail">
                            <div class="heading">
                                <h6>posted on:</h6>
                                <p>
                                    <a href="properties.php">
                                    <?php 
                                    $date=$res['date'];
                                    $newDate = date("F j, Y, g:i a", strtotime($date)); 
                                    echo $newDate; ?></a>
                                </p>
                                <div class="location">
                                    <a href="properties.php">
                                        <i class="flaticon-facebook-placeholder-for-locate-places-on-maps"></i><?php echo $res['address']; ?>
                                    </a>
                                </div>
                            </div>
                            <div class="properties-listing">
                                <span><?php echo $res['bedroom']; ?> Beds</span>
                                <span><?php echo $res['kitchen']; ?> kitchen</span>
                                <span><?php echo $res['land_area'] ; ?> sqm</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>
            </div>
        </div>
    </div>
    <!-- Recent Properties end -->
    <!-- Testimonial 2 start -->
    <div class="testimonial-2 overview-bgi" style="background-image: url(assets/img/testimonial-property.jpg)">
        <div class="container">
            <div class="row">
                <div class="offset-lg-2 col-lg-8">
                    <div class="testimonial-inner">
                        <header class="testimonia-header">
                            <h1>Testimonial</h1>
                        </header>
                        <div id="carouselExampleIndicators7" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="avatar">
                                                <img src="assets/img/avatar/avatar-2.jpg" alt="avatar-2" class="img-fluid rounded">
                                            </div>
                                        </div>
                                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                            <p class="lead">
                                                Gift Real Estate was a joy to work with! they took time to introduce us to the market and then showed us lots of houses so we had great choices to work with. Gift also understood and worked with our time frame, responding quickly to all queries. Our experience was great from start to finish, thanks to the Gift Team. We highly recommend them!!
                                            </p>
                                            <div class="author-name">
                                                Adonias Nigussie
                                            </div>
                                            <ul class="rating">
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star-half-full"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="avatar">
                                                <img src="assets/img/avatar/avatar.jpg" alt="avatar" class="img-fluid rounded">
                                            </div>
                                        </div>
                                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                            <p class="lead">
                                                I recently bought a house from gift real estate and while this can be a very stressful process, I felt 110% confident by partnering with gift. They were candid, provided great feedback, helped explain clearly all details and managed the actual sale negotiation brilliantly.
                                            <div class="author-name">
                                                Abel Moges
                                            </div>
                                            <ul class="rating">
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star-half-full"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="avatar">
                                                <img src="assets/img/avatar/avatar-3.jpg" alt="avatar-3" class="img-fluid rounded">
                                            </div>
                                        </div>
                                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                            <p class="lead">
                                                My wife and I had a dream of buying our own house in Addis Ababa closer to where we work and. Gift and their skilled team helped make that dream a reality. The buy went smoothly, and we just closed on an ideal new place we're excited to call home.
                                            </p>
                                            <div class="author-name">
                                                Dawit Zewdu
                                            </div>
                                            <ul class="rating">
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fa fa-star-half-full"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a class="carousel-control-prev" href="#carouselExampleIndicators7" role="button" data-slide="prev">
                                <span class="slider-mover-left" aria-hidden="true">
                                    <i class="fa fa-angle-left"></i>
                                </span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators7" role="button" data-slide="next">
                                <span class="slider-mover-right" aria-hidden="true">
                                    <i class="fa fa-angle-right"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><br /><br /><br /><br />
    <!-- Testimonial 2 end -->



    <!-- partner start -->
    <div class="container partner">
        <div class="main-title">
            <h1>Partners</h1>
        </div>
        <div class="row">
            <div class="multi-carousel" data-items="1,3,5,6" data-slide="1" id="multiCarousel" data-interval="1000">
                <div class="multi-carousel-inner">
                    <div class="item">
                        <div class="pad15">
                            <p class="lead">Gift Real Estate</p>
                            <img src="assets/img/brands/brand-1.png" alt="brand">
                        </div>
                    </div>
                    <div class="item">
                        <div class="pad15">
                            <p class="lead">Gift Real Estate</p>
                            <img src="assets/img/brands/brand-2.png" alt="brand">
                        </div>
                    </div>
                    <div class="item">
                        <div class="pad15">
                            <p class="lead">Gift Real Estate</p>
                            <img src="assets/img/brands/brand-3.png" alt="brand">
                        </div>
                    </div>
                    <div class="item">
                        <div class="pad15">
                            <p class="lead">Gift Real Estate</p>
                            <img src="assets/img/brands/brand-4.png" alt="brand">
                        </div>
                    </div>
                    <div class="item">
                        <div class="pad15">
                            <p class="lead">Gift Real Estate</p>
                            <img src="assets/img/brands/brand-5.png" alt="brand">
                        </div>
                    </div>
                    <div class="item">
                        <div class="pad15">
                            <p class="lead">Gift Real Estate</p>
                            <img src="assets/img/brands/brand-1.png" alt="brand">
                        </div>
                    </div>
                    <div class="item">
                        <div class="pad15">
                            <p class="lead">Gift Real Estate</p>
                            <img src="assets/img/brands/brand-2.png" alt="brand">
                        </div>
                    </div>
                    <div class="item">
                        <div class="pad15">
                            <p class="lead">Gift Real Estate</p>
                            <img src="assets/img/brands/brand-3.png" alt="brand">
                        </div>
                    </div>
                    <div class="item">
                        <div class="pad15">
                            <p class="lead">Gift Real Estate</p>
                            <img src="assets/img/brands/brand-4.png" alt="brand">
                        </div>
                    </div>
                    <div class="item">
                        <div class="pad15">
                            <p class="lead">Gift Real Estate</p>
                            <img src="assets/img/brands/brand-5.png" alt="brand">
                        </div>
                    </div>
                </div>
                <a class="multi-carousel-indicator leftLst" aria-hidden="true">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="multi-carousel-indicator rightLst" aria-hidden="true">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- partner end -->

    <!-- Footer start -->
    <?php include('include/footer.php'); ?>


</body>
</html>