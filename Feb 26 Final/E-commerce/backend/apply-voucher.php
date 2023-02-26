<?php
    session_start();

    $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/backend/database-connection.php";
            include_once($path);

    if ($_POST['voucher-input']) {
        $voucher = $_POST['voucher-input'];

        $statement = $connection->prepare("SELECT * FROM vouchers WHERE code = ?");
        $statement->bind_param("s", $voucher);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            if ($row['status'] == "Available") {
                $percentageValue = $row['percentageValue'];
                $computeVoucher = round($_SESSION['GrandTotalPrice'] * $percentageValue / 100, 2);

                $_SESSION['voucherError'] = false;
                $_SESSION['voucherValue'] = $computeVoucher;
                $_SESSION['voucherCode'] = $voucher;
                $_SESSION['voucherPercentage'] = $percentageValue;
            ?>
                
                <form id="voucher-form" action="/frontend/checkout.php" method="post">
                    <input type="hidden" name="voucher-redeemed" value="<?php echo $_SESSION['voucherValue']?>">
                </form>

                <script>
                    document.getElementById('voucher-form').submit();
                </script>
            <?php 
                exit; } 
            ?>

    <?php } 
            else{
                $_SESSION['voucherError'] = true;
                header("Location: /frontend/checkout.php");
            }
        ?>
<?php } 
    // if error occurs do voucher error and send back to checkout
    $_SESSION['voucherError'] = true;
    header("Location: /frontend/checkout.php");
    exit;
?>
    


