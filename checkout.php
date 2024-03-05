<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout</title>

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
    <style>
        /* Styling for the Order notes section */
        .checkout__input {
            margin-bottom: 20px;
        }

        .checkout__input label {
            margin-bottom: 5px;
        }

        /* Hover effect */
        .checkout__input textarea:hover {
            border-color: #ced4da;
        }
    </style>

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.html"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.php">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Modal Structure -->
    <div id="couponModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Enter Coupon Code</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="couponForm">
                        <div class="form-group">
                            <input type="text" id="couponCode" class="form-control" placeholder="Enter your coupon code">
                        </div>
                        <button type="submit" class="btn btn-primary">Apply Coupon</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <!-- Trigger for Modal -->
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#" id="openModal" data-toggle="modal" data-target="#couponModal">Click here</a> to enter your code</h6>
                </div>
            </div>
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form id="checkout-form" action="checkout_process.php" method="post">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>First Name<span>*</span></p>
                                        <input type="text" name="first_name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name="last_name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" name="address" placeholder="Street Address" class="checkout__input__add" required>
                                <input type="text" placeholder="Apartment, suite, unit, etc. (optional)" name="apartment">
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" name="city" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="phone" required>
                                    </div>
                                </div>
                                <!-- Use this section to add a form input right next to another input
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                                -->
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="acc">
                                    Existing User?
                                    <input type="checkbox" id="acc" name="create_account">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <p>If you are a returning customer, please login below here to place your order.</p>
                            <div class="checkout__input">
                                <p>Email Address<span>*</span></p>
                                <input type="email" name="email" required>
                            </div>
                            <div class="checkout__input">
                                <p>Account Password<span>*</span></p>
                                <input type="password" name="password" required>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="diff-acc">
                                    Ship to a different address?
                                    <input type="checkbox" id="diff-acc" name="ship_different_address">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input">
                                <label class="font-weight-bold">Order notes<span>*</span></label>
                                <textarea class="form-control col-10" name="order_notes" rows="2" placeholder="Notes about your order, e.g. special notes for delivery." required></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <!-- Your order summary -->
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul id="order-details-list"></ul>
                                <div class="checkout__order__subtotal" >Subtotal<span id="subtotal">$0.00</span></div>
                                <div class="checkout__order__discount">Discount <span id="discount" class="text-danger">$0.00</span></div>
                                <div class="checkout__order__total">Total <span id="total">$0.00</span></div>
                                <!-- Payment methods -->
                                <div class="checkout__input__checkbox">
                                    <label for="cash">
                                        Cash
                                        <input type="radio" id="cash" name="payment_method" value="Cash">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="mpesa">
                                        MPesa
                                        <input type="checkbox" id="mpesa" name="payment_method" value="MPesa" onclick="handleMpesaCheckbox()">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="money">
                                        Money on Delivery
                                        <input type="radio" id="moneyOnDelivery" name="payment_method" value="MoneyOnDelivery">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <!-- Hidden input field to store selected payment method and total value -->
                                <input type="hidden" id="selected_payment_method" name="selected_payment_method">
                                <input type="hidden" name="total" id="total-value" value="">
                                <input type="hidden" id="cartItemsInput" name="cartItems">
                                <!-- Submit button -->
                                <button type="button" class="site-btn" onclick="submitForm()">PLACE ORDER</button>
                            </div>
                        </div>             
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

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
    <script src="js/checkout.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- JavaScript code for form submission for checkout order -->
    <script>
        // Function to handle form submission
        function submitForm() {
            // Retrieve cart items from session storage
            var cartItems = JSON.parse(sessionStorage.getItem('cartItems'));

            // Set the value of cartItems input field in the form
            document.getElementById('cartItemsInput').value = JSON.stringify(cartItems);

            // Get the selected payment method
            var selectedPaymentMethod = document.querySelector('input[name="payment_method"]:checked');
            
            if (!selectedPaymentMethod) {
                alert('Please select a payment method.');
                return;
            }

            // Update the hidden input field with the selected payment method value
            document.getElementById('selected_payment_method').value = selectedPaymentMethod.value;

            // Submit the form
            document.getElementById('checkout-form').submit();
        }
    </script>

    <!--Javacsript code to initaiate redirect to mpesa folder -->
    <script>
    function handleMpesaCheckbox() {
        var mpesaCheckbox = document.getElementById('mpesa');
        if (mpesaCheckbox.checked) {
            var total = parseFloat(document.getElementById('total-value').value);
            sessionStorage.setItem('mpesaTotal', total.toFixed(2));
            console.log(total);
            window.location.href = '../daraja/index.php'; // Redirect to the STK push initiation file
        }
    }
    </script>


    <!-- JavaScript code for handling AJAX request -->
    <script>
        $(document).ready(function () {
            // Function to handle form submission
            $('#couponForm').submit(function (e) {
                e.preventDefault(); // Prevent the form from submitting normally

                // Get the coupon code from the input field
                var couponCode = $('#couponCode').val();

                // Send AJAX request to verify_coupon.php
                $.ajax({
                    type: 'POST',
                    url: 'verify_coupon.php',
                    data: { couponCode: couponCode },
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            // Coupon code is valid, apply discount and update order summary
                            var discount = response.discount;
                            populateOrderSummary(discount);
                            alert('Coupon applied successfully!');
                        } else {
                            // Coupon code is invalid, display error message
                            alert(response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle error
                        console.error(xhr.responseText); // Print error message to console
                        alert('Error occurred while processing the request. Please try again.');
                    }
                });
            });
        });
    </script>

    <script>
    // Function to populate the order summary card with cart items and apply discount
    function populateOrderSummary(discount) {
        // Retrieve cart items from session storage
        var cartItems = JSON.parse(sessionStorage.getItem('cartItems'));

        // Render cart items in the order summary
        var orderDetailsList = document.getElementById('order-details-list');
        orderDetailsList.innerHTML = ''; // Clear existing items

        var subtotal = 0; // Variable to calculate the subtotal amount

        cartItems.forEach(function(item) {
            var li = document.createElement('li');
            li.textContent = item.name + ' x ' + item.quantity + ' - $' + item.price.toFixed(2);
            orderDetailsList.appendChild(li);

            subtotal += item.price * item.quantity; // Update the subtotal amount
        });
        // Calculate the discount amount
        var discountAmount = (subtotal * (discount / 100)).toFixed(2);

        // Apply discount to the subtotal
        var total = subtotal - (subtotal * (discount / 100));

        // Update the subtotal and total in the order summary
        document.getElementById('subtotal').textContent = '$' + subtotal.toFixed(2);
        document.getElementById('discount').textContent = '-$' + discountAmount;
        document.getElementById('total').textContent = '$' + total.toFixed(2);

        // Set the total value in the hidden input field
        document.getElementById('total-value').value = total.toFixed(2);
    }

    // Call the function when the page is loaded with an initial discount of 0
    populateOrderSummary(0);

    </script>

</body>

</html>