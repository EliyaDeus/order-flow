<!-- script to handle form submssion -->
<?php
    include('conn.php');

    if(isset($_POST['submiter']))
    {
        $fname = mysqli_real_escape_string($conn, $_POST['Fname']);
        $lname = mysqli_real_escape_string($conn, ($_POST['Lname']));
        $pname = mysqli_real_escape_string($conn, ($_POST['pname']));
        $pcolor = mysqli_real_escape_string($conn, ($_POST['pcolor']));
        $from_region = mysqli_real_escape_string($conn, ($_POST['from_region']));
        $to_region = mysqli_real_escape_string($conn, ($_POST['to_region']));
        $pnum = $_POST['pnum'];
        $phone = $_POST['phone'];

        // check if the phone number already exists
        $sql = "SELECT phoneNo, firstName, lastName FROM buyers where phoneNo = $phone";
        $sqlRst = mysqli_query($conn, $sql);
        if($sqlRst){
            if(mysqli_num_rows($sqlRst) > 0){
                $userDetails = mysqli_fetch_assoc($sqlRst);
                $userFname = $userDetails['firstName'];
                $userLname = $userDetails['lastName'];

                if($userFname == $fname && $userLname == $lname){
                    // generate a unique code if phone number matches the names
                    $characters = '0123456789';
                    $uniCode = '';
                    $max = strlen($characters) - 1;

                    for($i = 0; $i < 6; $i++){
                        $uniCode .= $characters[rand(0, $max)];
                    }
                    $userCode = $uniCode;

                    // insert the package details to database
                    $insertProdSql = "INSERT INTO products (p_name, p_color, p_code, p_num, p_from, p_destination, P_owner) values (?,?,?,?,?,?,?)";

                    $insertProdStmt = mysqli_prepare($conn, $insertProdSql);
                    mysqli_stmt_bind_param($insertProdStmt, 'ssiisss', $pname, $pcolor, $userCode, $pnum, $from_region, $to_region, $phone);
                    $insertBuyerRst = mysqli_stmt_execute($insertProdStmt);

                    if($insertBuyerRst){
                        echo '<script>
                            alert("YOU HAVE SUCCESSFULLY REGISTERED A CUSTOMER DETAILS AND PACKAGE DETAILS");
                            window.location.href="seller_dash.php";
                        </script>';
                    }
                    else{
                        echo 'error registering package ' . mysqli_error($conn);
                    }
                }
                else{
                    echo '<script>
                        alert("THE PHONE NUMBER IS ALREADY REGISTERED BY SOMEONE ELSE\'S NAME. TRY USING ANOTHER PHONE NUMBER");
                        window.location.href="add_customer.php";
                    </script>';
                }
                
            }
            else{
                // generate a unique code if phone number doesn't exist
                $characters = '0123456789';
                $uniCode = '';
                $max = strlen($characters) - 1;

                for($i = 0; $i < 6; $i++){
                    $uniCode .= $characters[rand(0, $max)];
                }
                $userCode = $uniCode;

                // generate salt
                $salt = bin2hex(random_bytes(16));

                // hash the code
                $hashedCode = hash('sha256', $userCode.$salt);

                // insert the customer's credentials to database
                $insertBuyerSql = "INSERT INTO buyers (firstName, lastName, phoneNo, acc_code, real_code) values (?,?,?,?,?)";

                $insertBuyerStmt = mysqli_prepare($conn, $insertBuyerSql);
                mysqli_stmt_bind_param($insertBuyerStmt, 'ssssi', $fname, $lname, $phone, $hashedCode, $userCode);
                $insertBuyerRst = mysqli_stmt_execute($insertBuyerStmt);
                
                if($insertBuyerRst){
                    // inster the package details to database
                    $insertProdSql = "INSERT INTO products (p_name, p_color, p_code, p_num, p_from, p_destination, P_owner) values (?,?,?,?,?,?,?)";

                    $insertProdStmt = mysqli_prepare($conn, $insertProdSql);
                    mysqli_stmt_bind_param($insertProdStmt, 'ssiisss', $pname, $pcolor, $userCode, $pnum, $from_region, $to_region, $phone);
                    $insertBuyerRst = mysqli_stmt_execute($insertProdStmt);

                    if($insertBuyerRst){
                        echo '<script>
                            alert("YOU HAVE SUCCESSFULLY REGISTERED A CUSTOMER\'S DETAILS AND PACKAGE DETAILS");
                            window.location.href="seller_dash.php";
                        </script>';
                    }
                    else{
                        echo 'error registering package ' . mysqli_error($conn);
                    }
                }
                else{
                    echo 'error registering customer, try again later';
                }
            }
        }
        else{
            echo 'error checking for phone number ' . mysqli_error($conn);
        }

    }

    

?>