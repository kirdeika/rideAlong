<div class="main-wrapper">
    <div class="main-wrapper_search">
        <h3>Search</h3>
        <?php 
            require 'search.php';
            require 'searchdisplay.php'
        ?>
    </div>
    <div class="main-wrapper_post">
        <h3>Post</h3>
        <?php 
            require 'post.php';
        ?>
    </div>
    <div class="main-wrapper_myaccount">
        <h3>My Account</h3>
        <?php 
            require 'myaccount.php';
        ?>
    </div>
</div>