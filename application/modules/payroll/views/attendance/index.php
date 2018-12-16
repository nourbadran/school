<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-dollar"></i><small> <?php echo $this->lang->line('manage_attendance_info'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content quick-link">
                <?php echo $this->lang->line('quick_link'); ?>:
               <?php if(has_permission(VIEW, 'payroll', 'grade')){ ?>
                    <a href="<?php echo site_url('payroll/grade/index'); ?>"><?php echo $this->lang->line('salary_grade'); ?></a>                   
                <?php } ?>              
                <?php if(has_permission(VIEW, 'payroll', 'payment')){ ?>
                  | <a href="<?php echo site_url('payroll/payment/index'); ?>"><?php echo $this->lang->line('payroll'); ?> <?php echo $this->lang->line('payment'); ?></a>                  
                <?php } ?> 
                <?php if(has_permission(VIEW, 'payroll', 'history')){ ?>
                  | <a href="<?php echo site_url('payroll/history/index'); ?>"><?php echo $this->lang->line('payroll'); ?> <?php echo $this->lang->line('history'); ?></a>                  
                <?php } ?> 
                
            </div>
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">

                        <?php if(has_permission(ADD, 'payroll', 'attinfo')){ ?>
                            <?php if(isset($edit)){ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('payroll/attendance/add'); ?>"  aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('attendance') . $this->lang->line('info');  ?></a> </li>
                             <?php }else{ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_grade"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('attendance') . $this->lang->line('info'); ?></a> </li>
                             <?php } ?>
                        <?php } ?> 


                    </ul>
                    <br/>
                    
                    <div class="tab-content">

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_grade">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('payroll/attendance/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                               
                                 <?php $this->load->view('layout/school_list_form'); ?>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="working_days"><?php echo $this->lang->line('working_days'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="working_days"  id="add_grade_name" value="<?php echo isset($post['working_days']) ?  $post['working_days'] : ''; ?>" placeholder="<?php echo $this->lang->line('working_days'); ?>" required="required" type="number">
                                        <div class="help-block"><?php echo form_error('working_days'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="days_off"><?php echo $this->lang->line('days_off'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="days_off"  id="days_off" value="<?php echo isset($post['days_off']) ?  $post['days_off'] : ''; ?>" placeholder="<?php echo $this->lang->line('days_off'); ?>" required="required" type="number">
                                        <div class="help-block"><?php echo form_error('days_off'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="extra_days_off"><?php echo $this->lang->line('extra_days_off'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="extra_days_off"  id="extra_days_off" value="<?php echo isset($post['extra_days_off']) ?  $post['extra_days_off'] : ''; ?>" placeholder="<?php echo $this->lang->line('extra_days_off'); ?>" required="required" type="number">
                                        <div class="help-block"><?php echo form_error('extra_days_off'); ?></div>
                                    </div>
                                </div>
                                <input type="hidden" id="row_column"  value="<?php echo ( ( isset($discount_infos)  ) ? count($discount_infos) : 0 ) ?>" />
                                <div class="row" style="width: 75%;margin-left: 200px">
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="extra_days_off"><?php echo $this->lang->line('day'); ?> </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input  class="form-control col-md-7 col-xs-12"   id="extra_days_off_num" placeholder="<?php echo $this->lang->line('day_number'); ?>" type="number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="extra_days_off"><?php echo $this->lang->line('price'); ?> </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input  class="form-control col-md-7 col-xs-12"   id="extra_days_off_price" placeholder="<?php echo $this->lang->line('price'); ?>" type="number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <button class="btn btn-primary" type="button" id="AddDayOff"><?php echo $this->lang->line('day_off'); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="width: 50%;margin-left: 260px">
                                    <div class="col-md-12">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th><?php echo $this->lang->line('day'); ?> </th>
                                                <th><?php echo $this->lang->line('price'); ?> </th>
                                            </tr>
                                            </thead>
                                            <tbody id="addDayOffTableBody">
                                                <?php
                                                    if (isset($discount_infos))
                                                    {
                                                        $count = 0;
                                                        foreach( $discount_infos as $discount_info )
                                                        {
                                                            echo '<tr class="removemake'.$count.'">
                                                                    <td>
                                                                        <input type="hidden" value="'.$discount_info->day_number.'" name="dayoffs['.$count.'][day]" />
                                                                                '.$discount_info->day_number.'
                                                                    </td>
                                                                    <td>
                                                                        <input type="hidden" value="'.$discount_info->price.'" name="dayoffs['.$count.'][price]" />
                                                                                '.$discount_info->price.'
                                                                    </td>
                                                                    <td>
                                                                        <i class="fa fa-trash" id="btndelete" data-id="'.$count.'" style="color: red; cursor: pointer; font-size: 28px;"></i>
                                                                    </td>
                                                                  </tr>';
                                                            $count++;
                                                        }
                                                    }
                                                ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('payroll/attendance/add'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo (isset($dataFound) && $dataFound ? $this->lang->line('save') : $this->lang->line('submit')); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- datatable with buttons -->
 <script type="text/javascript">

        $(document).ready(function() {
            $("#addDayOffTableBody").on('click', '#btndelete', function () {
                var id  = $(this).attr('data-id');
                $('.removemake'+id).remove();
            });
            $('#AddDayOff').click(function(){
                var num = $('#extra_days_off_num').val();
                var price = $('#extra_days_off_price').val();
                if(num == "")
                {
                    return;
                }
                if(price == "")
                {
                    return;
                }


                {
                    var row_column = $('#row_column').val();

                    var cell = "" +
                        "<tr class=\"removemake" + num +"\">" +
                        "                                                    <td>" +
                        "                                                        <input type=\"hidden\" value=\"" + num +"\" name=\"dayoffs["+row_column+"][day]\" />\n" +
                        "                                                        "+num +
                        "                                                    </td>" +
                        "                                                    <td>" +
                        "                                                        <input type=\"hidden\" value=\"" + price +"\" name=\"dayoffs["+row_column+"][price]\" />\n" +
                        "                                                        "+price +
                        "                                                    </td>" +
                        "                                                    <td>\n" +
                        "                                                        <i class=\"fa fa-trash\" id=\"btndelete\" data-id=\""+row_column+"\" style=\"color: red; cursor: pointer; font-size: 28px;\"></i>\n" +
                        "                                                    </td>"
                        "                                                </tr>";
                    $('#addDayOffTableBody').append(cell);
                    row_column++;
                    $('#row_column').val(row_column);
                    $('#extra_days_off_num').val("");
                    $('#extra_days_off_price').val("");
                }
            });
          $('#datatable-responsive').DataTable( {
              dom: 'Bfrtip',
              iDisplayLength: 15,
              buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'csvHtml5',
                  'pdfHtml5',
                  'pageLength'
              ],
              search: true
          });
        });
    $("#add").validate();     
    $("#edit").validate();   
    
    $('.fn_add_claculate').on('keyup', function(){
        
        var basic_salary = $('#add_basic_salary').val() ? parseFloat($('#add_basic_salary').val()) : 0;
        var house_rent = $('#add_house_rent').val() ? parseFloat($('#add_house_rent').val()) : 0;
        var transport = $('#add_transport').val() ? parseFloat($('#add_transport').val()): 0;
        var medical = $('#add_medical').val() ? parseFloat($('#add_medical').val()) : 0;
        var provident_fund = $('#add_provident_fund').val() ? parseFloat($('#add_provident_fund').val()) : 0;
        
       $('#add_total_allowance').val(house_rent+transport+medical);       
        var total_allowance = $('#add_total_allowance').val() ? parseFloat($('#add_total_allowance').val()) : 0;
        
        $('#add_total_deduction').val(provident_fund);
        var total_deduction = $('#add_total_deduction').val() ? parseFloat($('#add_total_deduction').val()) : 0;
        
        $('#add_gross_salary').val(basic_salary+total_allowance);
        $('#add_net_salary').val((basic_salary+total_allowance)-total_deduction);
        
    });
    
    $('.fn_edit_claculate').on('keyup', function(){
        
        var basic_salary = $('#edit_basic_salary').val() ? parseFloat($('#edit_basic_salary').val()) : 0;
        var house_rent = $('#edit_house_rent').val() ? parseFloat($('#edit_house_rent').val()) : 0;
        var transport = $('#edit_transport').val() ? parseFloat($('#edit_transport').val()): 0;
        var medical = $('#edit_medical').val() ? parseFloat($('#edit_medical').val()) : 0;
        var provident_fund = $('#edit_provident_fund').val() ? parseFloat($('#edit_provident_fund').val()) : 0;
        
       $('#edit_total_allowance').val(house_rent+transport+medical);       
        var total_allowance = $('#edit_total_allowance').val() ? parseFloat($('#edit_total_allowance').val()) : 0;
        
        $('#edit_total_deduction').val(provident_fund);
        var total_deduction = $('#edit_total_deduction').val() ? parseFloat($('#edit_total_deduction').val()) : 0;
        
        $('#edit_gross_salary').val(basic_salary+total_allowance);
        $('#edit_net_salary').val((basic_salary+total_allowance)-total_deduction);
        
    });
    
</script>