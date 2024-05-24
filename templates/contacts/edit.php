<div class="container">
    <form method="post">
        <input value="<?= $contact->first_name; ?>" required type="text" class="mb-2 form-control" name="first_name"
               id="first_name" placeholder="First name">
        <input value="<?= $contact->last_name; ?>" required type="text" class="mb-2 form-control" name="last_name"
               id="last_name" placeholder="Last name">
        <input value="<?= $contact->email; ?>" required type="email" class="mb-2 form-control" name="email" id="email"
               placeholder="Email">
        <input value="<?= $contact->zip_code; ?>" type="number" class="mb-2 form-control" name="zip_code" id="zip_code"
               placeholder="Zip code">
        <input value="<?= $contact->street; ?>" required type="text" class="mb-2 form-control" name="street" id="street"
               placeholder="Street">
        <select class="mb-2 form-control" required name="city_id" id="city_id">
            <option>Select city</option>
            <?php
            foreach ($cities as $city) {
                echo '<option ' . ($city->id == $contact->city_id ? "selected" : " ") . ' value="' . $city->id . '">' . $city->name . '</option>';
            }
            ?>
        </select>
        <input type="hidden" id="id" value="<?= $contact->id; ?>" name="id">
        <button type="submit" class="btn btn-success">Add</button>
    </form>
</div>