<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>hotel_reservation</title>
      <link rel="stylesheet" href="style.css">
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
      <style>
         /* Add custom styles for the fixed sidebar */
         .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 250px; /* Adjust the width as needed */
            background-color: #333;
            overflow-y: auto;
         }
         .content {
            margin-left: 250px; /* Match the width of the sidebar */
            padding: 20px; /* Add some padding to the content area */
         }
         body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('home.png') no-repeat center center fixed;
            background-size: cover;
            position: absolute;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 50px;
            display: flex;
            align-items: flex-start;
        }

        img.logo {
            width: 125px;
            height: 125px;
            position: absolute;
            top: 30px;
            left: 40px;
        }

        .app-title {
            font-family: 'Times New Roman', Times, serif;
            font-size: 60px;
            font-weight: bold;
            color: #211b1b;
            position: absolute;
            top: 5px;
            left: 180px;
        }

        .app-description {
            background-color: rgba(252, 247, 249, 0.9);
            border-radius: 15px;
            font-size: 19px;
            color: #583838;
            display: inline-block;
            height: 200px;
            width: 500px;
            margin-top: 150px;
            padding: 25px;
            position: relative;
            left: 20px;
        }

        .end {
            font-size: 30px;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode';
            text-align: center;
            margin-top: 20px;
        }

        .top-buttons {
            position:fixed;
            top: 30px;
            right:60px;
           
        }

        button{
            padding:15px;
            border-radius:10px;
            color:rosybrown;
        }

        .top-buttons a {
            font-size: 50px;
            color: #8d7285;
            text-decoration: none;
            margin: 0 10px;
        }

        h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 28px;
            color: #333;
        }

        p {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
        }

        ul {
            list-style-type: disc;
            margin-left: 20px;
            color: #666;
        }

        li {
            margin-bottom: 5px;
        }
        .home-image {
            height: 100%;
            width: 90%;
            margin-left: 10%;

        }
      </style>
   </head>
   <body>
      <div class="btn">
         <span class="fas fa-bars"></span>
      </div>
      <div >
        <div id="carouselExampleIndicators" class="carousel slide home-image" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1514933651103-005eec06c04b?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1517840901100-8179e982acb7?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="d-block w-100" alt="...">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <nav class="sidebar">
            <div class="text">
                home
            </div>
            <ul>
                <li><a href="hotel1.php">Hotel</a></li>
                <li><a href="guest1.php">Guest</a></li>
                <li><a href="plan1.php">Plan</a></li>
                <li><a href="reservation1.php">Reservation</a></li>
                <li><a href="refund1.php">Refund</a></li>
                <li><a href="admin1.php">StayHistory</a></li>
                <li><a href="employee1.php">Employee</a></li>
                <li><a href="feedback1.php">Feedback</a></li>
                <li><a href="contact.php">Contact us</a></li>
                <li><a href="about.php">About us</a></li>

            </ul>
        </nav>
      </div>
      <script> 
         $('.btn').click(function(){
           $(this).toggleClass("click");
           $('.sidebar').toggleClass("show");
         });
           $('.feat-btn').click(function(){
             $('nav ul .feat-show').toggleClass("show");
             $('nav ul .first').toggleClass("rotate");
           });
           $('.serv-btn').click(function(){
             $('nav ul .serv-show').toggleClass("show1");
             $('nav ul .second').toggleClass("rotate");
           });
           $('nav ul li').click(function(){
             $(this).addClass("active").siblings().removeClass("active");
           });
      </script>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
   </body>
</html>
