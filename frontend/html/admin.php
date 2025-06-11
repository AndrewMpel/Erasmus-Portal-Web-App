<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erasmus Portal</title>
    <link rel="stylesheet" href="../styles/MainStyle.css">
    <link rel="stylesheet" href="../styles/profile.css">
</head>
<body>
    <div class="Admin">
        
        <div class="LogButtons">
            <?php if (isset($_SESSION['username'])): ?>
                <button class="LogBtn">
                    <a href="../../backend/logout.php" class="NavLinks">Log Out</a>
                </button>
                <button class="LogBtn">
                    <a href="../html/sign-up.html" class="NavLinks">Sign Up</a>
                </button>
            <?php else: ?>
                <button class="LogBtn">
                    <a href="../html/login.html" class="NavLinks">Log In</a>
                </button>
                <button class="LogBtn">
                    <a href="../html/sign-up.html" class="NavLinks">Sign Up</a>
                </button>
            <?php endif; ?>
        </div>
        <div class="header">
            <img src="../media/uoplogo.png" alt="Logo" class="logo">
            <h1>Erasmus Portal</h1>
            
        </div>
        <div class="Navbar">
             <button class="Navbuttons"><a href="../html/index.php" class="NavLinks">Αρχική</a></button>
            <button class="Navbuttons"><a href="../html/reqs.html" class="NavLinks">Απαιτήσεις</a></button>
            <button class="Navbuttons"><a href="../html/application.php" class="NavLinks">Αίτηση</a></button>
            <button class="Navbuttons"><a href="../html/more.html" class="NavLinks">Περισσότερα</a></button>
            <?php 
                include '../../backend/db.php';
                $sql = "SELECT * FROM users WHERE is_admin = 1";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if (isset($_SESSION['username']) && $_SESSION['username'] == $row['username']) {
                           echo '<button class="Navbuttons"><a href="../html/admin.php" class="NavLinks">Διαχείριση</a></button>';
                            break;
                        }
                    }
                }
            ?>
        </div>
        <div class="content">
            <h1 style="text-align:center;">Διαχείρηση</h1>
            <form class="form">
                <h2>Περιοδος δηλώσεων<h2>
                <table class="reqs-table">
                    <tr>
                        <td><input type="text" id="start" name="start" placeholder="Αρχή" ></td>
                        <td><input type="text" id="end" name="end" placeholder="Τέλος" ></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right;">
                            <button type="submit" class="submit-button">Καθορισμός</button>
                        </td>
                    </tr>
                      
                </table>
            </form>
        </div>
        
        <div class="footer">
            <img src="../media/LogoFooter.png" alt="Logo" class="uoplogo">
            <img src="../media/erasmus.jpg" alt="Logo" class="ErasmusLogo">
        </div>
    </div>
        
    
    
</body>
</html>