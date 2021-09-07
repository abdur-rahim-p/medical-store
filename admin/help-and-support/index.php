<?php
    include_once './../inc/constants.php';
    include_once './../inc/connection.php';
    include_once './../inc/functions.php';
    include_once './../inc/header.php';
    include_once './../inc/sidebar.php';

    //Check if admin is logged out or not
    admin_logged_out();

    // Define function to send email
    function send_support_request_email($post_arr) {
        // Get post signature image
        $post_arr = $_POST;
        $img = $_POST['canvas_url'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        // Save signature image
        $file_name = 'sign'.'_'.strtotime(date('Y-m-d H:i:s')).'.png';
        $folderPath = './../assets/images/user_signs/';
        $file = $folderPath.$file_name;
        file_put_contents($file,$data);

        // Post variables
        $user_email = $_POST['user_email'];
        $field_category = $_POST['field_category'];
        $field_textarea = $_POST['field_textarea'];

        // Email html content
        $current_date = date('d-m-Y H:i:s');
        $htmlContent = 'We have received your support request. We will get in touch with you soon<br>Time: - '.$current_date.'<br>User Email - '.$user_email.'<br>Issue - '.$field_category.'<br>Description - '.$field_textarea.'<br>';

        // Send email to admin for support.
        $subject = "Support Request";
        $from = 'tname3186@gmail.com';
        $fromName = 'Admin';
        $to = $user_email;

        // Boundaries
        $semi_rand = md5(time());
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

        // Headers
        $headers = "From: $fromName"." <".$from.">";
        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

        // Preparing Attachments
        $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
            "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";
        $message .= "--{$mime_boundary}\n";
        $fp =    @fopen($file,"rb");
        $data =  @fread($fp,filesize($file));
        @fclose($fp);
        $data = chunk_split(base64_encode($data));
        $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" .
            "Content-Description: ".basename($file)."\n" .
            "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" .
            "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
        $message .= "--{$mime_boundary}--";
        $returnpath = "-f" . $from;

        $send_mail = mail($to,$subject,$message,$headers,$returnpath);
        unlink($file);
        if($send_mail) {
            header("location:?success");
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Function call back for Sending Email
        send_support_request_email($_POST);
    }
?>
    <div class="container table-container">
        <h1 class="text-center font-weight-light pt-4">Help & Support</h1>
        <?php
        if(isset($_REQUEST['success'])) {
            print_success_message("help_request");
        }
        ?>
        <form method="post" enctype="multipart/form-data" id="admin-site-form">
            <div class="form-group">
                <label for="field_description">Your Email</label>
                <input type="email" class="form-control" id="user_email" placeholder="User Email" name="user_email">
            </div>
            <div class="form-group">
                <label>Select Topic</label>
                <select class="form-control" id="field_category" name="field_category">
                    <option value="" selected>Select Topic</option>
                    <option>Account Related</option>
                    <option>Report a bug</option>
                    <option>Technical Issue</option>
                    <option>Request to extend Account capabilities</option>
                </select>
            </div>
            <div class="form-group">
                <label for="field_textarea">Describe Issue</label>
                <textarea class="form-control" id="field_textarea" rows="3" name="field_textarea" placeholder="Describe Issue"></textarea>
            </div>

            <div class="form-group sigPad">
                <label for="canvas-text">Enter your signature</label>
                <input type="text" name="canvas-text"
                       placeholder="Enter your signature text"
                       class="form-input-text required" id="canvas-text">
                    <a href="javascript:void(0)" class="clear_canvas text-right">Clear</a>
                    <div class="">
                        <div class="typed"></div>
                        <canvas style="border:1px solid #d3d3d3;" class="sign-pad"
                                id="sign-pad" width="270"
                                height="100"></canvas>
                        <input type="hidden" name="canvas_url" id="canvas_url">
                    </div>
            </div>
            <button type="submit" class="btn btn-primary" name="help_sbmt" id="help_sbmt">Submit</button>
        </form>
    </div>

<?php
    include_once './../inc/sidebar-end.php';
    include_once './../inc/footer.php';
?>


