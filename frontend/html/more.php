<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>More</title>
    <link rel="stylesheet" href="../styles/MainStyle.css">
    <link rel="stylesheet" href="../styles/forms.css">
</head>
<body>
    <div class="container">
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
            <h2>Περισσότερα για το πρόγραμμα Erasmus</h2>
            
            <p>Το πρόγραμμα Erasmus είναι ένα πρόγραμμα της Ευρωπαϊκής Ένωσης που επιτρέπει στους φοιτητές να σπουδάζουν ή να κάνουν πρακτική άσκηση σε άλλη χώρα της ΕΕ. Σκοπός του προγράμματος είναι να ενισχύσει την κινητικότητα των φοιτητών και να προάγει τη διεθνή συνεργασία στον τομέα της εκπαίδευσης.</p>
            
            <h2>Διαδικασία αίτησης</h2>
            <p>Η διαδικασία αίτησης για το πρόγραμμα Erasmus περιλαμβάνει τα εξής βήματα:</p>
            <ol>
                <li>Επικοινωνία με τον υπεύθυνο Erasmus του πανεπιστημίου σας.</li>
                <li>Συμπλήρωση της αίτησης συμμετοχής.</li>
                <li>Υποβολή των απαραίτητων δικαιολογητικών.</li>
            </ol>
            <video controls class="video" poster="../media/VideoPic.jpg">
                <source src="../media/What is Erasmus .mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="footer">
            <img src="../media/LogoFooter.png" alt="Logo" class="uoplogo">
            <img src="../media/erasmus.jpg" alt="Logo" class="ErasmusLogo">
        </div>
        <div class="News">
            <select name="documents" id="documents" class="More-select" onchange="window.open(this.value, '_blank')">
                <option value="0" disabled selected>Ενημερωτικό Υλικό</option>
                <option value="../media/ErasmusplusProgramme-Guide2023-v3_en.pdf">Erasmus Guide</option>
                <option value="../media/ΕΠΙΧΟΡΗΓΗΣΗ ΦΟΙΤΗΤΩΝ ΓΙΑ ΣΠΟΥΔΕΣ ΚΑΙ ΠΡΑΚΤΙΚΗ ΑΣΚΗΣΗ.pdf">Επιχορήγηση Φοιτητών</option>
                <option value="../media/Χάρτης φοιτητών erasmus_0.pdf">Χάρτης φοιτητών Erasmus</option>
                <option value="../media/Erasmus_IKY_INEDIVIM-Flyer_online.pdf">Γενικά για το πρόγραμμα</option>
              </select>
              <select name="unis" id="unis" class="More-select" onchange="window.open(this.value, '_blank')">
                <option value="0" disabled selected>Πανεπιστήμια</option>
                <option value="https://unige.it/en">University of Genoa - Ιταλία</option>
                <option value="https://www.ucy.ac.cy/?lang=en">University of Cyprus - Κύπρος</option>
                <option value="https://www.uvigo.gal/en">University of Vigo - Ισπανία</option>
                <option value="https://unibuc.ro/?lang=en">University of Bucharest - Ρουμανία</option>
                <option value="https://uniri.hr/en/home/">University of Rijeka - Κροατία</option>
            </select>
        </div>
        
    </div>
</body>
</html>