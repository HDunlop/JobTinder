<main>
  <h1>Edit your details</h1>
  <p>Import from LinkedIn</p>
  <form action="#">
    <input type="submit" value="Import" />
  </form>
  <p>Or Add Yourself</p>
  <form action="includes/EditDetails.inc.php" method="post">
    //Basic Info
    <strong>Basics</strong><br>
    Full Name<br>
    <input type="text" name="uFullName" placeholder="Harry Potter"><br>
    Current Role Description<br>
    <input style="width: 340px;" type="text" name="uCurrentRole" placeholder="Software Wizard at Gringots Banks"><br>
    About You<br>
    <input style="width: 340px;" type="text" name="uAbout" placeholder="Expert in PHP, SQL.. Oh yeh and Potion brewing"><br>
    <br>
    //Info on Experience
    <strong>Past Experience</strong>
    <input style="width: 340px;" type="text" name="" placeholder="">
    <br>
    <button type="submit" name="save-submit">Save</button>
  </form>
</main>
