<form action="includes/handlepost.inc.php" method="post">
    <label for="traveld-from">Where from are you traveling?</label>
    <input type="text" name="traveld-from" id="traveld-from"/>

    <label for="traveld-to">Where to are you traveling?</label>
    <input type="text" name="traveld-to" id="traveld-to"/>

    <label for="traveld-date">Date</label>
    <input type="date" name="traveld-date" id="traveld-date"/>

    <label for="traveld-time">Time</label>
    <input type="time" name="traveld-time" id="traveld-time"/>

    <label for="traveld-price">Price</label>
    <input type="number" name="traveld-price" id="traveld-price"/>

    <label for="traveld-seats">Seats</label>
    <input type="number" name="traveld-seats" id="traveld-seats"/>

    <input type="hidden" name="traveld-userid" id="traveld-userid" value="<?php echo $_SESSION["userId"]; ?>"/>

    <button type="submit" name="post-submit">Submit</button>
</form>