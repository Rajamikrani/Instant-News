<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Grid Layout</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            display: grid;
            grid-template-rows: 10% auto 10%; /* Header, content, footer */
            grid-template-columns: 20% auto; /* Sidebar, content */
            height: 100vh; /* Full viewport height */
            width: 100%;
        }

        .header {
            grid-column: 1 / 3; /* Span across both columns */
        }

        .sidebar {
            grid-row: 2 / 3; /* Occupy only the second row */
            background-color: yellow;
        }

        .content {
            grid-row: 2 / 3; /* Same row as the sidebar */
            grid-column: 2 / 3; /* Second column */
            background-color: orange;
        }

        .footer {
            grid-column: 1 / 3; /* Span across both columns */
            background-color: purple;
        }

     
    </style>
</head>
<body>
    <div class="header">
        <?php
        include "header.php";
        ?>
    </div>
    <div class="sidebar"></div>
    <div class="content"></div>
    <div class="footer"></div>
</body>
</html>
