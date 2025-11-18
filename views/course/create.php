<?php include 'views/layouts/header.php'; ?>

<div class="col-lg-6 m-auto">
    <form method="post" action="index.php?controller=course&action=store">
        <br><br>
        <div class="card">
            <div class="card-header bg-primary">
                <h1 class="text-white text-center"> Create Course</h1>
            </div><br>

            <label> NAMA MATA KULIAH: </label>
            <input type="text" name="course_name" class="form-control" required> <br>

            <label> SKS: </label>
            <input type="number" name="sks" class="form-control" required> <br>

            <label> DOSEN PENGAMPU: </label>
            <select name="lecturer_id" class="form-select">
                <option value="">-- Pilih Dosen --</option>
                <?php
                // $lecturers didapat dari controller
                while ($row = $lecturers->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                ?>
            </select>
            <br>

            <button class="btn btn-success" type="submit" name="submit"> Submit </button><br>
            <a class="btn btn-info" href="index.php?controller=course&action=index"> Cancel </a><br>

        </div>
    </form>
</div>

<?php include 'views/layouts/footer.php'; ?>