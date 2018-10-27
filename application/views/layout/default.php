<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta charset="ISO-8859-15">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $title_for_layout; ?></title>
        <link rel="icon" href="<?php echo IMG_URL; ?>favicon.ico" type="image/x-icon" />
        <!-- Bootstrap -->
        <link href="<?php echo VENDOR_URL; ?>bootstrap/bootstrap.min.css" rel="stylesheet">
        
<!--        <link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">-->
        <!-- Font Awesome -->
        <link href="<?php echo VENDOR_URL; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
    
        <!-- Custom Theme Style -->
        <link href="<?php echo CSS_URL; ?>custom.css" rel="stylesheet">
        
        <?php if($this->session->userdata('theme')){ ?>
            <link href="<?php echo CSS_URL; ?>theme/<?php echo $this->session->userdata('theme'); ?>.css" rel="stylesheet">
        <?php }else{ ?>
            <link href="<?php echo CSS_URL; ?>theme/dodger-blue.css" rel="stylesheet">
        <?php } ?>
        
        <!-- jQuery -->
        <script src="<?php echo JS_URL; ?>jquery-1.11.2.min.js"></script>
        <script src="<?php echo JS_URL; ?>jquery.validate.js"></script>
        
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                 <?php $this->load->view('layout/left-side'); ?>   
                <!-- top navigation -->
                 <?php $this->load->view('layout/header'); ?>   
                <!-- /top navigation -->
                
                <div class="right_col" role="main">
                    <?php $this->load->view('layout/message'); ?>
                    <!-- page content -->
                    <?php echo $content_for_layout; ?>
                    <!-- /page content -->
                </div>
                <!-- footer content -->
                <?php $this->load->view('layout/footer'); ?>   
                <!-- /footer content -->
            </div>
        </div>

        
        <!-- Bootstrap -->
        <script src="<?php echo VENDOR_URL; ?>bootstrap/bootstrap.min.js"></script>
    
        
        <!--   Start   -->
        <link href="<?php echo VENDOR_URL; ?>datatables/buttons.dataTables.min.css" rel="stylesheet"> 
        <link href="<?php echo VENDOR_URL; ?>datatables/dataTables.bootstrap.css" rel="stylesheet"> 
        <script src="<?php echo VENDOR_URL; ?>datatables/tools/jquery.dataTables.min.js"></script>
        <script src="<?php echo VENDOR_URL; ?>datatables/tools/dataTables.buttons.min.js"></script>
        <script src="<?php echo VENDOR_URL; ?>datatables/tools/pdfmake.min.js"></script>
        <script src="<?php echo VENDOR_URL; ?>datatables/tools/jszip.min.js"></script>
        <script src="<?php echo VENDOR_URL; ?>datatables/tools/vfs_fonts.js"></script>
        <script src="<?php echo VENDOR_URL; ?>datatables/tools/buttons.html5.min.js"></script> 
        <script src="<?php echo VENDOR_URL; ?>datatables/dataTables.bootstrap.js"></script> 
       <!-- dataTable with buttons end -->

        <script type="text/javascript" src="<?php echo VENDOR_URL; ?>toastr/toastr.min.js"></script>
        <link href="<?php echo VENDOR_URL; ?>toastr/toastr.min.css" rel="stylesheet">
       <!-- Custom Theme Scripts -->
       <script src="<?php echo JS_URL; ?>custom.js"></script>   
       
       <script type="text/javascript">
       
       jQuery.extend(jQuery.validator.messages, {
                required: "<?php echo $this->lang->line('required_field'); ?>",
                email: "<?php echo $this->lang->line('enter_valid_email'); ?>",
                url: "<?php echo $this->lang->line('enter_valid_url'); ?>",
                date: "<?php echo $this->lang->line('enter_valid_date'); ?>",
                number: "<?php echo $this->lang->line('enter_valid_number'); ?>",
                digits: "<?php echo $this->lang->line('enter_only_digit'); ?>",
                equalTo: "<?php echo $this->lang->line('enter_same_value_again'); ?>",
                remote: "<?php echo $this->lang->line('pls_fix_this'); ?>",
                dateISO: "Please enter a valid date (ISO).",
                maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
                minlength: jQuery.validator.format("Please enter at least {0} characters."),
                rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
                 range: jQuery.validator.format("Please enter a value between {0} and {1}."),
                max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
                min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
            });
       </script>

</body>
</html>