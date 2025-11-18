<?php include 'views/layouts/header.php'; ?>

<div class="col-lg-6 m-auto">
    <form method="post" action="index.php?controller=lecturer&action=update">
        <br><br>
        <div class="card">
            <div class="card-header bg-warning">
                <h1 class="text-white text-center"> Update Lecturer </h1>
            </div><br>
            
            <input type="hidden" name="id" value="<?php echo $lecturer['id']; ?>"> <br>

            <label> NAME: </label>
            <input type="text" name="name" value="<?php echo $lecturer['name']; ?>" class="form-control" required> <br>

            <label> NIDN: </label>
            <input type="text" name="nidn" value="<?php echo $lecturer['nidn']; ?>" class="form-control" required> <br>

            <label> PHONE: </label>
            <input type="text" name="phone" value="<?php echo $lecturer['phone']; ?>" class="form-control" required> <br>

            <label> JOIN DATE: </label>
            <input type="date" name="join_date" value="<?php echo $lecturer['join_date']; ?>" class="form-control" required> <br>

            <button class="btn btn-success" type="submit" name="submit"> Submit </button><br>
            <a class="btn btn-info" href="index.php?controller=lecturer&action=index"> Cancel </a><br>
        </div>
    </form>
</div>

<?php include 'views/layouts/footer.php'; ?>