<div class="container">
    <h1>Welcome back <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ""; ?>!</h1>
    <a href="/teacher/courses" class="btn btn-primary btn-lg">View your <?php echo $data['count']; ?> courses</a>
</div>