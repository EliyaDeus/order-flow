<?php
    include('conn.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="assets/icons/logo3.png">
    <!-- external css -->
    <link rel="stylesheet" href="css/style.css">
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
            <a href="dashboard.php" class="navLink active">
                <img src="assets/icons/dashboard2.png" class="navIcon">
                <h6 class="navHead">Dashboard</h6>
            </a>
            <a href="add_customer.php" class="navLink">
                <img src="assets/icons/add.png" class="navIcon">
                <h6 class="navHead">Register Customer</h6>
            </a>
        </div>
    </div>



    <!-- get the number of buyers and packages -->
    <?php
        // get total number of buyers
        $buyerNo = "SELECT * FROM buyers";
        $buyerNoSql = mysqli_query($conn, $buyerNo);
        if($buyerNoSql){
            if(mysqli_num_rows($buyerNoSql) > 0){
                $buyerTotal = mysqli_num_rows($buyerNoSql);
            }
            else{
                $buyerTotal = 0;
            }
        }
        else{
            $buyerTotal = "error finding the number of buyers at the moment!";
        }

        // get total number of orders
        $orderNo = "SELECT * FROM products";
        $orderNoSql = mysqli_query($conn, $orderNo);
        if($orderNoSql){
            if(mysqli_num_rows($orderNoSql) > 0){
                $orderTotal = mysqli_num_rows($orderNoSql);
            }
            else{
                $orderTotal = 0;
            }
        }
        else{
            $orderTotal = "error finding the number of buyers at the moment!";
        }
    
    
    ?>

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
                <div class="col-12 m-0 p-2"><h5 style="color: rgb(66, 66, 66); font-weight: light;">ADMIN DASHBOARD</h5></div>
            </div>


            <!-- Devices cards -->
            <div class="row m-0 p-0">

                <div class="col-md-6 m-0 p-2">
                    <div class="packageCard" id="orderedCard">
                        <div class="packageDetails">
                            <h5 class="packageCart">Registered Buyers</h5>
                            <h2 class="packageNo"><?php echo $buyerTotal ?></h2>
                        </div>
                        <div class="packageIcon">
                            <img src="assets/icons/customer.png" class="iconImg">
                        </div>
                    </div>
                </div>

                <div class="col-md-6 m-0 p-2">
                    <div class="packageCard" id="deliveredCard">
                        <div class="packageDetails">
                            <h5 class="packageCart">Ordered Packages</h5>
                            <h2 class="packageNo"><?php echo $orderTotal ?></h2>
                        </div>
                        <div class="packageIcon">
                            <img src="assets/icons/completed.png" class="iconImg">
                        </div>
                    </div>
                </div>
                        
            </div>

            <!-- row 1 -->
            <div class="row m-0 p-0">
                <!-- ordered package list -->
                <div class="col-lg-12 m-0 p-2">
                    <div class="packageList" id="orderedList">
                        <div class="actionBar">
                            <div class="col-3"><h4 class="name">Registered Buyers<h4></div>
                            <div class="col-8 py-3 px-4 searchBuyers">
                                <input type="text" class="form-control" id="buyer" placeholder="search customers, mobile number" name="email">
                            </div>
                            <div class="col-1 action">
                                <img src="assets/icons/minus.png" class="actionIcon" id="minus">
                                <img src="assets/icons/plus.png" class="actionIcon" id="plus" title="Toggle Table Collpase">
                            </div>
                        </div>

                        <div class="detailsBar" id="orderedDetails">
                            <table id="buyerTable">
                                <thead>
                                    <tr id="thRow">
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Mobile No.</th>
                                        <th>Date Registered</th>
                                    </tr>
                                </thead>

                                <tbody>

                        <!-- get buyer's details -->
                        <?php
                            $buyerSql = "SELECT * FROM buyers ORDER BY dateReg DESC";
                            $buyerRst = mysqli_query($conn, $buyerSql);

                            if($buyerRst){
                                if(mysqli_num_rows($buyerRst) > 0){
                                    while($buyerDetails = mysqli_fetch_assoc($buyerRst)):
                                        $buyerID = $buyerDetails['buyer_id'];
                                        $buyerFname = stripslashes($buyerDetails['firstName']);
                                        $buyerLname = stripslashes($buyerDetails['lastName']);
                                        $buyerPhone = $buyerDetails['phoneNo'];
                                        $buyerDateReg = $buyerDetails['dateReg'];

                                        echo '<tr class="tdRow">';
                                        echo '<td>' . $buyerID . '</td>';
                                        echo '<td>' . $buyerFname . '</td>';
                                        echo '<td>' . $buyerLname . '</td>';
                                        echo '<td>' . $buyerPhone . '</td>';
                                        echo '<td>' . $buyerDateReg . '</td>';
                                        echo '</tr>';
                                    
                                    endwhile;
                                }
                                else{
                                    echo '<tr>
                                            <td colspan = "5" style="opacity: 0.6;">NO Buyers are Registered at the moment</td>
                                        </tr>';
                                }
                            }
                            else{
                                echo '<script>
                                    alert("error getting buyer\'s details");
                                </script>';
                            }
                        
                        
                        ?>
                                    
                                <tr>
                                    <td colspan="5" style="border: none;"><a class="btn" href="allDevices.php#desktop" style="border-radius: 0px; padding: 5px; background-color: white; color: rgb(231, 97, 120); font-weight: bold;">View more</a></td>
                                </tr>
                                <tr id="itemNotFound">
                                    <td colspan="5" style="border: none; opacity: 0.5;"><p>no item found</p></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>

            <!-- row 2 -->
            <div class="row m-0 p-0">
                <!-- delivered package lists -->
                <div class="col-lg-12 m-0 p-2">
                    <div class="packageList" id="deliveredList">
                        <div class="actionBar">
                            <div class="col-3"><h4 class="name">Ordered Packages</h4></div>
                            <div class="col-8 py-3 px-4 searchBuyers">
                                <input type="text" class="form-control" id="package" placeholder="search packages name, color, location, receiver, code... " name="email">
                            </div>
                            <div class="col-1 action">
                                <img src="assets/icons/minus.png" class="actionIcon" id="deliveredminus">
                                <img src="assets/icons/plus.png" class="actionIcon" id="deliveredplus" title="Toggle Table Collpase">
                            </div>
                        </div>
                        <div class="detailsBar" id="deliveredDetails">
                            <table id="packageTable">
                                <thead>
                                    <tr id="thRow">
                                        <th>Package Name</th>
                                        <th>Package Color</th>
                                        <th>Date Packed</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Receiver</th>
                                        <th>Package Code</th>
                                    </tr>
                                </thead>

                                <tbody>

                                <!-- get packages' details -->
                                <?php
                                    $packageSql = "SELECT * FROM products ORDER BY p_date DESC";
                                    $packageRst = mysqli_query($conn, $packageSql);
        
                                    if($packageRst){
                                        if(mysqli_num_rows($packageRst) > 0){
                                            while($packageDetails = mysqli_fetch_assoc($packageRst)):
                                                $packagename = stripslashes($packageDetails['p_name']);
                                                $packageColor = stripslashes($packageDetails['p_color']);
                                                $packageDate = $packageDetails['p_date'];
                                                $packageFrom = $packageDetails['p_from'];
                                                $packageTo = $packageDetails['p_destination'];
                                                $packageOwner = $packageDetails['p_owner'];
                                                $packageCode = $packageDetails['p_code'];

                                                // get owner's name
                                                $ownerSql = "SELECT firstName, lastName FROM buyers WHERE phoneNo = $packageOwner";
                                                $ownerRst = mysqli_query($conn, $ownerSql);
                                                if($ownerRst){
                                                    $ownerDetails = mysqli_fetch_assoc($ownerRst);
                                                    $ownerFname = stripslashes($ownerDetails['firstName']);
                                                    $ownerLname = stripslashes($ownerDetails['lastName']);
                                                    $ownerName = $ownerFname . ' ' . $ownerLname;
                                                }
                                                else{
                                                    $ownerName = "error getting the reciever's name " . mysqli_error($conn);
                                                }

        
                                                echo '<tr class="tdRow">';
                                                echo '<td>' . $packagename . '</td>';
                                                echo '<td>' . $packageColor . '</td>';
                                                echo '<td>' . $packageDate . '</td>';
                                                echo '<td>' . $packageFrom . '</td>';
                                                echo '<td>' . $packageTo . '</td>';
                                                echo '<td>' . $ownerName . '</td>';
                                                echo '<td>' . $packageCode . '</td>';
                                                echo '</tr>';
                                            
                                            endwhile;
                                        }
                                        else{
                                            echo '<tr>
                                                <td colspan = "7" style="opacity: 0.6;">No delivered Packages</td>
                                            </tr>';
                                        }
                                    }
                                    else{
                                        echo '<script>
                                            alert("error getting buyer\'s details");
                                        </script>';
                                    }
                                
                                ?>
                               
                                <tr>
                                    <td colspan="7" style="border: none;"><a class="btn" href="allDevices.php#cpu" style="border-radius: 0px; padding: 5px; background-color: white; color: rgb(231, 97, 120); font-weight: bold;">View more</a></td>
                                </tr>
                                <tr id="packageitemNotFound">
                                    <td colspan="7" style="border: none; opacity: 0.5;"><p>no item found</p></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        // script to handel customer search
        document.getElementById('buyer').addEventListener('input', function(){
            var searchedBuyer = this.value.toLowerCase();
            var buyerRows = document.querySelectorAll('#buyerTable tbody tr');
            var foundItem = false;

            buyerRows.forEach(function(row){
                var rowData = row.textContent.toLowerCase();
                if(rowData.includes(searchedBuyer)){
                    row.style.display = "table-row";
                    foundItem = true;
                }
                else{
                    row.style.display = "none";
                }
            });

            if(foundItem){
                document.getElementById('itemNotFound').style.display = "none";
            }
            else{
                document.getElementById('itemNotFound').style.display = "table-row";
            }
        });


        // script to handle package search
        document.getElementById('package').addEventListener('input', function(){
            var searchedPackage = this.value.toLowerCase();
            var packageRows = document.querySelectorAll('#packageTable tbody tr');
            var foundItem = false;

            packageRows.forEach(function(row){
                var rowData = row.textContent.toLowerCase();
                if(rowData.includes(searchedPackage)){
                    row.style.display = "table-row";
                    foundItem = true;
                }
                else{
                    row.style.display = "none";
                }
            });

            if(foundItem){
                document.getElementById('packageitemNotFound').style.display = "none";
            }
            else{
                document.getElementById('packageitemNotFound').style.display = "table-row";
            }
        });

    </script>

    <!-- external js -->
    <script src="js/script.js"></script>
</body>
</html>
