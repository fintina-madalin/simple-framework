<div class="container">
    <div class="row-fluid mb-4">
        <a href="/add" class="btn btn-success pull-right">Add new contact</a>
    </div>
    <div class="row mb-2 pb-1 border-bottom">
        <div class="col-2">First name</div>
        <div class="col-2">Last name</div>
        <div class="col-2">Email</div>
        <div class="col-1">City</div>
        <div class="col-1">Zip code</div>
        <div class="col-2">Street</div>
        <div class="col-2"></div>
    </div>
    <?php
    foreach ($contacts as $contact) {
        ?>
        <div class="row mb-2 pb-1 border-bottom">
            <div class="col-2"><?= $contact->first_name; ?></div>
            <div class="col-2"><?= $contact->last_name; ?></div>
            <div class="col-2"><?= $contact->email; ?></div>
            <div class="col-1"><?= $contact->city()->name; ?></div>
            <div class="col-1"><?= $contact->zip_code; ?></div>
            <div class="col-2"><?= $contact->street; ?></div>
            <div class="col-2">
                <a href="/edit?id=<?= $contact->id; ?>" class="btn btn-primary">Edit</a>
                <a href="/delete?id=<?= $contact->id; ?>" class="btn btn-danger">X</a>
            </div>
        </div>
        <?php
    }
    ?>
</div>