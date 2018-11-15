<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-check-square-o"></i><small> <?php echo $this->lang->line('employee'); ?> <?php echo $this->lang->line('attendance'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content quick-link">
                <?php echo $this->lang->line('quick_link'); ?>:
                <?php if(has_permission(VIEW, 'attendance', 'student')){ ?>
                    <a href="<?php echo site_url('attendance/student'); ?>"><?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('attendance'); ?></a>
                <?php } ?>
                <?php if(has_permission(VIEW, 'attendance', 'teacher')){ ?>
                    | <a href="<?php echo site_url('attendance/teacher'); ?>"><?php echo $this->lang->line('teacher'); ?> <?php echo $this->lang->line('attendance'); ?></a>
                <?php } ?>
                <?php if(has_permission(VIEW, 'attendance', 'employee')){ ?>
                    | <a href="<?php echo site_url('attendance/employee'); ?>"><?php echo $this->lang->line('employee'); ?> <?php echo $this->lang->line('attendance'); ?></a>
                    | <a href="<?php echo site_url('attendance/employee/import'); ?>"><?php echo $this->lang->line('import'); ?> <?php echo $this->lang->line('employee'); ?> <?php echo $this->lang->line('attendance'); ?></a>
                <?php } ?>
            </div>

            <div class="x_content">

                    <?php echo form_open_multipart(site_url('attendance/employee/import'), array( 'class'=>'form-horizontal form-label-left'), ''); ?>


                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $this->lang->line('file'); ?>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="btn btn-default btn-file">
                                <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('file'); ?>
                                <input  class="form-control col-md-7 col-xs-12"  name="file"  id="file"  type="file">
                            </div>

                            <div class="help-block"><?php echo form_error('file'); ?></div>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <a href="<?php echo site_url('academic/classes'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                            <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="instructions"><strong><?php echo $this->lang->line('instruction'); ?>: </strong> <?php echo $this->lang->line('add_class_instruction'); ?></div>
                    </div>
            </div>

        </div>
    </div>
</div>


<!-- bootstrap-datetimepicker -->
<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
<script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>
<script type="text/javascript">

    $('#date').datepicker();

    $(document).ready(function(){

        $('#fn_present').click(function(){

            if($(this).prop('checked')) {
                $('input:checkbox').removeAttr('checked');
                $(this).prop('checked', true);
                $('.present').prop('checked', true);
            }else{
                $('.present').prop('checked', false);
            }
        });


        $('#fn_late').click(function(){

            if($(this).prop('checked')) {
                $('input:checkbox').removeAttr('checked');
                $(this).prop('checked', true);
                $('.late').prop('checked', true);
            }else{
                $('.late').prop('checked', false);
            }
        });

        $('#fn_absent').click(function(){

            if($(this).prop('checked')) {
                $('input:checkbox').removeAttr('checked');
                $(this).prop('checked', true);
                $('.absent').prop('checked', true);
            }else{
                $('.absent').prop('checked', false);
            }
        });


        $('.fn_single_attendnce').click(function(){

            var status     = $(this).prop('checked') ? $(this).val() : '';
            var employee_id = $(this).prop('checked') ? $(this).attr('itemid') : '';
            var school_id   = $('#school_id').val();
            var class_id   = $('#class_id').val();
            var section_id = $('#section_id').val();
            var date       = $('#date').val();

            $.ajax({
                type   : "POST",
                url    : "<?php echo site_url('attendance/employee/update_single_attendance'); ?>",
                data   : {school_id:school_id, status : status , employee_id: employee_id, class_id:class_id, section_id:section_id, date:date},
                async  : false,
                success: function(response){

                    if(response){
                        toastr.success('<?php echo $this->lang->line('update_success'); ?>');
                    }else{
                        toastr.error('<?php echo $this->lang->line('update_failed'); ?>');
                    }
                    toastr.options = {
                        "closeButton": true,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "showDuration": "400",
                        "hideDuration": "400",
                        "timeOut": "5000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                }
            });

        });

        $('.fn_all_attendnce').click(function(){

            var status     = $(this).prop('checked') ? $(this).val() : '';
            var school_id   = $('#school_id').val();
            var class_id   = $('#class_id').val();
            var section_id = $('#section_id').val();
            var date       = $('#date').val();

            $.ajax({
                type   : "POST",
                url    : "<?php echo site_url('attendance/employee/update_all_attendance'); ?>",
                data   : { school_id:school_id, status : status , class_id:class_id, section_id:section_id, date:date},
                async  : false,
                success: function(response){
                    if(response){
                        toastr.success('<?php echo $this->lang->line('update_success'); ?>');
                    }else{
                        toastr.error('<?php echo $this->lang->line('update_failed'); ?>');
                    }
                    toastr.options = {
                        "closeButton": true,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "showDuration": "400",
                        "hideDuration": "400",
                        "timeOut": "5000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                }
            });

        });
    });
    $("#employee").validate();
</script>


