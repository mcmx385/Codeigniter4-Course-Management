<div class="container">
    <?php echo view('components/title', ['title' => 'Publish URL', 'link' => '/teacher/courses']); ?>
    <form action="/lecture/addLecture/<?php echo $data['courseId']; ?>" method="POST">
        <div class="row">
            <div class="form-group col-12">
                <label for="">Select Date</label>
                <input type="date" class="form-control" name="date" required>
            </div>
            <div class="form-group col-6">
                <label for="">Select Time</label>
                <input type="time" class="form-control" name="startTime" required>
            </div>
            <div class="form-group col-6">
                <label for="">End Time</label>
                <input type="time" class="form-control" name="endTime" required>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Add</button>
    </form>
    <h2>Current Lectures</h2>
    <table class="table table-striped table-border table-hover">
        <thead>
            <th>Course ID</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Attendance and Lecture Material URL</th>
        </thead>
        <tbody>
            <?php
            foreach ($data['lectures'] as $lecture) {
                ?>
                <tr>
                    <td><?php echo $lecture->courseId; ?></td>
                    <td><?php echo $lecture->date; ?></td>
                    <td><?php echo $lecture->startTime; ?></td>
                    <td><?php echo $lecture->endTime; ?></td>
                    <td>
                        <a href="/lecture/takeAttendance/1/<?php echo $lecture->lectureId; ?>">
                            <?php echo isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : ""; ?>/lecture/takeAttendance/1/<?php echo $lecture->lectureId; ?>
                        </a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>