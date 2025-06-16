<?php
    session_start();

    if(!isset($_SESSION['username'])){
        header("Location: ../html/login.html");
        exit();
    }
    require "../../backend/profileData.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../styles/profile.css">
    <link rel="stylesheet" href="../styles/MainStyle.css">
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
            <?php if ($_SESSION['canApply']): ?>
                <button class="Navbuttons"><a href="../html/application.php" class="NavLinks">Αίτηση</a></button>
            <?php else: ?>
                <button class="Navbuttons" disabled style="opacity: 0.5; cursor: not-allowed;">Αίτηση</button>
            <?php endif; ?>
            <button class="Navbuttons"><a href="../html/more.php" class="NavLinks">Περισσότερα</a></button>
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
            <div class="form-wrapper">
            <form class="form" id="profile" method="post">
                <h1>Προφίλ Χρήστη</h1>
                <table class="form-table">
                    <tr>
                        <td>
                            <label class="nums">Ονομα: <span id="currentName"><?php echo htmlspecialchars($name ?? ''); ?></span></label>
                        </td>
                        <td>
                            <input type="text" id="name" name="name" placeholder="Όνομα">
                        </td>
                    </tr>
                    <tr>
                        <td><label class="nums">Επώνυμο: <span id="currentSurname"><?php echo htmlspecialchars($surname ?? ''); ?></span></label></td>
                        <td>
                            <input type="text" id="surname" name="surname" placeholder="Επώνυμο">
                        </td>
                    </tr>
                    <tr>
                        <td><label class="nums">Αριθμός Μητρώου: <span id="currentAM"><?php echo htmlspecialchars($student_id ?? ''); ?></span></label></td>
                        <td>
                            <input type="number" id="AM" name="AM" placeholder="Αριθμός Μητρώου">
                        </td>
                    </tr>
                    <tr>
                        <td><label class="nums">Email: <span id="currentEmail"><?php echo htmlspecialchars($email ?? ''); ?></span></label></td>
                        <td>
                            <input type="email" id="email" name="email" placeholder="Email">
                        </td>
                    </tr>
                    <tr>
                        <td><label class="nums">Τηλέφωνο: <span id="currentPhone"><?php echo htmlspecialchars($phone ?? ''); ?></span></label></td>
                        <td>
                            <input type="text" id="phone" name="phone" placeholder="Τηλέφωνο">
                        </td>
                    </tr>
                    <tr>
                        <td><label class="nums">Κωδικός: *****</label></td>
                        <td>
                            <input type="password" id="password" name="password" placeholder="Νέος Κωδικός">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right;">
                            <div class="form-control">
                                <small id="formMessage"></small><br>
                                <button type="submit" class="submit-button" id="change" name="change">Αλλαγή</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
            </div>
        </div>
        <div class="footer">
            <img src="../media/LogoFooter.png" alt="Logo" class="uoplogo">
            <img src="../media/erasmus.jpg" alt="Logo" class="ErasmusLogo">
        </div>
    </div>

    <script src="../javascript/profile.js"></script>
</body>
</html>