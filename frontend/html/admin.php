<?php
    session_start();
    include '../../backend/db.php';
    $startDate = "";
    $endDate = "";
    $sql = "SELECT start, end FROM application_period ORDER BY start DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $startDate = $row['start'];
        $endDate = $row['end'];
    }
?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erasmus Portal</title>
    <link rel="stylesheet" href="../styles/MainStyle.css">
    <link rel="stylesheet" href="../styles/profile.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
            <h1 style="text-align:center;">Διαχείριση</h1>

            <!-- Περίοδος Δηλώσεων -->
            <form class="form" id="periodForm" method="post" action="../../backend/AdminData.php">
                <h2>Περίοδος Δηλώσεων</h2>
                <table class="reqs-table">
                    <tr>
                        <td><input type="text" id="start" name="start" placeholder="Αρχή" value="<?php echo htmlspecialchars($startDate); ?>"></td>
                        <td><input type="text" id="end" name="end" placeholder="Τέλος" value="<?php echo htmlspecialchars($endDate); ?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right;">
                            <button type="submit" class="submit-button">Καθορισμός</button>
                            <div id="periodMessage" style="margin-top: 10px; color: green;"></div>
                        </td>
                    </tr>
                </table>
            </form>

            <!-- Εμφάνιση Δηλώσεων -->
            <form class="form" method="post" action="admin.php">
                <h2>Δηλώσεις</h2>
                <table class="reqs-table">
                    <tr>
                        <td>
                            <select id="filter" name="filter">
                                <option value="1" disabled selected>Φίλτρο</option>
                                <option value="2">Εμφάνιση όλων κατά φθίνουσα σειρά</option>
                                <option value="3">Καθορισμός ελάχιστου ποσοστού επιτυχίας</option>
                                <option value="4">Έμφάνιση αιτήσεων συγκεκριμένου πανεπιστημίου</option>
                            </select>
                        </td>
                        <td><input type="text" id="filterText" name="filterText" placeholder="..." ></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <button type="submit" class="submit-button" name="showApp">Εμφάνιση Δηλώσεων</button>
                        </td>
                    </tr>
                </table>

                <?php
                    if (isset($_POST['showApp'])) {
                        $sql = "SELECT 
                                    applications.*, 
                                    users.name, 
                                    users.surname 
                                FROM applications
                                INNER JOIN users ON applications.user_id = users.id";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<table class='requirements-table' border='1'>";
                            echo "<tr><th>Όνομα</th><th>Επίθετο</th><th>Μέσος Όρος</th><th>Επίπεδο Αγγλικών</th><th>Άλλη Γλώσσα</th></tr>";
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['surname']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['average']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['english_level']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['other_langs']) . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "<p>Δεν υπάρχουν αιτήσεις.</p>";
                        }
                    }
                ?>
            </form>
        </div>

        <div class="footer">
            <img src="../media/LogoFooter.png" alt="Logo" class="uoplogo">
            <img src="../media/erasmus.jpg" alt="Logo" class="ErasmusLogo">
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#start", { dateFormat: "Y-m-d" });
        flatpickr("#end", { dateFormat: "Y-m-d" });

        document.getElementById("periodForm").addEventListener("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch(this.action, {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById("periodMessage").textContent = "Οι αλλαγές αποθηκεύτηκαν επιτυχώς!";
            })
            .catch(error => {
                document.getElementById("periodMessage").textContent = "Σφάλμα κατά την αποθήκευση.";
                console.error("Error:", error);
            });
        });
    </script>
</body>
</html>
