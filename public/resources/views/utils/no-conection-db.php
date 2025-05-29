<?php require_once "../../../../config/conection.php"; ?>
<?php
    // Check if the database connection is successful
    if ($conexion) {
        // If the connection fails, display an error message
        header("Location: ../../../../index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Connection Error</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f6fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 90%;
        }
        .icon {
            font-size: 4rem;
            color: #e74c3c;
            margin-bottom: 1rem;
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 1rem;
        }
        p {
            color: #7f8c8d;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }
        .btn {
            background-color: #3498db;
            color: white;
            padding: 0.8rem 1.5rem;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            display: inline-block;
        }
        .btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">⚠️</div>
        <h1>Database Connection Error</h1>
        <p>We're unable to establish a connection to the database at the moment. This might be due to maintenance or temporary technical issues.</p>
        <p>Please try again later or contact the system administrator if the problem persists.</p>
    </div>
</body>
</html>