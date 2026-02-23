
<div class="bg-dark">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Vega6 </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">

                       

                        <?php if(!isset($_SESSION['jwt'])): ?>
                        
                        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                        <?php endif; ?>

                        <?php if(isset($_SESSION['jwt'])): ?>
                             <li class="nav-item">
                            <a class="nav-link" href="/api/blog/list.php">Blog</a>
                        </li>
                            <li class="nav-item"><a class="nav-link" href="/api/posts/list.php">Post</a></li>
                        <li class="nav-item"><a class="nav-link" href="/dashboard.php">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                        <?php endif; ?>

                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>