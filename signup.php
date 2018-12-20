<div id="signup-form" class="signup-form-hidden">
<h3>Registration</h3>
  <form action="includes/handlesignup.inc.php" method="post">
    <div>
      <label for="signup-fname">First name:</label>
      <input type="text" name="signup-fname" id="signup-fname">
    </div>

    <div>
      <label for="signup-lname">Last name:</label>
      <input type="text" name="signup-lname" id="signup-lname">
    </div>

    <div>
      <label for="signup-email">E-Mail:</label>
      <input type="email" name="signup-email" id="signup-email">
    </div>

    <div>
      <label for="signup-phone">Phone number:</label>
      <input type="number" name="signup-phone" id="signup-phone">
    </div>

    <div>
      <label for="signup-gender">Gender</label>
      <input type="radio" name="signup-gender" value="male">Male
      <input type="radio" name="signup-gender" value="female">Female
    </div>

    <div>
      <label for="signup-password">Password:</label>
      <input type="password" name="signup-password" id="signup-password">
    </div>

    <div>
      <label for="signup-password-repeat">Repeat password:</label>
      <input type="password" name="signup-password-repeat" id="signup-password-repeat">
    </div>

    <div>
      <button type="submit" name="signup-submit">Register</button>
    </div>
  </form>
</div>