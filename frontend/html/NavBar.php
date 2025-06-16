<?php
session_start();
$sql = "SELECT start, end FROM application_period ORDER BY start DESC LIMIT 1";
$result = $conn->query($sql);

$canApply = false;
$_SESSION['canApply'] = $canApply;
$application_message = "";
$display_date_range_for_active_period = "";

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $startDate = new DateTime($row['start']);
    $endDate = new DateTime($row['end']);
    $today = new DateTime();

    $startDateStr = $startDate->format('d/m/Y');
    $endDateStr = $endDate->format('d/m/Y');
    if ($today >= $startDate && $today <= $endDate) {
        $canApply = true;
        $_SESSION['canApply'] = $canApply;
        $display_date_range_for_active_period = "Οι ημερομηνίες για την αίτηση είναι: " . $startDateStr . " έως " . $endDateStr . ".";
    } else if ($today > $endDate) {
        $application_message = "Η προθεσμία υποβολής αιτήσεων έχει λήξει στις " . $endDateStr . ".";
    } else {

    }
} else {
    $application_message = "Δεν έχει οριστεί ακόμη περίοδος αιτήσεων.";
}

if ($conn) {
    $conn->close();
}
?>

<div class="Navbar">
    <?php
    include '../../backend/db.php';
    $final_message_to_display = "";
    if ($canApply) {
        $final_message_to_display = $display_date_range_for_active_period;
    } else {
        $final_message_to_display = $application_message;
    }

    if (!empty($final_message_to_display)):
    ?>

    <?php endif; ?>

    <button class="Navbuttons"><a href="../html/index.php" class="NavLinks">Αρχική</a></button>
    <button class="Navbuttons"><a href="../html/reqs.html" class="NavLinks">Απαιτήσεις</a></button>
    <?php if ($canApply): ?>
        <button class="Navbuttons"><a href="../html/application.php" class="NavLinks">Αίτηση</a></button>
    <?php else: ?>
        <button class="Navbuttons" disabled style="opacity: 0.5; cursor: not-allowed;">Αίτηση</button>
    <?php endif; ?>
    <button class="Navbuttons"><a href="../html/more.php" class="NavLinks">Περισσότερα</a></button>

    <?php
    $sql_admin = "SELECT * FROM users WHERE is_admin = 1";
    $result_admin = $conn->query($sql_admin);
    if ($result_admin && $result_admin->num_rows > 0) {
        while ($row_admin = $result_admin->fetch_assoc()) {
            if (isset($_SESSION['username']) && $_SESSION['username'] == $row_admin['username']) {
                echo '<button class="Navbuttons"><a href="../html/admin.php" class="NavLinks">Διαχείριση</a></button>';
                break;
            }
        }
    }

    if ($conn) {
        $conn->close();
    }
    ?>
    <div class="application-status-message-container">
        <?php echo $final_message_to_display; ?>
    </div>

</div>