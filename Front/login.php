<html>
<head>
    <title>Login</title>
    <style>
    body{
      margin: 0;
      padding: 0;
      font-family: sans-serif;
      background: linear-gradient(120deg, #2980b9, #FFFAF0);
      height: 100vh;
      overflow: hidden;
    }
    .center{
      position: absolute;
      top: 50%;
      left:50%;
      transform: translate(-50%, -50%);
      width: 400px;
      background: white;
      border-radius: 10px;
      box-shadow: 20px 20px 50px grey;
    }
    .center h1{
      text-align: center;
      color: #2980b9;
      padding: 0 0 20px 0;
      border-bottom: 1px solid silver;
    }
    .center form{
      padding: 0 40px;
      box-sizing: border-box;
    }
    form .txt_field{
      position: relative;
      border-bottom: 2px solid #adadad;
      margin: 30px 0;
    }
    .txt_field input{
      width: 100%;
      paddingL 0 5px;
      height: 40px;
      font-size: 16px;
      border: none;
      background: none;
      outline: none;
    }
    .txt_field label{
      position: absolute;
      top:50%;
      left: 5px;
      color: #adadad;
      transform: translateY(-50%);
      font-size: 16px;
      pointer-events: none;
      transition: .5s;
    }
    .txt_field span::before {
      content: ' ';
      position: absolute;
      top: 40px;
      left: 0;
      width: 0%;
      height: 2px;
      background: #2691d9;
      transition: .5s;
    }
    .txt_field input:focus ~ label,
    .txt_field input:valid ~ label{
      top: -5px;
      color:#2691d9;
    }
    .txt_field input:focus ~ span::before,
    .txt_field input:focus ~ span::before{
      width: 100px;   
    }
    .pass{
      margin: -5px 0 20px 5px;
      color: #a6a6a6;
      cursor: pointer;
    }
    .pass:hover{
      text-decoration: underline;
    }
    input[type="Submit"]{
      width: 100%;
      height: 50px;
      border: 1px solid;
      background: #2691d9;
      border-radius: 25px;
      font-size:18px;
      color: #e9f4fb;
      font-weight: 700;
      cursor: pointer;
      outline:none;
    }
    input[type="submit"]:hover{
      border-color: #2691d9;
      transition: .5s;
    }
    </style>
</head> 
<body>
    <div class="center">
        <h1>Login</h1>
        <form method="post" action= "https://afsaccess4.njit.edu/~LAM62/front/front_back.php">
                <div class="txt_field">
                <input type="text" name="ucid" id="ucid" required>
                <label>UCID</label>
                </div>
                <div class="txt_field">
                <input type="password" name="password" id="password" required>
                <label>Password</label>
                </div>
          	<input type="submit" value="Submit" name="submit">
        </form>
    </div>
</body>
</html>
