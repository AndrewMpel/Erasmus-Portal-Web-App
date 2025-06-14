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
            <form class="form" method="post">
                <h2>Περιοδος δηλώσεων</h2>
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
                <h2>Δηλώσεις</h2>
                <table class="reqs-table">
                    <tr>
                        <td>
                           <select id="filter" name="filter">
                                <option value="1" disabled selected>Φιλτρο</option>
                                <option value="2">Εμφάνιση όλων κατά φθίνουσα σειρά</option>
                                <option value="3">Καθορισμός ελάχιστου ποσοστού επιτυχίας</option>
                                <option value="4">Έμφάνιση αιτήσεων συγκεκριμένού πανεπιστημίου</option>
                            </select>
                        </td>
                        <td><input type="text" id="filterText" name="filterText" placeholder="..." ></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:center;" >
                            <button type="submit" class="submit-button" name="showApp">Εμφάνιση Δηλώσεων</button>
                        </td>
                    </tr>
                    <?php
                        include '../../backend/db.php';
                        if(isset($_POST['showApp'])){
                             $sql = "SELECT 
                                    applications.*, 
                                    users.name, 
                                    users.surname 
                                FROM applications
                                INNER JOIN users ON applications.user_id = users.id";

                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    echo "<table class='requirements-table' border=\"1\">";
                                    echo "<tr><th>Όνομα</th><th>Επίθετο</th><th>Μέσος Όρος</th><th>Επιπεδο Αγγλικών</th><th>Αλλη Γλώσσα</th></tr>";
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['surname']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['average']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['english_level']) . "</td>";
                                        echo "<td>". htmlspecialchars($row["other_langs"]) . "</td>";

                                        echo "</tr>";
                                    }
                                    echo "</table>";
                                } else {
                                    echo "<p>Δεν υπάρχουν αιτήσεις.</p>";
                                }
                        }
                       
                    ?>
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