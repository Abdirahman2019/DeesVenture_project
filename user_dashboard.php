<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dees Venture</title>
    <style>
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            padding-top: 20px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            padding: 10px 20px;
            border-bottom: 1px solid #555;
            position: relative; /* Make parent relative for absolute positioning */
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #fff;
            display: block;
        }

        .sidebar ul li:hover {
            background-color: #555;
        }

        /* Submenu styles */
        .submenu {
            display: none;
            position: absolute;
            top: 0;
            left: 100%;
            background-color: #444;
            min-width: 150px;
        }

        .sidebar ul li:hover .submenu {
            display: block;
        }

        .submenu ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .submenu ul li {
            border-bottom: 1px solid #555;
            padding: 10px;
        }

        .submenu ul li a {
            color: #fff;
            text-decoration: none;
            display: block;
        }

        .submenu ul li:hover {
            background-color: #555;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li>
                <a href="#">Agent:</a>
                <div class="submenu">
                    <ul>
                        <!--<li><a href="index3.php">New Agent</a></li>-->
                        <li><a href="list_agent.php">List of Agent</a></li>
                        <li><a href="retrieve_data.php">Daily_Transaction_of agents</a></li>
                        <li><a href="submit_transaction.php">New Transaction Record</a></li>
                        <!--<li><a href="mydata.php">Manage Agent</a></li>-->
                    </ul>
                </div>
            </li>
            <!--<li>
                <a href="#">T.Type:</a>
                <div class="submenu">
                    <ul>
                        <li><a href="add_new_t_type.html">Add New T.Type</a></li>
                        <li><a href="more_advance.html">Manage T.Type</a></li>
                        <li><a href="t_type.html">Com_Rate</a></li>
                    </ul>
                </div>
            </li>-->
            <li>
                <a href="#">Source of income:</a>
                <div class="submenu">
                    <ul>
                        <li><a href="#">Vista Bank</a></li>
                        <li><a href="#">Archway</a></li>
                        <li><a href="#">Royal Ark</a></li>
                        <li><a href="#">Dees Venture</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="agent_report.html">Report</a></li>
            <li><a href="logout.php">user</a></li>
            <!--<li><a href="#">Users</a>
                <div class="submenu">
                    <ul>
                        <li><a href="register.php">Add New User</a></li>
                        <li><a href="#">Manage User</a></li>
                        
                    </ul>
                </div>



            </li>-->
        </ul>
    </div>

    <!--<div class="content">
        <h1>Welcome to Our Deesventure Capital limited</h1>
        <p>This is the main content area. You can add your content here.</p>
    </div>-->
</body>
</html>
