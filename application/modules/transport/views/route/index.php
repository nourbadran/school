<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-bus"></i><small> <?php echo $this->lang->line('manage_route'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content quick-link">
                <?php echo $this->lang->line('quick_link'); ?>:
                <?php if(has_permission(VIEW, 'transport', 'vehicle')){ ?>
                    <a href="<?php echo site_url('transport/vehicle/index/'); ?>"><?php echo $this->lang->line('transport'); ?> <?php echo $this->lang->line('vehicle'); ?></a>
                <?php } ?>
                <?php if(has_permission(VIEW, 'transport', 'route')){ ?>
                    | <a href="<?php echo site_url('transport/route/index/'); ?>"> <?php echo $this->lang->line('transport_route'); ?></a>
                <?php } ?>
                <?php if(has_permission(VIEW, 'transport', 'member')){ ?>
                    | <a href="<?php echo site_url('transport/member/index/'); ?>"><?php echo $this->lang->line('transport'); ?> <?php echo $this->lang->line('member'); ?></a>                    
                <?php } ?>
            </div>
            
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_route_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('transport_route'); ?> <?php echo $this->lang->line('list'); ?></a> </li>
                        <?php if(has_permission(ADD, 'transport', 'route')){ ?>
                             <?php if(isset($edit)){ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('transport/route/add'); ?>"  aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('transport_route'); ?></a> </li>                          
                             <?php }else{ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_route"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('transport_route'); ?></a> </li>                          
                             <?php } ?>
                        <?php } ?>  
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_route"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> <?php echo $this->lang->line('transport_route'); ?></a> </li>                          
                        <?php } ?>                
                        <?php if(isset($detail)){ ?>
                            <li  class="active"><a href="#tab_view_route"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> <?php echo $this->lang->line('transport_route'); ?></a> </li>                          
                        <?php } ?>                
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_route_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <?php if($this->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                            <th><?php echo $this->lang->line('school'); ?></th>
                                        <?php } ?>
                                        <th><?php echo $this->lang->line('transport_route'); ?> <?php echo $this->lang->line('title'); ?></th>
                                        <th><?php echo $this->lang->line('route_start'); ?></th>
                                        <th><?php echo $this->lang->line('route_end'); ?></th>
                                        <th><?php echo $this->lang->line('route_fare'); ?></th>
                                        <th><?php echo $this->lang->line('assign_vehicle'); ?></th>
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($routes) && !empty($routes)){ ?>
                                        <?php foreach($routes as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <?php if($this->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                <td><?php echo $obj->school_name; ?></td>
                                            <?php } ?>
                                            <td><?php echo $obj->title; ?></td>
                                            <td><?php echo $obj->route_start; ?></td>
                                            <td><?php echo $obj->route_end; ?></td>
                                            <td><?php echo $this->session->userdata('currency_symbol'); ?><?php echo $obj->fare; ?></td>
                                            <td><?php echo get_vehicle_by_ids($obj->vehicle_ids); ?></td>
                                            <td>
                                                <?php if(has_permission(EDIT, 'transport', 'route')){ ?>
                                                    <a href="<?php echo site_url('transport/route/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> </a>
                                                <?php } ?>
                                                <?php if(has_permission(VIEW, 'transport', 'route')){ ?>
                                                    <a href="<?php echo site_url('transport/route/view/'.$obj->id); ?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a>
                                                <?php } ?>
                                                <?php if(has_permission(DELETE, 'transport', 'route')){ ?>
                                                    <a href="<?php echo site_url('transport/route/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_route">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('transport/route/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <?php $this->load->view('layout/school_list_form'); ?> 
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"><?php echo $this->lang->line('transport_route'); ?> <?php echo $this->lang->line('title'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="title"  id="title" value="<?php echo isset($post['title']) ?  $post['title'] : ''; ?>" placeholder="<?php echo $this->lang->line('transport_route'); ?> <?php echo $this->lang->line('title'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('title'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="route_start"><?php echo $this->lang->line('route_start'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="route_start"  id="route_start" value="<?php echo isset($post['route_start']) ?  $post['route_start'] : ''; ?>" placeholder="<?php echo $this->lang->line('route_start'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('route_start'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="route_end"><?php echo $this->lang->line('route_end'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="route_end"  id="route_end" value="<?php echo isset($post['route_end']) ?  $post['route_end'] : ''; ?>" placeholder="<?php echo $this->lang->line('route_end'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('route_end'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fare"><?php echo $this->lang->line('route_fare'); ?> (<?php echo $this->session->userdata('currency_symbol'); ?>)
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="fare"  id="fare" value="<?php echo isset($post['fare']) ?  $post['fare'] : ''; ?>" placeholder="<?php echo $this->lang->line('route_fare'); ?>" type="text">
                                        <div class="help-block"><?php echo form_error('fare'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vehicle_ids"><?php echo $this->lang->line('assign_vehicle'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <div class="fn_add_vehicles">
                                            <?php if(isset($add_vehicles) && !empty($add_vehicles)){ ?>
                                                <?php foreach($add_vehicles as $obj){ ?>
                                                    <input  class=""  name="vehicle_ids[]" id="vehicle_ids[]" value="<?php echo $obj->id; ?>" type="checkbox" required="required"> <?php echo $obj->number; ?> <br/>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                        <label id="vehicle_ids[]-error" class="error" for="vehicle_ids[]" style="display: inline-block;"></label>
                                        <div class="help-block"><?php echo form_error('vehicle_ids'); ?></div>
                                    </div>
                                </div>
                                                               
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($post['note']) ?  $post['note'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                               
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('transport/route'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_route">
                            <div class="x_content"> 
                               <?php echo form_open(site_url('transport/route/edit/'.$route->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <?php $this->load->view('layout/school_list_edit_form'); ?>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"><?php echo $this->lang->line('transport_route'); ?> <?php echo $this->lang->line('title'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="title"  id="title" value="<?php echo isset($route->title) ?  $route->title : $post['title']; ?>" placeholder="<?php echo $this->lang->line('transport_route'); ?> <?php echo $this->lang->line('title'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('title'); ?></div>
                                    </div>
                                </div>                          
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="route_start"><?php echo $this->lang->line('route_start'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="route_start"  id="route_start" value="<?php echo isset($route->route_start) ?  $route->route_start : $post['route_start']; ?>" placeholder="<?php echo $this->lang->line('route_start'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('route_start'); ?></div>
                                    </div>
                                </div>                          
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="route_end"><?php echo $this->lang->line('route_end'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="route_end"  id="route_end" value="<?php echo isset($route->route_end) ?  $route->route_end : $post['route_end']; ?>" placeholder="<?php echo $this->lang->line('route_end'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('route_end'); ?></div>
                                    </div>
                                </div>                          
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fare"><?php echo $this->lang->line('route_fare'); ?> (<?php echo $this->session->userdata('currency_symbol'); ?>)
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="fare"  id="fare" value="<?php echo isset($route->fare) ?  $route->fare : $post['fare']; ?>" placeholder="<?php echo $this->lang->line('route_fare'); ?>"  type="text">
                                        <div class="help-block"><?php echo form_error('fare'); ?></div>
                                    </div>
                                </div>                          
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vehicle_ids"><?php echo $this->lang->line('assign_vehicle'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="fn_edit_vehicles">
                                        <?php if(isset($edit_vehicles) && !empty($edit_vehicles)){ ?>
                                            <?php $ids = explode(',', $route->vehicle_ids); ?>
                                            <?php foreach($edit_vehicles as $obj){ ?>
                                                <input  class=""  name="vehicle_ids[]" id="vehicle_ids[]"  value="<?php echo $obj->id; ?>" <?php if(in_array($obj->id, $ids)){ echo 'checked="checked"';} ?>  type="checkbox" required="required"> <?php echo $obj->number; ?> <br/>
                                            <?php } ?> 
                                        <?php } ?> 
                                        </div>   
                                        <label id="vehicle_ids[]-error" class="error" for="vehicle_ids[]" style="display: inline-block;"></label>
                                        <div class="help-block"><?php echo form_error('vehicle_ids'); ?></div>
                                    </div>
                                </div>                         
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="note"  id="note" placeholder="<?php echo $this->lang->line('note'); ?>"><?php echo isset($route->note) ?  $route->note : $post['note']; ?></textarea>
                                        <div class="help-block"><?php echo form_error('note'); ?></div>
                                    </div>
                                </div>
                                                             
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($route) ? $route->id : $id; ?>" name="id" />
                                        <a  href="<?php echo site_url('transport/route'); ?>"  class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('update'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  
                        <?php } ?>
                        
                        <?php if(isset($detail)){ ?>
                        <div class="tab-pane fade in active" id="tab_view_route">
                            <div class="x_content"> 
                               <?php echo form_open(site_url(), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('transport_route'); ?> <?php echo $this->lang->line('title'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $route->title; ?>
                                    </div>
                                </div> 
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('route_start'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $route->route_start; ?>
                                    </div>
                                </div> 
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('route_end'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $route->route_end; ?>
                                    </div>
                                </div> 
                                                         
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('route_fare'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $this->session->userdata('currency_symbol'); ?><?php echo $route->fare; ?>
                                    </div>
                                </div> 
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('assign_vehicle'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo get_vehicle_by_ids($route->vehicle_ids); ?>
                                    </div>
                                </div> 
                               
                                 <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('note'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $route->note; ?>
                                    </div>
                                </div> 
                               
                                <?php if(has_permission(EDIT, 'transport', 'route')){ ?>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            <a  href="<?php echo site_url('transport/route/edit/'.$route->id); ?>"  class="btn btn-primary"><?php echo $this->lang->line('update'); ?></a>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 <!-- Super admin js START  -->
 <script type="text/javascript">
     
     var edit = false;
    <?php if(isset($edit)){ ?>
        edit = true;
    <?php } ?>
         
    $("document").ready(function() {
         <?php if(isset($route) && !empty($route)){ ?>
            $(".fn_school_id").trigger('change');
         <?php } ?>
    });
     
    $('.fn_school_id').on('change', function(){
      
        var school_id = $(this).val();        
        var route_id = '';      
        
        <?php if(isset($route) && !empty($route)){ ?>
            route_id =  '<?php echo $route->id; ?>';
         <?php } ?> 
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('transport/route/get_vehicle_by_school'); ?>",
            data   : { school_id:school_id, route_id:route_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {      
                   if(edit){
                       $('.fn_edit_vehicles').html(response);  
                   }else{
                       $('.fn_add_vehicles').html(response);  
                   }                                                     
               }
            }
        });
    }); 

  </script>
<!-- Super admin js end -->


 <script type="text/javascript">
        $(document).ready(function() {
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
</script>