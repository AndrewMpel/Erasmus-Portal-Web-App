<?php 
    session_start();

    if(!isset($_SESSION['username'])){
        header("Location: ../html/login.html");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application</title>
    <link rel="stylesheet" href="../styles/reqs.css">
    <link rel="stylesheet" href="../styles/forms.css">
</head>
<body>
    <div class="Ap-container">
        <div class="header">
            <img src="../media/uoplogo.png" alt="Logo" class="logo">
            <h1>Erasmus Portal</h1>
            
        </div>
        <div class="content">
            
            <form class="form"  method="post" action="../../backend/application.php" enctype="multipart/form-data">
                <h1>Αίτηση για συμμετοχή στο πρόγραμμα Erasmus</h1>
                <table class="form-table">
                    <tr>
                        <td><label for="1" class="nums">1.</label></td>
                        <td>
                            <input type="text" id="name" name="name" placeholder="Όνομα" required>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="2" class="nums">2.</label></td>
                        <td>
                            <input type="text" id="surname" name="surname" placeholder="Επώνυμο" required>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="3" class="nums">3.</label></td>
                        <td>
                            <input type="text" id="AM" name="AM" placeholder="Αριθμός Μητρώου" required>
                        </td>
                    </tr>

                    <tr>
                        <td><label for="4" class="nums">4.</label></td>
                        <td><input type="number" min="0" max="100" id="passed_courses" name="passed_courses" placeholder="Ποσοστό περασμένων μαθημάτων" required></td>
                    </tr>
                    <tr>
                        <td><label for="5" class="nums">5.</label></td>
                        <td><input type="number" min="0" max="10" id="average" name="average" placeholder="Μέσος όρος περασμένων μαθημάτων" required></td>
                    </tr>
                    <tr>
                        <td><label for="6" class="nums">6.</label></td>
                        <td>Πιστοποιητικό της αγγλικής γλώσσας:</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <label for="A1">A1:</label>
                            <input type="radio" id="english" name="english" value="A1" class="radios">
                            <label for="A2">A2:</label>
                            <input type="radio" id="english" name="english" value="A2" class="radios"><br>
                            <label for="B1">B1:</label>
                            <input type="radio" id="english" name="english" value="B1" class="radios">
                            <label for="B2">B2:</label>
                            <input type="radio" id="english" name="english" value="B2"  class="radios"><br>
                            <label for="C1">C1:</label>
                            <input type="radio" id="english" name="english" value="C1" class="radios">
                            <label for="C2">C2:</label>
                            <input type="radio" id="english" name="english" value="C2" class="radios"><br>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="7" class="nums">7.</label></td>
                        <td>Γνώση επιπλέον ξένων γλωσσών:</td>
                    </tr>
                        <td></td>
                        <td>
                            <label for="Yes">Ναί:</label>
                            <input type="radio" id="Languages" name="languages" value="Yes" class="radios">
                            <label for="No">Όχι:</label>
                            <input type="radio" id="Languages" name="languages" value="No" class="radios"><br>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="8" class="nums">8.</label></td>
                        <td><select id="1st-Choice" name="1st-Choice" required>
                            <option value="1" disabled selected>Πανεπιστήμιο - 1η επιλογή</option>
                            <option value="2">Univeristy of Genova - Ιταλία &#127470;&#127481;</option>
                            <option value="3">Univeristy of Cyprus - Κύπρος &#127464;&#127486;</option>
                            <option value="4">Univeristy of Vigo - Ισπανία &#127466;&#127480;</option>
                            <option value="5">Politehnica University of Bucharest - Ρουμανία &#127479;&#127476; </option>
                            <option value="6">University of Rijeka - Κροατία &#127469;&#127479;</option>
                        </select></td>

                    </tr>
                    <tr>
                        <td><label for="9" class="nums">9.</label></td>
                        <td><select id="2nd-Choice" name="2nd-Choice" required>
                            <option value="1" disabled selected>Πανεπιστήμιο - 2η επιλογή</option>
                            <option value="2">Univeristy of Genova - Ιταλία &#127470;&#127481;</option>
                            <option value="3">Univeristy of Cyprus - Κύπρος &#127464;&#127486;</option>
                            <option value="4">Univeristy of Vigo - Ισπανία &#127466;&#127480;</option>
                            <option value="5">Politehnica University of Bucharest - Ρουμανία &#127479;&#127476; </option>
                            <option value="6">University of Rijeka - Κροατία &#127469;&#127479;</option>
                        </select></td>
                    </tr>
                    <tr>
                        <td><label for="10" class="nums">10.</label></td>
                        <td><select id="3rd-Choice" name="3rd-Choice" required>
                            <option value="1" disabled selected>Πανεπιστήμιο - 3η επιλογή</option>
                            <option value="2">Univeristy of Genoa - Ιταλία &#127470;&#127481;</option>
                            <option value="3">Univeristy of Cyprus - Κύπρος &#127464;&#127486;</option>
                            <option value="4">Univeristy of Vigo - Ισπανία &#127466;&#127480;</option>
                            <option value="5">Politehnica University of Bucharest - Ρουμανία &#127479;&#127476; </option>
                            <option value="6">University of Rijeka - Κροατία &#127469;&#127479;</option>
                        </select></td>
                    </tr>
                    <tr>
                        <td><label for="11" class="nums">11.</label></td>
                        <td>Ανέβασμα Αναλυτικής Βαθμολογίας:</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="file" id="file" name="grades" accept=".pdf, .doc, .docx" class="file-input" required>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="12" class="nums">12.</label></td>
                        <td>Ανέβασμα Πτυχίου αγγλικής γλώσσας:</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="file" id="file" name="language_certificate" accept=".pdf, .doc, .docx" class="file-input" required>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="13" class="nums">13.</label></td>
                        <td>Ανέβασμα Πτυχίων άλλων γλωσσών:</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="file" id="file" name="language_certificate2" accept=".pdf, .doc, .docx" class="file-input">
                        </td>
                    </tr>
                    <tr>
                        <td><label for="14" class="nums">14.</label></td>
                        <td>
                                Αποδοχή Όρων:
                                <input type="checkbox" id="Agree" name="Agree" required>
    
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right;">
                            <button type="submit" class="submit-button">Υποβολή</button>
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