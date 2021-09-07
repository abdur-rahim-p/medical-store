<?php
    // Constant for user image path
    define("user_img_path","./../admin/assets/images/user_images/");

    include_once './../inc/connection.php'; 
    include_once './../inc/commons.php';   
    include_once './../inc/header-forum.php';
    
   
    // Function to display forums
    function display_forums() {
        global $connect;

        $fetch_forum_qry = "select user_details.user_image , forum_tbl.* from user_details , forum_tbl where user_details.user_id = forum_tbl.user_id";
        $fetch_forum_qry_result = mysqli_query($connect,$fetch_forum_qry);
        $html = '';
        while($forum_array = mysqli_fetch_array($fetch_forum_qry_result)) {
            $html.='
                <div class="post">
                    <div class="wrap-ut pull-left">
                        <div class="userinfo pull-left">
                            <div class="avatar">
                                <img src='.user_img_path.$forum_array['user_image'].' alt="user-img" />
                                <div class="status green">&nbsp;</div>
                            </div>
                        </div>
                        <div class="posttext pull-left">
                            <h2><a href="javascript:void(0)">'.$forum_array['forum_title'].'</a></h2>
                            <p>'.$forum_array['forum_description'].'</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            ';
        }
        echo $html;
    }
    

?>

    <section class="content">
        <div class="container">
            <div class="row forum-list">
                <div class="col-lg-8 col-md-8">
                    <?php
                        display_forums();
                    ?>
                </div>

                <div class="col-lg-4 col-md-4">
                    <div class="sidebarblock">
                        <h3>Categories</h3>
                        <div class="divline"></div>
                        <div class="blocktxt">
                            <ul class="cats">
                                <?php
                                    display_forum_topics();
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
    include_once './../inc/footer-forum.php';
?>
          