<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="header.css">
    <title>Header</title>
   <style>
    *{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
   }

.header{
    position: fixed;
    width: 100%;
    height: 3rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #041f43;
    padding-left: 1rem;
    padding-right: 1rem;
}
img{
    width: 3rem;
    height: 2rem;
    scale: 1.5;
}

.logout  i {
    display: flex;
    width: 3rem;
    height: 2.5rem;
    color: white;
}

@media screen and (max-width:620px) {
    .container{
        display: flex;
        flex-direction: column;
        height: auto;
    }
}

@media screen and (max-width:500px) {
   .menu_div{
    display: none;
   }
}
   </style>
</head>
<body>
    <div class="header">
        <div class = "logo_div">
        <img src="../logo_1.jpg" alt="Logo">
        </div>
       <div class="logout">
       <a href="../admin/logout.php"><i class = "fas fa-user"></i></a>
       </div>
    </div>
</body>
</html>