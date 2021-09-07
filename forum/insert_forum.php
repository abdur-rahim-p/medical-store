<?php
    
    // Connection file
    include_once './../inc/connection.php';

    // Function to fill dependable product dropdown by ajax
    if(isset($_REQUEST['category_id']) && isset($_POST['action']) && isset($_POST['action']) == 'change_category')
    {
        global $connect;
        $category_id = $_REQUEST['category_id'];
        $fetch_products_qry = "select product_id , product_name from product where category_p_id = '$category_id'";
        $fetch_products_qry_result = mysqli_query($connect,$fetch_products_qry);
        $html ='';
        while($products_arr = mysqli_fetch_array($fetch_products_qry_result)) {
            $html.='
                <option value='.$products_arr['product_id'].'>'.$products_arr['product_name'].'</option>
            ';
        }
        echo $html;
        die();
    }

    // Header files
    include_once './../inc/commons.php';
    include_once './../inc/header-forum.php';


    // Function to fetch category
    function fetch_category() {
        global $connect;
        $fetch_category_qry = "select category_id , category_name from category";
        $fetch_category_qry_result = mysqli_query($connect,$fetch_category_qry);
        $html = '';
        while ($category_arr = mysqli_fetch_array($fetch_category_qry_result)) {
            $html.='
                <option value='.$category_arr['category_name'].' data-id='.$category_arr['category_id'].'>'.$category_arr['category_name'].'</option>
            ';
        }
        echo $html;
    }
 
    // fetch user id
    function fetch_user_id()
    {
        if(isset($_SESSION['is_logged_in_user']) && $_SESSION['is_logged_in_user']==1) {
            global $connect;
            $fetch_user_id_query = "select user_id from user_details where user_name = '$_SESSION[user_name]' and user_password = '$_SESSION[user_password]' and status=1";
            $fetch_user_id_query_result = mysqli_query($connect,$fetch_user_id_query);
            $fetch_user_id_query_result_arr = mysqli_fetch_assoc($fetch_user_id_query_result); 
            $GLOBALS['user_id'] = $fetch_user_id_query_result_arr['user_id'];                   
        }
        
    }
    fetch_user_id();


    // Function to display login notice
    function display_login_notice() {
            $login_notice = '<div class="blocktxt">
                                <a href="./../user_login">Please Login to your account to post a forum</a>
                            </div>';
            echo $login_notice;        
    }
    

     // Declaring function to insert forum
    function insert_forum() {
        
        global $user_id;
        global $connect;

        if(isset($_POST['forum_submit'])) {
            $forum_title = $_POST['forum_title'];        
            $forum_category = $_REQUEST['forum_category'];
            $forum_product = $_REQUEST['forum_product'];
            $forum_desc = $_POST['forum_desc'];

            // Check if forum title and description is empty or not 
            if(empty($forum_title) || empty($forum_desc)) {
                $forum_required_err = "<span class='text-danger'>This is a required field.</span>";
            }
            else {
                $forum_required_err = '';
            }

            // Check if forum category and product is selected or not
            if(empty($forum_category) || empty($forum_product)) {
                $forum_select_error = "<span class='text-danger'>Select your option.</span>";
            }
            else {
                $forum_select_error ='';
            }

            // Insert query if there are no errors
            if(empty($forum_required_err) && empty($forum_select_error)) {
                $forum_insert_qry = "insert into forum_tbl (product_id,user_id,forum_title,forum_description) value('$forum_product','$user_id','$forum_title','$forum_desc')";
                $forum_insert_qry_result = mysqli_query($connect,$forum_insert_qry);
                
                if($forum_insert_qry_result) {
                    header("location:./discussion");
                }            
                else {
                    ?>
                        <script type="text/javascript">alert("There was an error. Please try again later.");</script>
                    <?php
                }

            }

            $GLOBALS['forum_required_err'] = $forum_required_err;
            $GLOBALS['forum_select_error'] = $forum_select_error;
        }

    }

    // Insert forum function callback
    insert_forum();
   

    // Function to display forum form
    function display_forum_form() {
        global $forum_required_err;
        global $forum_select_error;
        ?>
        <div class="post">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form newtopic" method="post">
                <div class="topwrap">
                    <div class="userinfo pull-left">
                        <div class="avatar">
                            <img src="./../images/avatar4.jpg" alt="" />
                            <div class="status red">&nbsp;</div>
                        </div>

                        <div class="icons">
                            <img src="./../images/icon3.jpg" alt="" /><img src="./../images/icon4.jpg" alt="" /><img src="./../images/icon5.jpg" alt="" /><img src="./../images/icon6.jpg" alt="" />
                        </div>
                    </div>
                    <div class="posttext pull-left">
                        <div>
                            <input type="text" placeholder="Enter Topic Title" class="form-control" name="forum_title" value="<?php
                                if(isset($_POST['forum_title'])) {
                                    echo $_POST['forum_title'];
                                }
                                else {
                                    unset($_POST['forum_title']);
                                }
                            ?>" />
                            <?php if(isset($forum_required_err)) echo $forum_required_err; ?>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <select name="forum_category" id="forum_category"  class="form-control" >
                                    <option selected value="">Select Category</option>
                                    <?php
                                        fetch_category();
                                    ?>
                                </select>
                                <?php if(isset($forum_select_error)) echo $forum_select_error; ?>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <select name="forum_product" id="forum_product"  class="form-control">
                                    <option selected>Select Subcategory</option>
                                </select>
                                <i class="fas fa-spinner fa-spin" id="forum-spinner"></i>
                                <?php if(isset($forum_select_error)) echo $forum_select_error; ?>
                            </div>
                        </div>

                        <div>
                            <textarea name="forum_desc" id="desc" placeholder="Description"  class="form-control" value ="<?php 
                                if(isset($_POST['forum_desc'])) {
                                    echo $_POST['forum_desc'];
                                }
                                else {
                                    unset($_POST['forum_desc']);
                                }
                            ?>">
                            </textarea>
                            <?php if(isset($forum_required_err)) echo $forum_required_err; ?>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
                </div>                              
                <div class="postinfobot">
                    <div class="pull-right postreply">
                        <div class="pull-left smile"><a href="#"><i class="fa fa-smile-o"></i></a></div>
                        <div class="pull-left"><button type="submit" class="btn btn-primary" name="forum_submit">Post</button></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
        <?php
    }

   
?>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 breadcrumbf">
                    <a href="#"></a> <span class="diviver"></span><a href="#"></a> <span class="diviver">.</span> <a href="#"></a> 
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <?php
                        if(!isset($_SESSION['is_logged_in_user']) || $_SESSION['is_logged_in_user']!=1) {
                            display_login_notice();    
                        }
                        else {
                            display_forum_form();    
                        }
                    ?>
                </div>
                <div class="col-lg-4 col-md-4">
                    <!-- -->
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
          