<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syncup | Messages</title>
    <style>
        body{
            background-color: rgb(238, 238, 237);
        }
        button{
            width: 8%;
            height: 40px;
            background-color: cadetblue;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }
        button a{
            text-decoration: none;
            color: white;
            font-size: 14px
        }
        .inbox-area {
            border: none;
            border-radius: 10px;
            margin-left: 27%;
            padding: 2%;
            width: 40%;
            background: white; 
            padding-left: 8%; 
        }
        .inbox-area h1{
            font-size: 45px;
            font-family: "Helvetica Neue", Arial, sans-serif;
        }
        .inbox-area button{
            width: 20%;
            height: 48px;
        }
        .inbox-area input{
            width: 60%;
            height: 30px;
            border: 1px solid grey;
            border-radius: 10px;
            padding: 1%;
            outline: none;
            font-size: 14px;
        }


    </style>
</head>
<body>
    <button><a href="homePage.php">Back</a></button>
    <div class="inbox-area">
        <h1>Inbox</h1>
        <br>
        <input type="text" placeholder="Search.."/>
        <button>Search</button>
        <br>
    </div>
</body>
</html>