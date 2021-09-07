<?php
    session_start();
    $forum_navbar = '';
    if(isset($_SESSION['is_logged_in_user']) && $_SESSION['is_logged_in_user'] == 1)
    {
        $forum_navbar .='
            <div class="row">
                <div class="col-lg-1 col-xs-3 col-sm-2 col-md-2 logo "><a href="./../index"><img src="./../images/logo.jpg" alt=""></a></div>
                <div class="col-lg-3 col-xs-9 col-sm-5 col-md-3 selecttopic">
                </div>
                <div class="col-lg-4 search hidden-xs hidden-sm col-md-3">
                    <div class="wrap">
                        <form action="#" method="post" class="form">
                            <div class="pull-left txt"><input type="text" class="form-control" placeholder="Search Topics"></div>
                            <div class="pull-right"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-12 col-sm-5 col-md-4 avt">
                    <div class="stnt pull-left">                            
                        <form action="./insert_forum" method="post" class="form">
                            <button class="btn btn-primary">Start New Topic</button>
                        </form>
                    </div>
                    <div class="env pull-left"><i class="fa fa-envelope"></i></div>

                    <div class="avatar pull-left dropdown">
                        <a data-toggle="dropdown" href="#"><img src="./../images/avatar.jpg" alt=""></a> <b class="caret"></b>
                        <div class="status green">&nbsp;</div>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="./../user_edit_profile">Edit profile</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-3" href="./../inc/user_logout">Log Out</a></li>
                        </ul>
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
            </div>
        ';
    }   
    else {
         $forum_navbar .='
            <div class="row">
                <div class="col-lg-1 col-xs-3 col-sm-2 col-md-2 logo "><a href="./../index"><img src="./../images/logo.jpg" alt=""></a></div>
                <div class="col-lg-3 col-xs-9 col-sm-5 col-md-3 selecttopic">
                </div>
                <div class="col-lg-4 search hidden-xs hidden-sm col-md-3">
                    <div class="wrap">
                        
                    </div>
                </div>
                <div class="col-lg-4 col-xs-12 col-sm-5 col-md-4 avt">
                    <div class="stnt pull-left">                            
                        <form action="./insert_forum" method="post" class="form">
                            <button class="btn btn-primary">Start New Topic</button>
                        </form>
                    </div>                    
                    <div class="clearfix"></div>
                </div>
            </div>
        ';
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Forum :: Home Page</title>
        <link href="./../assets/css/forum-page/bootstrap.min.css" rel="stylesheet">
        <link href="./../assets/css/forum-page/custom.css" rel="stylesheet">
        <link href="./../assets/fonts/fontawesome-free-5.14.0-web/css/all.min.css" media="all" rel="stylesheet" type="text/css">
        <link rel="shortcut icon" href="./../images/fav.png" type="image/x-icon">  
    </head>
    <body>
        <div class="headernav">
                <div class="container">
                    <?php
                        echo $forum_navbar;
                    ?>
                </div>
        </div>