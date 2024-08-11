<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SyncUp - Sign In Form</title>
    <link rel="Stylesheet" href="SignIn.css">
</head>
<body>
    <form action="SignInForm.php" method="POST">
            <h2>Create a new account</h2>
            <p id="slogan">It's quick and easy.</p>
            <hr>
                <input type="text" placeholder="First name" id="name" required/>
                <input type="text" placeholder="Surname" id="surname" required/>
                <br/>
                <input type="email" placeholder="Email address" required/>
                <br/>
                <input type="password" placeholder="New password" id="password" required/>
                <br/>
                <input type="password" placeholder="Confirm new password" id="confirm-password"  required/>
                <br/>
                <div class="dob-container">
                    <label for="dob-day">Date of birth</label>
                    <br/>
                    <select id="dob-day" name="dob-day" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                        
                    </select>
                    <select id="dob-month" name="dob-month" required>
                        <option value="Jan">Jan</option>
                        <option value="Feb">Feb</option>
                        <option value="Mar">Mar</option>
                        <option value="Apr">Apr</option>
                        <option value="May">May</option>
                        <option value="Jun">Jun</option>
                        <option value="Jul">Jul</option>
                        <option value="Aug">Aug</option>
                        <option value="Sep">Sep</option>
                        <option value="Oct">Oct</option>
                        <option value="Nov">Nov</option>
                        <option value="Dec">Dec</option>
                    </select>
                    <select id="dob-year" name="dob-year" required>
                        <option value="2006">2006</option>
                        <option value="2005">2005</option>
                        <option value="2004">2004</option>
                        <option value="2003">2003</option>
                        <option value="2002">2002</option>
                        <option value="2001">2001</option>
                        <option value="2000">2000</option>
                        <option value="1999">1999</option>
                        <option value="1998">1998</option>
                        <option value="1997">1997</option>
                        <option value="1996">1996</option>
                        <option value="1995">1995</option>
                        <option value="1994">1994</option>
                        <option value="1993">1993</option>
                        <option value="1992">1992</option>
                        <option value="1991">1991</option>
                        <option value="1990">1990</option>
                    </select>
                </div>
                <br/>
                <p class="disclamer">By clicking Sign Up, you agree to our <a href="#">Terms, PrivacyPolicy</a> and <a href="#">Cookies Policy</a>.</p>
                <br>
                <button type="submit" class="signup-btn" id="signup-btn">Sign Up</button>
                <br>
                <a href="LogInForm.php" class="logIn">Already have an account?</a>
    </form>
   
    <script src="SignIn.js"></script>
   
</body>
</html>