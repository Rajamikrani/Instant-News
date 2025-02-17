<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel with Icons</title>
  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="sidebar.css">
  <style>
   
/* General Reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  background-color: #f8f9fa;
}

/* Sidebar */
.sidebar {
  margin-top: 60px;
  width: 250px;
  height: calc(100vh - 60px);
  background-color: #041f43;
  position: fixed;
  color: #ecf0f1;
  display: flex;
  flex-direction: column;
  padding: 20px;
}

.sidebar h2 {
  margin-bottom: 20px;
}

.sidebar ul {
  list-style: none;
}

.sidebar ul li {
  margin: 15px 0;
  display: flex;
  align-items: center;
}

.sidebar ul li a {
  color: #ecf0f1;
  text-decoration: none;
  font-size: 20px;
  margin-left: 12px;
}

.sidebar ul li a:hover {
  color: #3498db;
}

.sidebar ul li i {
  font-size: 22px;
}



@media screen and (max-width : 1040px) {
  .sidebar {
    display: none;
    width: 0px;
  }
}

 
  </style>
</head>
<body>
  <div class="sidebar">
    <h2>Dashboard</h2>
    <ul>
      <li><i class="fas fa-home"></i><a href="users.php">Home</a></li>
      <li><i class="fas fa-users"></i><a href="editors.php">Reporters</a></li>
      <li><i class="fas fa-list"></i><a href="category.php">Category</a></li>
    </ul>
  </div>
</body>
</html>