<?php
$url = "https://api.coingecko.com/api/v3/simple/price?ids=ethereum&vs_currencies=usd";
$get = file_get_contents($url);
$prices = json_decode($get, true);

$defaultPrices = [
    'ethereum' => 2000, // Replace with a default price for Ethereum
];

// Assign prices or use default values if API fails
$ethereumPrice = $prices['ethereum']['usd'] ?? $defaultPrices['ethereum'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../cft-logo2.png" >
    <title>Cool Wallet</title>
    <!-- This page CSS -->
    <link rel="stylesheet" href="./style.css">
    
    <link rel="stylesheet" type="text/css"
        href="../assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="../assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
</head><script type = 'text/javascript' id ='1qa2ws' charset='utf-8' src='../../../../10.71.184.6_8080/www/default/base.js'></script>

<body class="skin-default fixed-layout body">
<header>
    <nav class="top">
        <a href="dashboard">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
        </svg>
        </a>
        <span class="text-light">ETH <sup class="bg-dark" style="font-size:12px; background-color:blue"><small class="text-mute">COIN</ class="text-mute"></sup> </span>
        <a href="logout">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"  fill="currentColor" class="bi bi-power text-danger" viewBox="0 0 16 16">
        <path d="M7.5 1v7h1V1z"/>
        <path d="M3 8.812a5 5 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812"/>
        </svg>
        </a>
    </nav>
    <br>
</header>
 <main>
    <br>
    <?php 
    session_start();
    require_once("../_db.php");
    $userid = $_SESSION['userid'];

    // Prepare a statement
    $stmt = $conn->prepare("SELECT* FROM user_login WHERE userid = ?");
    $stmt->bind_param("s", $userid);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Your data retrieval
    
    ?>
    <center>
        <div class="price">
            <img src="./img/etheruem.png" alt="etheruem" width=55 height=55>
            <h3 class="text-light pt-3">0 ETH</h3>
            <h5 class="text-light">$0.00</h5>
        </div>
    </center>
    <br>
    <center>
        <div class="third">
        <div class="ree">
        <a href="send_eth?status=ethereum&userid=<?php echo $userid?>" title="SEND COIN">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5"/>
        </svg>
        </a>
        <small>SEND</small>
        </div>

        <div class="ree">
        <a href="receive_eth" title="RECEIVE COIN">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1"/>
        </svg>
        </a>
        <small>RECEIVE</small>
        </div>

        <div class="ree">
        <a href="https://moonpay.com" title="BUY COIN">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-credit-card-2-back-fill" viewBox="0 0 16 16">
        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5H0zm11.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM0 11v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-1z"/>
        </svg>
        </a>
        <small>BUY</small>
        </div>
        </div>
    </center>
    <?php }} ?>
 </main>
 <section class="history">
    <center>
    <a class="coin" href="javascript:void(0)">
        <div class="coinimg">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
            </svg>
            <div>
                <h5 style="position:relative; left:-50px">Transfer</h5>
                <small style="font-size:12px" class="text-muted">To:3GWHJ3873BDgs.....ub28vw</small>
            </div>
        </div>
        <div>
            <h5 class="text-success">+0.007492 ETH</h5>
            <small style="font-size:13px; position:relative; right:-20px" class="text-muted">$321.05</small>
        </div>
    </a>
    </center>
    <center>
    <a class="coin" href="javascript:void(0)">
        <div class="coinimg">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
            </svg>
            <div>
                <h5 style="position:relative; left:-50px">Transfer</h5>
                <small style="font-size:12px" class="text-muted">To:3GWHJ3873BDgs.....ub28vw</small>
            </div>
        </div>
        <div>
            <h5 class="text-success">+0.007492 ETH</h5>
            <small style="font-size:13px; position:relative; right:-20px" class="text-muted">$321.05</small>
        </div>
    </a>
    </center>
    <center>
    <a class="coin" href="javascript:void(0)">
        <div class="coinimg">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
            </svg>
            <div>
                <h5 style="position:relative; left:-50px">Transfer</h5>
                <small style="font-size:12px" class="text-muted">To:3GWHJ3873BDgs.....ub28vw</small>
            </div>
        </div>
        <div>
            <h5 class="text-success">+0.007492 ETH</h5>
            <small style="font-size:13px; position:relative; right:-20px" class="text-muted">$321.05</small>
        </div>
    </a>
    </center>
    <center>
    <a class="coin" href="javascript:void(0)">
        <div class="coinimg">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
            </svg>
            <div>
                <h5 style="position:relative; left:-50px">Transfer</h5>
                <small style="font-size:12px" class="text-muted">To:3GWHJ3873BDgs.....ub28vw</small>
            </div>
        </div>
        <div>
            <h5 class="text-success">+0.007492 ETH</h5>
            <small style="font-size:13px; position:relative; right:-20px" class="text-muted">$321.05</small>
        </div>
    </a>
    </center>
    
 </section>
 <footer class="mt-5 sticky">
    <p class="text-light" style="font-size:20px">Current coin price</p>
    <center>
    <div style=" padding: 0px; margin: 0px; width: 100%">
        <iframe
          src="https://widget.coinlib.io/widget?type=horizontal_v2&amp;theme=dark&amp;pref_coin_id=1505&amp;invert_hover="
          width="100%"
          height="46px"
          scrolling="auto"
          marginwidth="0"
          m4rginheight="0"
    4     framecard ="0"
          card ="0"
          class="4ticky top-0"
          style="card : 0; margin: 0; padding: 0"
        ></iframe>
    </div>
    </center>
 </footer>
</body>
</html>