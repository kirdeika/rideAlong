<div class="main-wrapper">
    <?php
        if(isset($_GET['signForTrip'])) {
            echo '<div class="main-wrapper_notice">
                <div class="notice-information">
                    You signed up for a trip!
                </div>
            </div>';
            require 'includes/handleoptin.inc.php';
        }
    ?>
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