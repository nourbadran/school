<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-bar-chart"></i><small> <?php echo $this->lang->line('employee'); ?> <?php echo $this->lang->line('yearly'); ?> <?php echo $this->lang->line('attendance'); ?> <?php echo $this->lang->line('report'); ?></small></h3>                
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            
            <?php $this->load->view('quick_report'); ?>   
            
             <div class="x_content filter-box"> 
                <?php echo form_open_multipart(site_url('report/eyattendance'), array('name' => 'eyattendance', 'id' => 'eyattendance', 'class' => 'form-horizontal form-label-left'), ''); ?>
                <div class="row">  
                    
                     <?php $this->load->view('layout/school_list_filter'); ?>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('academic_year'); ?>  <span class="required">*</span></div>
                            <select  class="form-control col-md-7 col-xs-12" name="academic_year_id" id="academic_year_id" required="required">
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                <?php foreach ($academic_years as $obj) { ?>
                                <option value="<?php echo $obj->id; ?>" <?php if(isset($academic_year_id) && $academic_year_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->session_year; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>                        

                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="item form-group"> 
                            <div><?php echo $this->lang->line('employee'); ?>  <span class="required">*</span></div>
                            <select  class="form-control col-md-7 col-xs-12" name="employee_id" id="employee_id"  required="required">
                                <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                <?php if(isset($employees) && !empty($employees)) { ?>
                                    <?php foreach ($employees as $obj) { ?>
                                    <option value="<?php echo $obj->id; ?>" <?php if(isset($employee_id) && $employee_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>                        
                
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group"><br/>
                            <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('find'); ?></button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>

            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="active"><a href="#tab_tabular"   role="tab" data-toggle="tab"   aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('tabular'); ?> <?php echo $this->lang->line('report'); ?></a> </li>
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in active" id="tab_tabular" >
                            <div class="x_content">
                                                            
                            <table class="datatable-responsive table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <td><?php echo $this->lang->line('month'); ?> <i class="fa fa-long-arrow-down"></i> - <?php echo $this->lang->line('date'); ?> <i class="fa fa-long-arrow-right"></i></td>
                                        <?php for($i = 1; $i<=$days; $i++ ){ ?>
                                            <td><?php echo $i; ?></td>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php  $months = get_months(); ?>
                                    <?php foreach($months as $key=>$value){ ?>
                                        <?php 
                                            $month_number = date('m',strtotime($key)); 
                                            $attendance = @get_employee_monthly_attendance($employee_id, $academic_year_id, $month_number ,$days);
                                           ?>
                                        <?php if(!empty($attendance)){ ?>
                                         <tr>
                                             <td><?php echo $value; ?></td> 
                                             <?php foreach($attendance AS $key ){ ?>
                                                 <td> <?php echo $key ? $key : '<i style="color:red;">--</i>'; ?></td>
                                             <?php } ?>
                                         </tr>
                                         <?php } ?>  
                                        <?php } ?>  
                                </tbody>
                            </table>
                            </div>
                        </div>                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    $("document").ready(function() {
         <?php if(isset($school_id) && !empty($school_id)){ ?>
            $(".fn_school_id").trigger('change');
         <?php } ?>
    });
     
    $('.fn_school_id').on('change', function(){
      
        var school_id = $(this).val();       
        var employee_id = '';
        
        <?php if(isset($school_id) && !empty($school_id)){ ?>
            employee_id =  '<?php echo $employee_id; ?>';
         <?php } ?> 
        
        if(!school_id){
           alert('<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('school'); ?>');
           return false;
        }
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_employee_by_school'); ?>",
            data   : { school_id:school_id, employee_id:employee_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {   
                    $('#employee_id').html(response); 
               }
            }
        });
    });   
    
    $("#eyattendance").validate();
    
</script>