<?php include 'views/layouts/header.php'; ?>

<div class="col-lg-6 m-auto">
    <form method="post" action="index.php?controller=lecturer&action=store">
        <br><br>
        <div class="card">
            <div class="card-header bg-primary">
                <h1 class="text-white text-center"> Create Lecturer</h1>
            </div><br>

            <label> NAME: </label>
            <input type="text" name="name" class="form-control" required> <br>

            <label> NIDN: </label>
            <input type="text" name="nidn" class="form-control" required> <br>

            <label> PHONE: </label>
            <input type="text" name="phone" class="form-control" required> <br>

            <label> JOIN DATE: </label>
            <input type="date" name="join_date" class="form-control" required> <br>

            <button class="btn btn-success" type="submit" name="submit"> Submit </button><br>
            <a class="btn btn-info" href="index.php?controller=lecturer&action=index"> Cancel </a><br>
        </div>
    </form>
</div>

<?php include 'views/layouts/footer.php'; ?>