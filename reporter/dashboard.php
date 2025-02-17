<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        .container {
            display: grid;
            height: 100vh;
            width: 100vw;
            /* grid-template-rows: repeat(4 , 1fr);
            grid-template-columns: repeat(3 , 1fr); */
            /* row-gap: 0.5rem;
            column-gap: 0.5rem; */
        }
      
        .header {
            background-color: blue;
            grid-column-start: 1;
            grid-column-end: 4;
            padding: 0.5rem;
            
        }
        .sidebar {
            background-color: green;
            grid-row-start: 2;
            grid-row-end: 4;
            padding: 1rem;
        }
        .content {
            background-color: orange;
            grid-column-start:2;
            grid-column-end:4;
            padding: 3rem;
        }
        
        .content1 {
            background-color: yellow;
            padding: 3rem;
        }
        .content2 {
            background-color: red;
            padding: 3rem;
        }
        .footer {
            background-color: purple;
            grid-column-start: 1;
            grid-column-end: 4;
            padding: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
   <div class="header">
       
   </div>
   <div class="sidebar">
  
   </div>
   <div class="content">Content</div>
   <div class="content1">Content 1</div>
   <div class="content2">Content 2</div>
   <div class="footer">Footer</div>

</div>
</body>
</html>