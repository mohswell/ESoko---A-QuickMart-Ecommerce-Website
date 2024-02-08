<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <title>Esoko</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/index.css" type="text/css">

    <!-- Start of PHP section -->
    <?php
    // Set database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = ""; // Assuming no password for the root user
    $dbname = "swiss_collection";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve products from the database
    $sql = "SELECT * FROM product";
    $result = $conn->query($sql);

    // Check if there are any products
    if ($result && $result->num_rows > 0) {
        // Initialize $products array to store fetched products
        $products = [];

        // Fetch products and store them in $products array
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        // Close the database connection
        $conn->close();
    } else {
        echo "No products found";
    }

    // Function to get category class based on category ID
    function getCategoryClass($category_id) {
        switch ($category_id) {
            case 1:
                return "fruits";
            case 2:
                return "vegetables";
            case 3:
                return "grain";
            default:
                return "";
        }
    }

    // Function to resize images
    function resizeImage($imagePath, $maxWidth) {
        $info = getimagesize($imagePath);
        $width = $info[0];
        $height = $info[1];
        $mime = $info['mime'];

        switch ($mime) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($imagePath);
                break;
            case 'image/png':
                $image = imagecreatefrompng($imagePath);
                break;
            default:
                return $imagePath;
                break;
        }

        // Calculate aspect ratio
        $aspectRatio = $width / $height;

        // Calculate new height based on maxWidth and aspect ratio
        $newHeight = $maxWidth / $aspectRatio;

        // Create a new image resource with the new dimensions
        $newImage = imagecreatetruecolor($maxWidth, $newHeight);

        // Resize the image
        imagecopyresampled($newImage, $image, 0, 0, 0, 0, $maxWidth, $newHeight, $width, $height);

        // Output resized image to a temporary file
        $tempImagePath = tempnam(sys_get_temp_dir(), 'resized_image');
        imagejpeg($newImage, $tempImagePath);

        // Free up memory
        imagedestroy($image);
        imagedestroy($newImage);

        return $tempImagePath;
    }
    ?>
    <!-- End of PHP section -->

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Swahili</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                <a href="#"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./index.html">Home</a></li>
                <li><a href="./shop-grid.html">Shop</a></li>
                <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.html">Shop Details</a></li>
                        <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                        <li><a href="./checkout.html">Check Out</a></li>
                        <li><a href="./blog-details.html">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="./blog.html">Blog</a></li>
                <li><a href="./contact.html">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> admin@quickmart.com</li>
                <li>Hello, Welcome to our supermarket</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> admin@quickmart.com</li>
                            <li>Hello, Welcome to our supermarket</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                        <div class="header__top__right__language">
                            <img src="img/language.png" alt="">
                            <div>English</div>
                            <span class="arrow_carrot-down"></span>
                            <ul>
                                <li><a href="#">English</a></li>
                            </ul>
                        </div>
                        <div class="header__top__right__auth">
                            <!-- Change the href attribute to the logout page -->
                            <a href="login.php"><i class="fa fa-user"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="./index.html"><img src="img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="./index.html">Home</a></li>
                        <li><a href="./shop-grid.html">Shop</a></li>
                        <li><a href="#">Pages</a>
                            <ul class="header__menu__dropdown">
                                <li><a href="./shop-details.html">Shop Details</a></li>
                                <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                                <li><a href="./checkout.html">Check Out</a></li>
                                <li><a href="./blog-details.html">Blog Details</a></li>
                            </ul>
                        </li>
                        <li><a href="./blog.html">Blog</a></li>
                        <li><a href="./contact.html">Contact</a></li>
                    </ul>
                </nav>
            </div>

        <!-- Remember to change this part concerning the cart Mohammed-->
        <!-- Cart icon at the top of the page -->
        <!-- Cart icon at the top of the page -->
        <!-- Cart icon at the top of the page -->
        
         <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <!-- Favorites icon at the top -->
                        <li><a id="favorites-icon"><i class="fa fa-heart"></i> <span id="favorites-count">0</span></a></li>

                        <!-- Change the href attribute to the shopping cart page -->
                        <!-- Updated cart icon with dynamic content and link -->
                        <li id="cart-icon" class="cart-icon"><a href="shopping-cart.html"><i class="fa fa-shopping-bag"></i> <span id="cart-count">0</span></a></li>
                    <!--<li><a href="shopping-cart.html"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li> -->
                        <li id="cart-total" class="header__cart__price">item: <span id="cart-total-price">$0.00</span></li>
                    </ul>
                </div>
            </div>   
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->


    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All departments</span>
                        </div>
                        <ul>
                            <li><a href="#fresh-meat">Fresh Meat</a></li>
                            <li><a href="#vegetables">Vegetables</a></li>
                            <li><a href="#fruits">Fruits</a></li>
                            <li><a href="#berries">Fresh Berries</a></li>
                            <li><a href="#crops">Crops</a></li>
                            <li><a href="#beans">Beans</a></li>
                            <li><a href="#grain">Grain</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form id="searchForm">
                                <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="What do you need?" id="searchInput">
                                <button type="button" class="site-btn" onclick="searchProducts()">SEAnRCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+254726666900</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                    <div class="hero__item set-bg" data-setbg="img/hero/banner.jpg">
                        <div class="hero__text">
                            <span>FRUIT FRESH</span>
                            <h2>Vegetable <br />100% Organic</h2>
                            <p>Free Pickup and Delivery Available</p>
                            <a href="shopping cart.html" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/cat-1.jpg">
                            <h5><a href="#">Fresh Fruit</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/cat-2.jpg">
                            <h5><a href="#">Dried Fruit</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/cat-3.jpg">
                            <h5><a href="#">Vegetables</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/cat-4.jpg">
                            <h5><a href="#">drink fruits</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/cat-5.jpg">
                            <h5><a href="#">drink fruits</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            <!-- Add more filter options if needed -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                <?php
                // Loop through each product and generate HTML markup
                if (!empty($products)) {
                    foreach ($products as $product) {
                        echo '<div class="col-lg-3 col-md-4 col-sm-6 mix ' . getCategoryClass($product['category_id']) . '">';
                        echo '<div class="featured__item">';
                        echo '<div class="featured__item__pic set-bg" data-setbg="' . $product['product_image'] . '">';
                        echo '<ul class="featured__item__pic__hover">';
                        echo '<li><a href="#" class="add-to-favorites"><i class="fa fa-heart"></i></a></li>';
                        echo '<li><a href="#"><i class="fa fa-retweet"></i></a></li>';
                        echo '<li class="cart-button">';
                        echo '<button class="btn btn-primary add-to-cart" data-product-id="' . $product['product_id'] . '" data-product-price="' . $product['price'] . '" data-product-image="' . $product['product_image'] . '">';
                        echo '<i class="fa fa-shopping-cart"></i> Add to cart';
                        echo '</button>';
                        echo '</li>';
                        echo '</ul>';
                        echo '</div>';
                        echo '<div class="featured__item__text">';
                        echo '<h6><a href="#">' . $product['product_name'] . '</a></h6>';
                        echo '<h5>$' . $product['price'] . '</h5>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Featured Section End -->




    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: P.O.Box 2361, 00621 Village Market Nairobi</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: admin@quickmart.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="https://quickmart.co.ke/about-us/">Who We Are</a></li>
                            <li><a href="https://quickmart.co.ke/community/">Community</a></li>
                            <li><a href="https://quickmart.co.ke/careers/">Jobs & Careers</a></li>
                            <li><a href="https://quickmart.co.ke/talk-to-us/">Contact</a></li>
                            <li><a href="https://quickmart.co.ke/branch-network/">Our Location</a></li>
                            <li><a href="https://quickmart.co.ke/privacy-policy/">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p>
                        <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
                .
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/script.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the favorites icon element and favorites count element
            var favoritesIcon = document.getElementById('favorites-icon');
            var favoritesCountElement = document.getElementById('favorites-count');
        
            // Initialize favorites count from localStorage or set to 0 if not present
            var favoritesCount = parseInt(localStorage.getItem('favoritesCount')) || 0;
            favoritesCountElement.textContent = favoritesCount;
        
            // Check if favoritesCount is greater than 0, set heart color to red
            if (favoritesCount > 0) {
                var addToFavoritesButtons = document.querySelectorAll('.add-to-favorites');
                addToFavoritesButtons.forEach(function(button) {
                    button.querySelector('i.fa-heart').classList.add('red-heart');
                });
            }
        
            // Add event listener to the favorites icon
            favoritesIcon.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default link behavior
            });
        
            // Get all the heart buttons under each product
            var addToFavoritesButtons = document.querySelectorAll('.add-to-favorites');
        
            // Add event listener to each heart button
            addToFavoritesButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent default button behavior
        
                    // Check if the click target is the favorites icon or its child elements
                    if (event.target.closest('#favorites-icon')) {
                        return; // If so, return and do not increase favorites count
                    }
        
                    // Toggle class to change heart icon color
                    var heartIcon = button.querySelector('i.fa-heart');
                    var isRed = heartIcon.classList.toggle('red-heart');
        
                    // Increment or decrement the favorites count based on the button state
                    if (isRed) {
                        favoritesCount++;
                    } else {
                        // Prevent favorites count from going below 0
                        if (favoritesCount > 0) {
                            favoritesCount--;
                        } else {
                            // If favorites count is already 0, return
                            return;
                        }
                    }
        
                    // Update the favorites count element
                    favoritesCountElement.textContent = favoritesCount;
        
                    // Store the updated favorites count in localStorage
                    localStorage.setItem('favoritesCount', favoritesCount.toString());
                });
            });
        });
        
    </script>

</body>


</html>