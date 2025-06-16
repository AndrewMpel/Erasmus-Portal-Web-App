<?php 
    session_start();

    if(!isset($_SESSION['username'])){
        header("Location: ../html/login.html");
        exit();
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
                        <td><label class="nums">1.</label></td>
                        <td>
                            <br>
                            <input type="text" id="name" name="name" placeholder="Όνομα"
                            value="<?php echo $_SESSION['name']?>" disabled required>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="nums">2.</label></td>
                        <td>
                            <br>
                            <input type="text" id="surname" name="surname" placeholder="Επώνυμο"
                            value="<?php echo $_SESSION['surname'] ?>" disabled required>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="nums">3.</label></td>
                        <td>
                            <br>
                            <input type="text" id="AM" name="AM" placeholder="Αριθμός Μητρώου"
                            value="<?php echo $_SESSION['AM']?>" disabled required>
                        </td>
                    </tr>


                        <tr>
                        <td><label for="passed_courses" class="nums">4a.</label></td>
                        <td>
                            <div class="form-control">
                            <small>Error message</small><br>
                            <input type="number" id="passed_courses" name="passed_courses" min="0" placeholder="Πλήθος περασμένων μαθημάτων">
                            
                            </div>
                        </td>
                        </tr>
                        <tr>
                        <td><label for="total_courses" class="nums">4b.</label></td>
                        <td>
                            <div class="form-control">
                            <small>Error message</small><br>
                            <input type="number" id="total_courses" name="total_courses" min="1" placeholder="Συνολικός αριθμός μαθημάτων" >
                            
                            </div>
                        </td>
                        </tr>
                        <tr>

                        <td><label class="nums">4c.</label></td>
                        <td>
                            <div class="form-control">
                            <small>Error message</small><br>
                            <input type="text" id="percentage" name="percentage" placeholder="Ποσοστό περασμένων μαθημάτων (%)" readonly>
                            </div>
                        </td>
                        </tr>

                    <tr>
                        <td><label for="5" class="nums">6.</label></td>
                        <td>
                        <div class="form-control" >
                            <small>Error message</small> <br>
                          <input type="number" min="0" max="10" id="average" name="average" step="0.01" placeholder="Μέσος όρος περασμένων μαθημάτων" >
                             
                        </div>
                         </td>
                    </tr>
                    <tr>
                        <td><label for="6" class="nums">7.</label></td>
                        <td>Πιστοποιητικό της αγγλικής γλώσσας:</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div class="form-control" >
                            <small>Error message</small><br>
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
                            
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="7" class="nums">8.</label></td>
                        <td>Γνώση επιπλέον ξένων γλωσσών:</td>
                    </tr>
                        <td></td>
                        <td>
                            <div class="form-control" >
                            <small>Error message</small><br>
                            <label for="Yes">Ναί:</label>
                            <input type="radio" id="Languages" name="languages" value="1" class="radios">
                            <label for="No">Όχι:</label>
                            <input type="radio" id="Languages" name="languages" value="0" class="radios"><br>
                            
                             </div>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="8" class="nums">9.</label></td>
                        <td>
                            <div class="form-control">
                            <small>Error message</small><br>
                            <select id="1st-Choice" name="1st-Choice" required>
                            <option value="0" disabled selected>Πανεπιστήμιο - 1η επιλογή</option>
                            <?php
                                include '../../backend/db.php';
                                $sql = "SELECT * FROM universities";

                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value=\"" . $row['id'] . "\">" . htmlspecialchars($row['name']." - ").htmlspecialchars($row['country']) . "</option>";
                                        
                                    }      
                                } else {
                                    echo "<option value=\"1\">" ."Δεν υπάρχουν διαθέσιμα πανεπιστήμια" ."</option>";
                                }
                            ?>
                        </select>
                        </div>
                    </td>

                    </tr>
                    <tr>
                        <td><label for="9" class="nums">10.</label></td>
                        <td>
                            <div class="form-control">
                             <small>Error message</small><br> 
                        <select id="2nd-Choice" name="2nd-Choice" >
                            <option value="0" disabled selected>Πανεπιστήμιο - 2η επιλογή</option>
                            <?php
                                include '../../backend/db.php';
                                $sql = "SELECT * FROM universities";

                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value=\"" . $row['id'] . "\">" . htmlspecialchars($row['name']." - ").htmlspecialchars($row['country']) . "</option>";
                                        
                                    }      
                                } else {
                                    echo "<option value=\"1\">" ."Δεν υπάρχουν διαθέσιμα πανεπιστήμια" ."</option>";
                                }
                            ?>
                         </select>
                          
                         </div>
                    </td>
                    </tr>
                    <tr>
                        <td><label for="10" class="nums">11.</label></td>
                        <td>
                        <div class="form-control" >
                          <small>Error message</small> <br>  
                        <select id="3rd-Choice" name="3rd-Choice" >
                            <option value="0" disabled selected>Πανεπιστήμιο - 3η επιλογή</option>
                            <?php
                                include '../../backend/db.php';
                                $sql = "SELECT * FROM universities";

                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value=\"" . $row['id'] . "\">" . htmlspecialchars($row['name']." - ").htmlspecialchars($row['country']) . "</option>";
                                        
                                    }      
                                } else {
                                    echo "<option value=\"1\">" ."Δεν υπάρχουν διαθέσιμα πανεπιστήμια" ."</option>";
                                }
                            ?>
                        </select>
                         
                        </div>
                    </td>
                    </tr>
                    <tr>
                        <td><label for="11" class="nums">12.</label></td>
                        <td>Ανέβασμα Αναλυτικής Βαθμολογίας:</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div class="form-control" > 
                            <small>Error message</small> <br>  
                            <input type="file" id="file" name="grades" accept=".pdf, .doc, .docx" class="file-input" >
                           
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="12" class="nums">13.</label></td>
                        <td>Ανέβασμα Πτυχίου αγγλικής γλώσσας:</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                          <div class="form-control" >
                            <small>Error message</small> <br>  
                            <input type="file" id="file" name="language_certificate" accept=".pdf, .doc, .docx" class="file-input" >
                          </div>
                        </td>
                    </tr>

                    <tr>
                        <td><label for="13" class="nums">14.</label></td>
                        <td>Ανέβασμα Πτυχίων άλλων γλωσσών:</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div class="form-control" >

                            <small>Error message</small><br>  
                            <input type="file" id="file" name="language_certificate2" accept=".pdf, .doc, .docx" class="file-input">
                           
                           </div>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="14" class="nums">15.</label></td>
                        <td>
                            <div class="form-control" >
                                <small>Error message</small> <br>  
                                Αποδοχή Όρων:
                                <input type="checkbox" id="Agree" name="Agree" require>
                           </div>
                        </td>
                    </tr>


                    <tr>
                        <td colspan="2" style="text-align: right;">
                            <button type="submit" class="submit-button">Υποβολή</button>
                        </td>
                    </tr>
                      
                </table>
                <script src="../javascript/application.js"></script>
            </form>
        </div>
        <div class="footer">
            <img src="../media/LogoFooter.png" alt="Logo" class="uoplogo">
            <img src="../media/erasmus.jpg" alt="Logo" class="ErasmusLogo">
        </div>
    </div>
</body>
</html>