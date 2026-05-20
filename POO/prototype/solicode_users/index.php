<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #0f172a;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
        }

        h1 {
            color: #e2e8f0;
            font-size: 36px;
            margin-bottom: 10px;
        }

        p {
            color: #94a3b8;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            padding: 14px 28px;
            background: #3b82f6;
            color: white;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            border-radius: 12px;
            transition: 0.3s;
        }

        .btn:hover {
            background: #2563eb;
            transform: translateY(-3px);
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Welcome</h1>
        <p>Manage your users easily</p>

        <a href="pages/liste.php" class="btn">Explore</a>
    </div>

</body>
</html>