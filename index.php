<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esoko</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">

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
    <style>
        .categories-section {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .category-item:hover {
        transform: scale(1.02);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .category-item i {
        font-size: 48px;
        width: 70px;
        text-align: center;
        }

        @keyframes pulse {
        0% {
            transform: scale(1);
        }
        100% {
            transform: scale(1.05);
        }
        }
        .categories-section:hover {
        animation: pulse 0.8s infinite alternate;
        }
        /* Highlight the active category item */
        .category-item.active {
            background-color: #f9fafb;
        }
        /* CSS for Flexbox ordering */
        .grid-cols-1.md\:grid-cols-4.gap-4 {
            display: container;
            flex-wrap: wrap;
        }

        .featured__item {
            width: 100%; /* Ensure each product takes full width */
        }

        .hidden {
            display: none;
        }

    </style>

    <!-- Start of PHP section -->
    <?php
    session_start();

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
    ?>
    
    <!-- End of PHP section -->
</head>

<body class="font-sans bg-gray-100">

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
            <div class="header__cart__price">item: <span>Ksh150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="img/language.png" alt="">
                <div>English</div>
            </div>
            <div class="header__top__right__auth">
                <a href="#"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./index.html">Home</a></li>
                <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">

                    </ul>
                </li>
            </ul>
        </nav>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.html"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="./index.html">Home</a></li>
                            <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                                    <li><a href="./checkout.php">Check Out</a></li>
                                    <li><a href="/Esoko/Login/login.php">Login Page</a></li>
                                </ul>
                            </li>
                            <li><a href="contact.html">Contact Us</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart mb-0">
                        <ul>
                            <!-- Favorites icon at the top -->
                            <li><a id="favorites-icon"><i class="fa fa-heart"></i> <span id="favorites-count">0</span></a></li>

                            <!-- Change the href attribute to the shopping cart page -->
                            <!-- Updated cart icon with dynamic content and link -->
                            <li id="cart-icon" class="cart-icon"><a href="shopping-cart.html"><i class="fa fa-shopping-bag"></i> <span id="cart-count">0</span></a></li>
                            <!--<li><a href="shopping-cart.html"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li> -->
                            <li id="cart-total" class="header__cart__price">item: <span id="cart-total-price">Ksh0.00</span></li>
                            <li class="header__top__right">
                                <div class="header__top__right__auth">
                                    <!-- Change the href attribute to the logout page -->
                                    <a href="/Esoko/login/login.php"><i class="fa fa-user"></i>Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->


    <!-- Hero Section Begin -->
    <div class="container mx-auto my-8">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- Categories Section -->
        <div class="col-span-1 md:col-span-1">
        <div class="categories-section bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-6">Explore Categories</h2>
            <div class="category-item py-3 border-b border-gray-200 hover:bg-gray-200 flex items-center justify-between transition duration-300 ease-in-out transform hover:scale-105" data-categoryId="2">
            <i class="fas fa-carrot text-green-500 text-2xl"></i>
            <span class="font-semibold">Vegetables</span>
            </div>
            <div class="category-item py-3 border-b border-gray-200 hover:bg-gray-200 flex items-center justify-between transition duration-300 ease-in-out transform hover:scale-105" data-categoryId="1">
            <i class="fas fa-apple-alt text-red-500 text-2xl"></i>
            <span class="font-semibold">Fruits</span>
            </div>
            <div class="category-item py-3 border-b border-gray-200 hover:bg-gray-200 flex items-center justify-between transition duration-300 ease-in-out transform hover:scale-105" data-categoryId="4">
            <i class="fas fa-seedling text-blue-500 text-2xl"></i>
            <span class="font-semibold">Seeds</span>
            </div>
            <div class="category-item py-3 border-b border-gray-200 hover:bg-gray-200 flex items-center justify-between transition duration-300 ease-in-out transform hover:scale-105" data-categoryId="3">
            <i class="fa-solid fa-seedling text-yellow-500 text-3xl"></i>
            <span class="font-semibold text-lg">Grain</span>
            </div>
            <div class="category-item py-3 border-b border-gray-200 hover:bg-gray-200 flex items-center justify-between transition duration-300 ease-in-out transform hover:scale-105" data-categoryId="5">
            <i class="fas fa-snowflake text-blue-500 text-2xl"></i>
            <span class="font-semibold">Frozen Fruits</span>
            </div>
            <div class="category-item py-3 hover:bg-gray-200 flex items-center justify-between transition duration-300 ease-in-out transform hover:scale-105" data-categoryId="6">
            <i class="fas fa-leaf text-purple-500 text-2xl"></i>
            <span class="font-semibold">Beans</span>
            </div>
        </div>
        </div>
        <!-- Product Section - Right Side -->
        <div class="col-span-3 md:col-span-3">
            <!-- Search and Sort Section -->
            <div class="relative mb-4"> <!-- Added mb-8 to increase spacing between search and heading -->
                <input id="searchInput" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" placeholder="Search products...">
                <button class="absolute right-0 top-0 mt-2 mr-3 text-gray-600">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <div class="flex justify-center mb-4">
                <button id="sortByNameAsc" class="mr-2 px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-200">
                    Sort by Name <i class="fas fa-sort-alpha-down"></i>
                </button>
                <button id="sortByNameDesc" class="mr-2 px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-200">
                    Sort by Name <i class="fas fa-sort-alpha-up"></i>
                </button>
                <button id="sortByPriceAsc" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-200">
                    Sort by Price <i class="fas fa-sort-amount-down"></i>
                </button>
                <button id="sortByPriceDesc" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-200">
                    Sort by Price <i class="fas fa-sort-amount-up"></i>
                </button>
            </div>
            <!-- Centered and styled "Products" heading -->
            <div class="text-center mb-0"> <!-- Adjusted margin-bottom to mb-4 -->
                <h2 class="text-4xl font-bold border-b border-gray-300 pb-2">Products</h2>
            </div>

            <!-- Featured Section Begin -->
            <section class="featured spad mb-6">
                <div class="container mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4" id="productsList">
                        <?php
                        // Loop through each product and generate HTML markup
                        if (!empty($products)) {
                            foreach ($products as $product) {
                                echo '<div class="col-span-1">';
                                echo '<div class="featured__item bg-white rounded-lg shadow-md overflow-hidden" data-category="' . $product['category_id'] . '">';
                                echo '<div class="featured__item__pic aspect-w-1 aspect-h-1">';
                                echo '<img src="' . $product['product_image'] . '" alt="' . $product['product_name'] . '" class="object-cover w-full h-full">';
                                echo '<ul class="featured__item__pic__hover">';
                                echo '<li><a href="#" class="add-to-favorites"><i class="fa fa-heart"></i></a></li>';
                                echo '<li class="cart-button">';
                                echo '<button class="btn btn-primary add-to-cart" data-product-id="' . $product['product_id'] . '" data-product-price="' . $product['price'] . '" data-product-name="' . $product['product_name'] . '" data-product-image="' . $product['product_image'] . '">';
                                echo '<i class="fa fa-shopping-cart"></i> Add to cart';
                                echo '</button>';
                                echo '</li>';
                                echo '</ul>';
                                echo '</div>';
                                echo '<div class="featured__item__text p-4">';
                                echo '<h6 class="text-lg font-semibold"><a href="#" class="text-gray-800 hover:text-blue-500">' . $product['product_name'] . '</a></h6>';
                                echo '<h5 class="text-gray-700 font-medium">Ksh ' . $product['price'] . '</h5>';
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
        </div>
    </div>
    </div>
    <!-- Hero Section End -->

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
                            <li>Phone: 0726666900/0726666699</li>
                            <li>Email: admin@quickmart.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="https://quickmart.co.ke/about-us/">About Us</a></li>
                            <li><a href="https://quickmart.co.ke/returns-policy/">Returns Ploicy</a></li>
                            <li><a href="https://quickmart.co.ke/corporate-governance/">Corporate Governance</a></li>
                            <li><a href="https://quickmart.co.ke/supplier-relations/">Supplier Relations</a></li>
                            <li><a href="https://quickmart.co.ke/corporate-policies/">Corporate Policies</a></li>
                            <li><a href="https://quickmart.co.ke/branch-network/">Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="https://quickmart.co.ke/about-us/">Who We Are</a></li>
                            <li><a href="https://quickmart.co.ke/community/">Community</a></li>
                            <li><a href="https://quickmart.co.ke/careers/">Jobs & Careers</a></li>
                            <li><a href="https://quickmart.co.ke/talk-to-us/">Contact</a></li>
                            <li><a href="https://quickmart.co.ke/talk-to-us/">Talk to us</a></li>
                            <li><a href="https://quickmart.co.ke/privacy-policy/">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="controller/subscribe.php" method="post">
                            <input type="text" name="email" placeholder="Enter your mail">
                            <button type="submit" class="site-btn" name="subscribe">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="https://www.facebook.com/quickmartkenya?_rdc=1&_rdr"><i class="fa fa-facebook"></i></a>
                            <a href="https://www.instagram.com/quickmartkenya/?hl=en"><i class="fa fa-instagram"></i></a>
                            <a href="https://twitter.com/QuickmartKenya"><i class="fa fa-twitter"></i></a>
                            <a href="https://www.youtube.com/channel/UCqWdqywf4fLaaL5rMP36xFQ?themeRefresh=1"><i class="fa fa-youtube"></i></a>
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

    <script>
        $(document).ready(function() {
            $('.add-to-cart').on('click', function() {
                var button = $(this);
                button.text('Added').removeClass('btn-primary').addClass('btn-success');
                
                // You can add additional functionality here, such as updating the cart icon
                
                // Example: Changing the cart icon
                button.find('i').removeClass('fa-shopping-cart').addClass('fa-check-circle');
            });
        });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all category items
        const categoryItems = document.querySelectorAll('.category-item');

        // Get the container for featured products
        const featuredContainer = document.querySelector('.featured .grid');

        // Loop through each category item and add a click event listener
        categoryItems.forEach(item => {
            item.addEventListener('click', () => {
                // Get the category ID from the clicked item
                const categoryId = item.getAttribute('data-categoryId');

                // Hide all products
                const allProducts = document.querySelectorAll('.featured__item');
                allProducts.forEach(product => {
                    product.classList.add('hidden');
                });

                // Show only the products that belong to the clicked category
                const categoryProducts = document.querySelectorAll(`[data-category="${categoryId}"]`);
                categoryProducts.forEach(product => {
                    product.classList.remove('hidden');
                    // Move the product to the beginning of the featured section
                    featuredContainer.prepend(product.parentNode);
                });
            });
        });
    });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the container of the products list
            const productsListContainer = document.getElementById('productsList');

            // Sort by name ascending button event listener
            const sortByNameAscButton = document.getElementById('sortByNameAsc');
            sortByNameAscButton.addEventListener('click', function() {
                // Get all product elements
                const products = Array.from(productsListContainer.querySelectorAll('.col-span-1'));
                // Sort product elements alphabetically by name in ascending order
                products.sort((a, b) => a.querySelector('.text-lg').textContent.localeCompare(b.querySelector('.text-lg').textContent));
                // Reorder product elements in the container
                products.forEach(product => productsListContainer.appendChild(product));
            });

            // Sort by name descending button event listener
            const sortByNameDescButton = document.getElementById('sortByNameDesc');
            sortByNameDescButton.addEventListener('click', function() {
                // Get all product elements
                const products = Array.from(productsListContainer.querySelectorAll('.col-span-1'));
                // Sort product elements alphabetically by name in descending order
                products.sort((a, b) => b.querySelector('.text-lg').textContent.localeCompare(a.querySelector('.text-lg').textContent));
                // Reorder product elements in the container
                products.forEach(product => productsListContainer.appendChild(product));
            });

            // Sort by price ascending button event listener
            const sortByPriceAscButton = document.getElementById('sortByPriceAsc');
            sortByPriceAscButton.addEventListener('click', function() {
                // Get all product elements
                const products = Array.from(productsListContainer.querySelectorAll('.col-span-1'));
                // Sort product elements by price in ascending order
                products.sort((a, b) => parseFloat(a.querySelector('.font-medium').textContent.replace('Ksh ', '')) - parseFloat(b.querySelector('.font-medium').textContent.replace('Ksh ', '')));
                // Reorder product elements in the container
                products.forEach(product => productsListContainer.appendChild(product));
            });

            // Sort by price descending button event listener
            const sortByPriceDescButton = document.getElementById('sortByPriceDesc');
            sortByPriceDescButton.addEventListener('click', function() {
                // Get all product elements
                const products = Array.from(productsListContainer.querySelectorAll('.col-span-1'));
                // Sort product elements by price in descending order
                products.sort((a, b) => parseFloat(b.querySelector('.font-medium').textContent.replace('Ksh ', '')) - parseFloat(a.querySelector('.font-medium').textContent.replace('Ksh ', '')));
                // Reorder product elements in the container
                products.forEach(product => productsListContainer.appendChild(product));
            });

            // Search input event listener
            const searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('input', function() {
                // Get the search input value
                const searchTerm = searchInput.value.trim().toLowerCase();
                // Get all product elements
                const products = Array.from(productsListContainer.querySelectorAll('.col-span-1'));
                // Filter products based on the search term
                products.forEach(product => {
                    const productName = product.querySelector('.text-lg').textContent.toLowerCase();
                    // Check if the product name contains the search term
                    if (productName.includes(searchTerm)) {
                        product.style.display = ''; // Show the product
                    } else {
                        product.style.display = 'none'; // Hide the product
                    }
                });
            });
        });
    </script>

</body>
</html>