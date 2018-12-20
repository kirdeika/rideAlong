<?php
echo "<div class='main-wrapper'>";
    require 'logout.php'; 
        if(isset($_GET['signForTrip'])) {
            echo '<div class="main-wrapper_notice">
                <div class="notice-information">
                    You signed up for a trip!
                </div>
            </div>';
            require 'includes/handleoptin.inc.php';
        }
    echo "<div class='main-wrapper_search'>";
        echo '<h3>Search</h3>';
            require 'search.php';
            require 'searchdisplay.php';
    echo '</div>';
    echo "<div class='main-wrapper_post'>";
        echo "<h3>Post</h3>";
            require 'post.php';
    echo "</div>";
    echo "<div class='main-wrapper_myaccount'>";
        echo "<h3>My Account</h3>";
            require 'myaccount.php';
    echo "</div>";
echo "</div>";