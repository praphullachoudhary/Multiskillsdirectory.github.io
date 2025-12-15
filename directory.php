<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <div class="logo">Directory</div>
        <div>
            <a href="index.php">Home</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <div class="filters">
        <h3>Filter Skilled Workers</h3>
        <select id="filterSkill" onchange="loadData()">
            <option value="">All Skills</option>
            <option value="Plumber">Plumber</option>
            <option value="Carpenter">Carpenter</option>
            <option value="Cook">Cook</option>
            <option value="Electrician">Electrician</option>
        </select>
        <input type="text" id="filterPlace" placeholder="Filter by Place" onkeyup="loadData()" style="width: 200px;">
        <input type="number" id="filterAge" placeholder="Age" onkeyup="loadData()" style="width: 100px;">
    </div>

    <div id="results" class="card-grid">
        </div>

    <script>
        function loadData() {
            var skill = document.getElementById('filterSkill').value;
            var place = document.getElementById('filterPlace').value;
            var age = document.getElementById('filterAge').value;

            fetch(`fetch_data.php?skill=${skill}&place=${place}&age=${age}`)
                .then(response => response.json())
                .then(data => {
                    var html = '';
                    if(data.length === 0) {
                        html = '<p>No skilled workers found.</p>';
                    } else {
                        data.forEach(user => {
                            html += `
                            <div class="card">
                                <h3>${user.full_name}</h3>
                                <p><strong>Role:</strong> ${user.skills}</p>
                                <p><strong>Experience:</strong> ${user.experience} Years</p>
                                <p><strong>Rate:</strong> ₹${user.rate_per_day}/day</p>
                                <p><strong>Place:</strong> ${user.place}</p>
                                <p><strong>Age:</strong> ${user.age}</p>
                                <hr>
                                <p style="font-size:1.2em; color:#0288D1;">📞 ${user.mobile}</p>
                            </div>
                            `;
                        });
                    }
                    document.getElementById('results').innerHTML = html;
                });
        }

        // Load data immediately on page load
        loadData();

        // Auto Refresh every 30 seconds
        setInterval(loadData, 30000); 
    </script>
</body>
</html>