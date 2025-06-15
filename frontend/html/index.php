<?php
    session_start();
    include '../../backend/db.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erasmus Portal</title>
    <link rel="stylesheet" href="../styles/MainStyle.css">
</head>
<body>
    <div class="container">
        
        <div class="LogButtons">
            <?php if (isset($_SESSION['username'])): ?>
                <!-- <button class="LogBtn">
                    <a href="../../backend/logout.php" class="NavLinks">Log Out</a>
                </button> -->
                <a href="../html/profile.php"><img src="../media/pfp.png" class="pfp"></a>
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
        <?php include 'NavBar.php'; ?>
        <div class="content">
            <h2>Καλώς ήρθατε στην Πύλη Erasmus</h2>
            <p>Η Πύλη Erasmus είναι εδώ για να σας βοηθήσει να ενημερωθείτε για το πρόγραμμα Erasmus και να υποβάλετε τις αιτήσεις σας για συμμετοχή. Εδώ μπορείτε να βρείτε όλες τις πληροφορίες που χρειάζεστε, από τις απαιτήσεις μέχρι τις διαδικασίες αίτησης.</p>
            <h3>Τι είναι το Πρόγραμμα Erasmus;</h3>
            <p>Το πρόγραμμα Erasmus είναι μια εκπαιδευτική πρωτοβουλία της Ευρωπαϊκής Ένωσης που επιτρέπει στους φοιτητές να σπουδάσουν ή να πραγματοποιήσουν πρακτική άσκηση σε χώρες της Ε.Ε. και άλλες συμμετέχουσες χώρες. Το πρόγραμμα στοχεύει στην ενίσχυση της διεθνούς συνεργασίας και στην ανάπτυξη προσωπικών και επαγγελματικών δεξιοτήτων.</p>
            
            <h3>Γιατί να Συμμετάσχετε;</h3>
            <ul>
                <li>Ανακαλύψτε νέες κουλτούρες και γλώσσες</li>
                <li>Ενισχύστε το βιογραφικό σας</li>
                <li>Αναπτύξτε διεθνείς σχέσεις και δικτύωση</li>
            </ul>
            
            <img src="../media/img1.jpg" alt="Erasmus" class="img1">
            <img src="../media/erasmus2.jpg" alt="Erasmus" class="img2">
        </div>
        
        <div class="footer">
            <img src="../media/LogoFooter.png" alt="Logo" class="uoplogo">
            <img src="../media/erasmus.jpg" alt="Logo" class="ErasmusLogo">
        </div>
        <div class="News">
            
            <h4 class="NewsTitle">Σημαντικές Ενημερώσεις</h4>
            <h5 class="NewsContent">Δεν υπάρχουν διαθέσιμες ενημερώσεις</h5>

        </div>
    </div>
        
    
    
</body>
</html>