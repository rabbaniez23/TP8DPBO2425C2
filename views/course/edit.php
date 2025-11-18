<?php include 'views/layouts/header.php'; ?>

<div class="col-lg-6 m-auto">
    <form method="post" action="index.php?controller=course&action=update">
        <br><br>
        <div class="card">
            <div class="card-header bg-warning">
                <h1 class="text-white text-center"> Update Course</h1>
            </div><br>

            <input type="hidden" name="id" value="<?php echo $course['id']; ?>"> <br>

            <label> NAMA MATA KULIAH: </label>
            <input type="text" name="course_name" value="<?php echo $course['course_name']; ?>" class="form-control" required> <br>

            <label> SKS: </label>
            <input type="number" name="sks" value="<?php echo $course['sks']; ?>" class="form-control" required> <br>

            <label> DOSEN PENGAMPU: </label>
            <select name="lecturer_id" class="form-select">
                <option value="">-- Pilih Dosen --</option>
                <?php
                while ($row = $lecturers->fetch_assoc()) {
                    // Beri 'selected' jika id dosen sama dengan lecturer_id mata kuliah
                    $selected = ($row['id'] == $course['lecturer_id']) ? 'selected' : '';
                    echo "<option value='{$row['id']}' {$selected}>{$row['name']}</option>";
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