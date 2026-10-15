<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pemesanan Kantin Kampus</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            background-color: #f4f6f9;
            color: #333;
        }
        header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        header h1 {
            margin: 0 0 10px 0;
        }
        nav a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            margin-right: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-top: 15px;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #343a40;
            color: white;
        }
        input[type="text"], input[type="number"] {
            padding: 6px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 6px 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .pesan {
            color: #dc3545;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        <h1>Kantin Kampus</h1>
        <nav>
            <a href="index.php">Daftar Menu</a> | 
            <a href="keranjang.php">Keranjang Belanja</a>
        </nav>
    </header>