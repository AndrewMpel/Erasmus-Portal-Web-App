<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
date_default_timezone_set('Europe/Athens');
include '../../backend/db.php';

$sql = "SELECT start, end FROM application_period ORDER BY start DESC LIMIT 1";
$result = $conn->query($sql);

$canApply = false;
$application_message = "";

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $startDate = new DateTime($row['start']);
    $endDate = new DateTime($row['end']);
    $today = new DateTime();

    if ($today >= $startDate && $today <= $endDate) {
        $canApply = true;
    } else {
        $application_message = "Η περίοδος αιτήσεων θα ειναι  είναι ενεργή αυτή τη στιγμή.";
    }
} else {
    $application_message = "Δεν έχει οριστεί ακόμη περίοδος αιτήσεων.";
}
?>


<div class="Navbar">
    <?php if (!$canApply): ?>
    <div style="background-color: #ffeeee; color: red; padding: 10px; border: 1px solid red; text-align: center; margin-bottom: 20px;">
        <?php echo $application_message; ?>
    </div>
    <?php endif; ?>

    <button class="Navbuttons"><a href="../html/index.php" class="NavLinks">Αρχική</a></button>
    <button class="Navbuttons"><a href="../html/reqs.html" class="NavLinks">Απαιτήσεις</a></button>

    <?php if ($canApply): ?>
        <button class="Navbuttons"><a href="../html/application.php" class="NavLinks">Αίτηση</a></button>
    <?php else: ?>
        <button class="Navbuttons" disabled style="opacity: 0.5; cursor: not-allowed;">Αίτηση</button>
    <?php endif; ?>

    <button class="Navbuttons"><a href="../html/more.html" class="NavLinks">Περισσότερα</a></button>

    <?php 
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
