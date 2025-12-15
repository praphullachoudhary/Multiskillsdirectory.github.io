<?php
include 'db.php';
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST['role'];
    $full_name = $_POST['full_name'];
    $mobile = $_POST['mobile'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure hash
    $age = $_POST['age'];
    $place = $_POST['place'];
    
    // Handling Skills
    $skills = "";
    $rate = 0;
    $exp = 0;
    
    if($role == 'skilled') {
        if(isset($_POST['skills'])) {
            $skills = implode(", ", $_POST['skills']);
        }
        $rate = $_POST['rate'];
        $exp = $_POST['experience'];
    }

    $sql = "INSERT INTO users (full_name, mobile, password, role, age, place, skills, rate_per_day, experience) 
            VALUES ('$full_name', '$mobile', '$password', '$role', '$age', '$place', '$skills', '$rate', '$exp')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
    } else {
        $msg = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <script>
        function toggleFields() {
            var role = document.getElementById("role").value;
            var skilledDiv = document.getElementById("skilled-fields");
            if (role === "skilled") {
                skilledDiv.classList.remove("hidden");
            } else {
                skilledDiv.classList.add("hidden");
            }
        }
        
        // Auto-select dropdown based on URL param
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const roleParam = urlParams.get('role');
            if(roleParam) {
                document.getElementById('role').value = roleParam;
                toggleFields();
            }
        }
    </script>
</head>
<body>
    <nav>
        <a href="index.php">Home</a>
    </nav>
    <div class="form-container">
        <h2 style="color: #2E7D32;">Registration</h2>
        <p style="color:red;"><?php echo $msg; ?></p>
        <form method="post" action="">
            <label>I am a:</label>
            <select name="role" id="role" onchange="toggleFields()" required>
                <option value="customer">Customer / Need Help</option>
                <option value="skilled">Skilled Man / Offer Help</option>
            </select>

            <input type="text" name="full_name" placeholder="Full Name" required>
            <input type="text" name="mobile" placeholder="Mobile Number (Login ID)" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="number" name="age" placeholder="Age" required>
            <input type="text" name="place" placeholder="Place / Village" required>

            <div id="skilled-fields" class="hidden">
                <label>Select Skills:</label><br>
                <input type="checkbox" name="skills[]" value="Plumber" style="width:auto;"> Plumber
                <input type="checkbox" name="skills[]" value="Carpenter" style="width:auto;"> Carpenter
                <input type="checkbox" name="skills[]" value="Cook" style="width:auto;"> Cook
                <input type="checkbox" name="skills[]" value="Electrician" style="width:auto;"> Electrician
                
                <input type="number" name="rate" placeholder="Rate per Day (₹)">
                <input type="number" name="experience" placeholder="Experience (Years)">
            </div>

            <button type="submit" class="btn btn-offer" style="width:100%">Register</button>
        </form>
    </div>
</body>
</html>