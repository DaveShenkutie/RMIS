<?php include 'include/config.php';?>
<footer class="footer">
    <div class="container footer-inner">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="footer-item">
                    <h4>Contact Us</h4>

                    <ul class="contact-info">
                        <li>
                            Address: Bole Medhanealem Adjacent to Mafi City Mall, Blue Nile Building 3rd Floor
                        </li>
                        <li>
                            Email: <a href="mailto:giftrealestate@gmail.com">giftrealestate@gmail.com</a>
                        </li>
                        <li>
                            Phone: <a href="tel:+2519-4636-3425"> +2519-4636-3425  </a>
                        </li>
                    </ul>

                    <ul class="social-list clearfix">
                        <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#" class="google"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#" class="rss"><i class="fa fa-rss"></i></a></li>
                        <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
                <div class="footer-item">
                    <h4>
                        Useful Links
                    </h4>
                    <ul class="links">
                        <li>
                            <a href="about.php"><i class="fa fa-angle-right"></i>About us</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-angle-right"></i>Service</a>
                        </li>
                        <li>
                            <a href="properties.php"><i class="fa fa-angle-right"></i>Properties Listing</a>
                        </li>
                        <li>
                            <a href="contact.php"><i class="fa fa-angle-right"></i>Contact Us</a>
                        </li>
                        <!--
                        <li>
                            <a href="#"><i class="fa fa-angle-right"></i>Property Details</a>
                        </li>-->
                    </ul>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="recent-posts footer-item">
                    <h4>Recent Properties</h4>
                    <?php
                        $query = mysqli_query($con, "SELECT * FROM property ORDER BY date DESC");
                        $i = 1;
                        while (($res = mysqli_fetch_array($query))&&($i<4)) {
                            $id = $res['id'];
                            ++$i;
                            $result = mysqli_query($con, "select * from image where pid='$id'");
                            $row = mysqli_fetch_array($result);
                            $img = $row['link'];
                        ?>  
                            <div class="media mb-4">
                                <a href="properties-details.html">
                                <img src="assets/img/uploads/<?php echo $img; ?>" alt="sub-property"/>
                                </a>
                                <div class="media-body align-self-center">
                                    <h6>
                                        <a href="properties-details.html"><?php  echo $res['description']; ?></a>
                                    </h6>
                                    <p>
                                    <?php 
                                    $date=$res['date'];
                                    $newDate = date("F j, Y, g:i a", strtotime($date)); 
                                    echo $newDate;
                                    ?>
                                    <p> <strong>Birr <?php  echo number_format($res['price'],2); ?></strong></p>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
           
        

        <div class="row">
            <div class="col-xl-12">
                <p class="copy">&copy;  <?php echo date("Y");?> <a href="http://themevessel.com/" target="_blank">Industrial </a>. Trademarks and brands are the property of their respective owners.</p>
            </div>
        </div>
    </div>
</footer>
<!-- Footer end -->


<!-- Property Video Modal -->
<div class="modal property-modal fade" id="propertyModal" tabindex="-1" role="dialog" aria-labelledby="propertyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="propertyModalLabel">
                    Find Your Dream Properties
                </h5>
                <p>
                    <i class="flaticon-facebook-placeholder-for-locate-places-on-maps"></i> infront of feres bet,
                </p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <!-- <div class="col-lg-6 modal-left">
                        <div class="modal-left-content">
                            <div id="modalCarousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner" role="listbox">
                                    <div class="carousel-item active">
                                        <iframe class="modalIframe" src="https://www.youtube.com/embed/8jEIv9IJNcI"  allowfullscreen></iframe>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="assets/img/property-1.jpg" alt="Test ALT">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="assets/img/property-1.jpg" alt="Test ALT">
                                    </div>
                                </div>
                                <a class="control control-prev" href="#modalCarousel" role="button" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="control control-next" href="#modalCarousel" role="button" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                            <div class="description"><h3>Description</h3>
                                <p>
                                From the ground to the third floor all are for Commercial Use Above the fourth floor all are For Residential Use
                                </p>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-lg-9 modal-center">
                        <div class="modal-right-content bg-gray">
                        <?php include('login.php')?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('include/externaljs.php')?>

</body>
</html>