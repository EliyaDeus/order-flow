<?php
    include('conn.php');
    include('proccessCustomer.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Package</title>
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="assets/icons/logo3.png">
    <!-- external css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/register.css">
    <!-- latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>

    <!-- SIDE NAV -->
    <div class="sidenav" id="sidenav">
        <!-- navbar brand -->
        <a class="navbar-brand navbarBrand" href="user_dash.html">
            <img src="assets/icons/logo2.png" class="brandIcon" id="brandIcon">
            <h3 id="brandName">NEWRAY</h3>
        </a>
        <!-- profile -->
        <div class="profilePicDiv" title="Profile Options">
            <div class="profilePicWrapper" id="profilePicWrapper">
                <img src="assets/icons/profile.png" class="profileImg">
            </div>
            <div class="profileName" id="profileName">
                <h5>Andrew Mihayo</h5>
            </div>
        </div>

        <!-- profile options -->
        <div class="profileOpt">
            <a href="javascript:void(0)" class="navLink" style=" color: black;">
                <img src="assets/icons/user2.png" width="25px">My Profile
            </a>
            <a href="javascript:void(0)" class="navLink" style=" color: black;">
                <img src="assets/icons/logout2.png" width="25px">Log Out
            </a>
        </div>

        <!-- nav menus -->
        <div class="navmenu">
            <a href="seller_dash.html" class="navLink">
                <img src="assets/icons/dashboard2.png" class="navIcon">
                <h6 class="navHead">Dashboard</h6>
            </a>
            <a href="add_customer.html" class="navLink active">
                <img src="assets/icons/add.png" class="navIcon">
                <h6 class="navHead">Register Customer</h6>
            </a>
        </div>
    </div>

    <!-- MAIN CONTAINER -->
    <div class="main" id="main">
        <div class="container-fluid m-0 p-0">
            <!-- top nav -->
            <div class="row m-0 p-0">
                <div class="col-3 m-0 p-3 topNav">
                    <img src="assets/icons/menu.png" class="menuIcon" id="menuIcon" title="collpase sidebar">
                    <img src="assets/icons/list.png" class="menuIcon" id="menuIcon2" title="expand sidebar">
                </div>
                <div class="col-9 m-0 p-3 topNav">
                    <h4 style="color: white;">PACKAGE TRACKER</h4>
                </div>
            </div>

            <div class="row m-0 p-0">
                <div class="col-12 m-0 p-0">
            <!-- registering form -->
                    <div class="formContainer p-2">
                        <form action="proccessCustomer.php" method = "post" id="regForm">
                            <div class="formHead">
                                <h3 style="text-align: center;">REGISTER PACKAGE DETAILS <?php echo $servername ?></h3>
                            </div>
                            <div class="firstName formdiv">
                                <label>Product Name</label><br>
                                <input type="text" name="pname" class="form-control" id="pname" required>
                                <i></i>
                            </div><br>
                            <div class="lastName formdiv">
                                <label>Product Color</label><br>
                                <input type="text" name="pcolor" class="form-control" id="pcolor" required>
                                <i></i>
                            </div><br>
                            <!-- <div class="email formdiv">
                                <label>Customer's Phone Number</label><br>
                                <input type="tel" name="phone" class="form-control" id="phone" required>
                                <i></i>
                            </div><br> -->
                            <div class="alerts">
                                <p id="phoneDigitWarning">
                                    Phone number must have 10 digits only (do not add space between or after  numbers) <img src="assets/icons/wrong.png" width="20px" height="20px">
                                </p>
                                <p id="phoneTypeWarning">
                                    Phone number can only include positive digits from 0 - 9 (do not add space between or after numbers) <img src="assets/icons/wrong.png" width="20px" height="20px">
                                </p>
                                <p id="phoneAccept">
                                    Valid Phone number <img src="assets/icons/check.png" width="20px" height="20px">
                                </p>
                            </div>
                            <div class="submit formdiv">
                                <input type="submit" name="submiter" id="submiter" value="ADD CUSTOMER" class="form-control">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- form validation script -->
    <script>
        var phone = document.getElementById('phone');

        phone.addEventListener('input', function(){
            var phoneVal = phone.value;
            submitter = document.getElementById('submiter');
            submitter.disabled = true;

            if(phoneVal.length < 1){
                document.getElementById('phoneTypeWarning').style.display = "none";
                document.getElementById('phoneDigitWarning').style.display = "none";
                document.getElementById('phoneAccept').style.display = "none";
                submitter.disabled = false;
            }
            else{
                if(isNaN(phoneVal)){
                    document.getElementById('phoneTypeWarning').style.display = "block";
                    document.getElementById('phoneAccept').style.display = "none";
                }
                else{
                    document.getElementById('phoneTypeWarning').style.display = "none";
                    if(phoneVal.length < 10 || phoneVal.length > 10){
                        document.getElementById('phoneDigitWarning').style.display = "block";
                        document.getElementById('phoneAccept').style.display = "none";
                    }
                    else if(phoneVal.length = 10 && phoneVal.indexOf(' ') < 0){
                        document.getElementById('phoneDigitWarning').style.display = "none";
                        document.getElementById('phoneAccept').style.display = "block";
                        submitter.disabled = false;
                        // var newPhone = phoneVal.slice(0, 4) + ' ' + phoneVal.slice(4, 7) + ' ' + phoneVal.slice(7);
                        // phone.value = newPhone;
                    }
                }
            }
            
        })

    </script>

    <!-- external js -->
    <script src="js/script.js"></script>
</body>
</html>

