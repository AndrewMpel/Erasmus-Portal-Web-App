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
    <link rel="stylesheet" href="../styles/box.css">
</head>
<body>
    <div class="Admin">
        <div class="LogButtons">
            <?php if (isset($_SESSION['username'])): ?>
                <button class="LogBtn"><a href="../../backend/logout.php" class="NavLinks">Log Out</a></button>
                <button class="LogBtn"><a href="../html/sign-up.html" class="NavLinks">Sign Up</a></button>
            <?php else: ?>
                <button class="LogBtn"><a href="../html/login.html" class="NavLinks">Log In</a></button>
                <button class="LogBtn"><a href="../html/sign-up.html" class="NavLinks">Sign Up</a></button>
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
            <form class="form" id="periodForm" method="post" action="../../backend/AdminData.php">
                <h2 class="heading">Περίοδος Δηλώσεων</h2>
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
            <form class="form" method="post" action="admin.php"  
                style="width: 95%; max-width: 1200px; margin: 20px auto; padding: 20px; background-color: #f8f8f8; border-radius: 10px;">
                <h2 class="heading">Δηλώσεις</h2>
                <table class="reqs-table">
                    <tr>
                        <td>
                            <select id="filter" name="filter" onchange="toggleFilterInput()">
                                <option value="1" disabled selected>Φίλτρο</option>
                                <option value="2">Εμφάνιση όλων κατά φθίνουσα σειρά</option>
                                <option value="3">Καθορισμός ελάχιστου ποσοστού επιτυχίας</option>
                                <option value="4">Εμφάνιση αιτήσεων συγκεκριμένου πανεπιστημίου</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" id="filterText" name="filterText" placeholder="..." style="display: block;">
                            <select name="universityId" id="universityDropdown" style="display: none;">
                                <option value="">-- Επιλογή Πανεπιστημίου --</option>
                                <?php
                                    $uni_sql = "SELECT id, name FROM universities ORDER BY name ASC";
                                    $uni_result = $conn->query($uni_sql);
                                    if ($uni_result->num_rows > 0) {
                                        while ($uni = $uni_result->fetch_assoc()) {
                                            echo "<option value=\"" . $uni['id'] . "\">" . htmlspecialchars($uni['name']) . "</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <button type="submit" class="submit-button" name="showApp">Εμφάνιση Δηλώσεων</button>
                        </td>
                    </tr>
                </table>

                <?php
                if (isset($_POST['showApp'])) {
                    $filter = $_POST['filter'] ?? '';
                    $filterText = trim($_POST['filterText'] ?? '');
                    $universityId = intval($_POST['universityId'] ?? 0);

                    $sql = "SELECT 
                                a.*, 
                                u.name, 
                                u.surname, 
                                u1.name AS uni1_name, 
                                u2.name AS uni2_name, 
                                u3.name AS uni3_name 
                            FROM applications a
                            INNER JOIN users u ON a.user_id = u.id
                            LEFT JOIN universities u1 ON a.uni_1 = u1.id
                            LEFT JOIN universities u2 ON a.uni_2 = u2.id
                            LEFT JOIN universities u3 ON a.uni_3 = u3.id";

                    if ($filter == "2") {
                        $sql .= " ORDER BY a.average DESC";
                    } elseif ($filter == "3" && is_numeric($filterText)) {
                        $sql .= " WHERE a.pass_percentage >= " . floatval($filterText);
                        $sql .= " ORDER BY a.pass_percentage DESC";
                    } elseif ($filter == "4" && $universityId > 0) {
                        $sql .= " WHERE a.uni_1 = $universityId OR a.uni_2 = $universityId OR a.uni_3 = $universityId";
                    }

                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        echo "<table class='requirements-table' border='1'>";
                        echo "<tr>
                                <th>Όνομα</th>
                                <th>Επίθετο</th>
                                <th>Μέσος Όρος</th>
                                <th>Επίπεδο Αγγλικών</th>
                                <th>Άλλη Γλώσσα</th>
                                <th>1η Επιλογή</th>
                                <th>2η Επιλογή</th>
                                <th>3η Επιλογή</th>
                                <th>Ποσοστό Επιτυχίας</th>
                                <th>Τελική Έγκριση</th>
                              </tr>";
                        while ($row = $result->fetch_assoc()) {
                            $isAccepted = ($row['is_accepted'] == 1) ? "checked" : "";
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['surname']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['average']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['english_level']) . "</td>";
                            echo "<td>" . ($row['other_langs'] ? "Ναι" : "Όχι") . "</td>";
                            echo "<td>" . htmlspecialchars($row['uni1_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['uni2_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['uni3_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['pass_percentage']) . "%</td>";
                            echo "<td>
                                    <input type='checkbox' class='accept-checkbox' data-id='" . $row['id'] . "' $isAccepted>
                                  </td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "<p>Δεν υπάρχουν αιτήσεις.</p>";
                    }
                }
                ?>
            </form>
            <div class="uni-box">
                <h2 class="heading">Εισαγωγή Πανεπιστημίου</h2>
                <table class="reqs-table">
                    <tr>
                        <td><input type="text" id="name" name="name" placeholder="Όνομα" class="uni-text"></td>
                        <td><input type="text" id="country" name="country" placeholder="Χώρα" class="uni-text"></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <button class="submit-button" onclick="createUniversity()">Εισαγωγή</button>
                        </td>
                    </tr>
                </table>
                <pre id="create-response"></pre>
                <script src="../javascript/API.js"></script>
            </div>
            <div class="uni-box">
                <h2 class="heading">Εμφάνιση πανεπιστημίου με id</h2>
                <table class="reqs-table">
                    <tr>
                        <td><input type="number" id="read-id" name="id" placeholder="id" class="uni-text"></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <button class="submit-button" onclick="getUniversityById()">Εμφάνιση</button>
                            
                        </td>
                    </tr>
                </table>
                <pre id="read-one-response"></pre>
                <script src="../javascript/API.js"></script>
            </div>
            <div class="uni-box">
                <h2 class="heading">Τροποποιηση πανεπιστημίου με id</h2>
                <table class="reqs-table">
                    <tr>
                        <td><input type="number" id="update-id" placeholder="id" class="uni-text"></td>
                        <td><input type="text" id="update-name" placeholder="Νέο ονομα" class="uni-text"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="text" id="update-country" placeholder="Νέα Χώρα" class="uni-text"></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: center;">
                            <button class="submit-button" onclick="updateUniversity()">Τροποποιηση</button>
                            
                        </td>
                    </tr>
                </table>
                <pre id="update-response"></pre>
                <script src="../javascript/API.js"></script>
            </div>
            <div class="uni-box">
                <h2 class="heading">Εμφάνιση όλων των πανεπιστημίων</h2>
                <table class="reqs-table">
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <button class="submit-button" onclick="getAllUniversities()">Εμφάνιση</button>
                        </td>
                    </tr>
                </table>
                <pre id="read-all-response"></pre>
                <script src="../javascript/API.js"></script>
            </div>
            <div class="uni-box">
                <h2 class="heading">Διαγραφή πανεπιστημίου</h2>
                <table class="reqs-table">
                    <tr>
                        <td><input type="number" id="delete-id" name="id" placeholder="id" class="uni-text"></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <button class="submit-button" onclick="deleteUniversity()">Διαγραφή</button>
                            
                        </td>
                    </tr>
                </table>
                <pre id="delete-response"></pre>
                <script src="../javascript/API.js"></script>
            </div>
        </div>

        <div class="footer">
            <img src="../media/LogoFooter.png" alt="Logo" class="uoplogo">
            <img src="../media/erasmus.jpg" alt="Logo" class="ErasmusLogo">
        </div>
    </div>

    <!-- Flatpickr & JS -->
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

        function toggleFilterInput() {
            const filter = document.getElementById("filter").value;
            const filterText = document.getElementById("filterText");
            const universityDropdown = document.getElementById("universityDropdown");

            if (filter === "4") {
                filterText.style.display = "none";
                universityDropdown.style.display = "block";
            } else {
                filterText.style.display = "block";
                universityDropdown.style.display = "none";
            }
        }

        document.querySelectorAll('.accept-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const formData = new FormData();
                formData.append('id', this.getAttribute('data-id'));
                if (this.checked) {
                    formData.append('accepted', 1);
                }

                fetch('../../backend/update_acceptance.php', {
                    method: 'POST',
                    body: formData
                })
                .then(resp => resp.text())
                .then(data => console.log("Saved:", data))
                .catch(error => console.error("Error:", error));
            });
        });
    </script>
</body>
</html>
