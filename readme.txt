<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUIKMART SUPERMARKET MPESA CHECKOUT</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .centered-div {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            width: 400px;
            padding: 30px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 10px 20px rgba(0, 255, 0, 0.5); /* Green shadow with effects */
        }
        .form-container img {
            display: block;
            margin: 0 auto 20px;
            width: 100px;
        }
        .form-container h1 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        .form-container .form-group {
            margin-bottom: 20px;
        }
        .form-container label {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .form-container input[type="text"] {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            width: calc(100% - 50px); /* Adjusted width */
            font-size: 16px;
        }
        .form-container .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #ccc;
            border-right: 0;
            font-size: 16px;
            font-weight: bold;
        }
        .form-container .form-text {
            font-size: 14px;
            color: #666;
        }
        .form-container button[type="submit"] {
            background-color: #ff6666; /* Lighter red button */
            border: none;
            border-radius: 5px;
            color: #fff;
            padding: 10px;
            width: 100%;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
        }
        .form-container button[type="submit"]:hover {
            background-color: #ff3333; /* Darker red on hover */
        }
    </style>
</head>
<body>
    <div class="centered-div">
        <div class="form-container">
            <form>
                <img src="logo.png" alt="M-Pesa Logo">
                <h1>Enter your M-Pesa number</h1>

                <div class="form-group">
                    <label for="mpesaNumber">M-Pesa Number</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">+254</div>
                            <input type="text" id="mpesaNumber" class="form-control" placeholder="Enter M-Pesa Number" required autofocus>
                        </div>
                        
                    </div>
                    <small id="mpesaNumberHelp" class="form-text text-muted">Enter your M-Pesa number without the leading 0.</small>
                </div>

                <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
