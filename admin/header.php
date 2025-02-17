<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="header.css">
    <title>Modify User</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }           
                        
        #header_container {
            position: fixed;
            width: 100%;
            height: 60px;
            background-color: #041f43;      
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        #logo_div {
            display: flex;
            align-items: center;
        }

        #logo_img {
            width: 80px;
            height: 60px;
        }
/* 
        #search_container {
            flex-grow: 1;
            display: flex;
            justify-content: center;
        }

        .search-bar {
            width: 250px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 25px;
            font-size: 16px;
            outline: none;
            transition: border 0.3s ease;
        }

        .search-bar:focus {
            border-color: #4CAF50;
        } */

        #logout_div i {
            color : white;
        }

        #logout_div {
            display: flex;
            align-items: center;
        }

        #logout_img {
            width: 30px;
            height: 30px;
            padding: 5px;
            cursor: pointer;
        }

        #logout_img:hover {
            background-color: #ddd;
            border-radius: 50%;
            transition: background-color 0.3s;
        }

        /* #suggestions {
            margin-top:10px;
            width: 250px;
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
            display: none;
            position: absolute;
            background: white;
            z-index: 1000;
        }

        #suggestions ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        #suggestions ul li {
            padding: 8px;
            cursor: pointer;
        }

        #suggestions ul li:hover {
            background: #f0f0f0;
        } */

        @media screen and (max-width: 768px) {
            #logo_container {
                flex-direction: column;
                align-items: center;
                height: auto;
                padding: 10px;
            }

            .search-bar {
                width: 80%;
            }
        }
    </style>
</head>
<body>

<header id="header_container">
        <div id="logo_div">
            <img id="logo_img" src="logo_1.jpg" alt="logo">
        </div>
        <!-- <div id="search_container">
            <i class = "fas fa search"></i>
            <input type="text" id = "search" class="search-bar" placeholder="Search...">
            <div id="suggestions"></div>
    
        </div> -->
        <div id="logout_div">
             <a href="logout.php"><i class = "fas fa-user"></i></a>
        </div>
</header>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        $(document).ready(function () {
            $('#search').on('input', function () {
                const query = $(this).val();
                if (query.length >= 3) {
                    $.ajax({
                        url: 'search_backend.php',
                        method: 'POST',
                        data: { query: query },
                        success: function (data) {
                            $('#suggestions').html(data).show();
                        }
                    });
                } else {
                    $('#suggestions').hide();
                }
            });

            // Handle clicking on a suggestion
            $(document).on('click', '#suggestions ul li', function () {
                $('#search').val($(this).text());
                $('#suggestions').hide();
            });
        });
    </script> -->


</body>
</html>
