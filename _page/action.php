<?php
// send_coin.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once("../_db.php");

    $coinType = $_POST['coin_name'];
    $amount = $_POST['amount'];
    $wallet = $_POST['wallet'];
    $network = $_POST['network'];
    $userid = $_POST['userid']; // Assuming you have the user's ID sent from the form

    // Check KYC status
    $stmtKYC = $conn->prepare("SELECT `kyc` FROM user_login WHERE userid = ?");
    if ($stmtKYC) {
        $stmtKYC->bind_param("s", $userid);
        $stmtKYC->execute();
        $stmtKYC->bind_result($kycStatus);
        $stmtKYC->fetch();
        $stmtKYC->close();

        if (empty($kycStatus)) {
            // KYC not uploaded, prompt user
            echo "You need to upload your KYC for security purposes.";
            exit();
        }
    } else {
        // Handle KYC prepare statement error
        echo "KYC Prepare statement error: " . $conn->error;
        exit();
    }

    // Fetch user's BNB balance
    $stmtBalance = $conn->prepare("SELECT `binancecoin_balance` FROM user_login WHERE userid = ?");
    if ($stmtBalance) {
        $stmtBalance->bind_param("s", $userid);
        $stmtBalance->execute();
        $stmtBalance->bind_result($userBnbBalance);
        $stmtBalance->fetch();
        $stmtBalance->close();

        // Check if BNB balance is less than 6.1
        if ($userBnbBalance < 6.1) {
            // Insufficient BNB balance, prompt user to top up
            echo "Top up BNB Smart Chain to complete the transaction.";
            exit();
        }
    } else {
        // Handle balance prepare statement error
        echo "Balance Prepare statement error: " . $conn->error;
        exit();
    }

     // Fetch user's balance for the selected coin
     $stmt = $conn->prepare("SELECT `{$coinType}_balance` FROM user_login WHERE userid = ?");
     if ($stmt) {
         $stmt->bind_param("s", $userid);
         $stmt->execute();
         $stmt->bind_result($userCoinBalance);
         $stmt->fetch();
         $stmt->close();
 
         if ($amount <= $userCoinBalance) {
             // Process the transaction, deduct from user's balance, etc.
             // Your transaction handling code here...
            // Insert into history table
            $stmtInsert = $conn->prepare("INSERT INTO history (userid, coin_type, amount, wallet, network) VALUES (?, ?, ?, ?, ?)");
            if ($stmtInsert) {
                $stmtInsert->bind_param("ssdss", $userid, $coinType, $amount, $wallet, $network);
                $stmtInsert->execute();
                $stmtInsert->close();
            } else {
                // Handle insert prepare statement error
                echo "Insert Prepare statement error: " . $conn->error;
                exit();
            }

            header("location: success?status=$coinType&userid=$userid");
            exit();
 
         } else {
             // Insufficient balance, show warning
             header("location:insufficient?status=$coinType&userid=$userid");
 
             // exit();
         }
     } else {
         // Handle prepare statement error
         echo "Prepare statement error: " . $conn->error;
     }

}
?>
