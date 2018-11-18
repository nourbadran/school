<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-user-md"></i><small> <?php echo $this->lang->line('manage_employee'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            
            <div class="x_content quick-link">
                <?php echo $this->lang->line('quick_link'); ?>:
                <?php if(has_permission(VIEW, 'hrm', 'designation')){ ?>
                    <a href="<?php echo site_url('hrm/designation'); ?>"><?php echo $this->lang->line('manage_designation'); ?></a>
                <?php } ?>
                <?php if(has_permission(VIEW, 'hrm', 'employee')){ ?>
                   | <a href="<?php echo site_url('hrm/employee'); ?>"><?php echo $this->lang->line('manage_employee'); ?></a>
                <?php } ?>               
            </div>
            
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_employee_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('employee'); ?> <?php echo $this->lang->line('list'); ?></a> </li>
                        
                        <?php if(has_permission(ADD, 'hrm', 'employee')){ ?>
                            <?php if(isset($edit)){ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('hrm/employee/add'); ?>"  aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('employee'); ?></a> </li>                          
                             <?php }else{ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_employee"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('employee'); ?></a> </li>                          
                             <?php } ?>
                         
                        <?php } ?>
                        
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_employee"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> <?php echo $this->lang->line('employee'); ?></a> </li>                          
                        <?php } ?>
                        <?php if(isset($addReward)){ ?>
                            <li  class="active"><a href="#tab_add_reward_employee"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('add-reward'); ?></a> </li>
                        <?php } ?>
                        <?php if(isset($retired)){ ?>
                            <li  class="active"><a href="#tab_retired_employee"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('retired'); ?> <?php echo $this->lang->line('employee'); ?></a> </li>                          
                        <?php } ?>
                        <?php if(isset($resume)){ ?>
                            <li  class="active"><a href="#tab_resume_employee"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('resume'); ?> <?php echo $this->lang->line('employee'); ?></a> </li>
                        <?php } ?>

                        <?php if(isset($detail)){ ?>
                            <li  class="active"><a href="#tab_view_employee"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> <?php echo $this->lang->line('employee'); ?></a> </li>                          
                        <?php } ?>   
                            
                    </ul>
                    <br/>
                   
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_employee_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <?php if($this->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                            <th><?php echo $this->lang->line('school'); ?></th>
                                        <?php } ?>
                                        <th><?php echo $this->lang->line('photo'); ?></th>
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                        <th><?php echo $this->lang->line('designation'); ?></th>
                                        <th><?php echo $this->lang->line('phone'); ?></th>
                                        <th><?php echo $this->lang->line('email'); ?></th>
                                        <th><?php echo $this->lang->line('join_date'); ?></th>
                                        <th><?php echo $this->lang->line('stop_date'); ?></th>
                                        <th><?php echo $this->lang->line('retired_date'); ?></th>
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php  $count = 1; if(isset($employees) && !empty($employees)){ ?>
                                        <?php foreach($employees as $obj){ ?>
                                        <?php $rowClass = "normal" ?>
                                        
                                        <tr class="<?php echo $rowClass; ?>">
                                            <td><?php echo $count++; ?></td>
                                            <?php if($this->session->userdata('role_id') == SUPER_ADMIN){ ?>
                                                <td><?php echo $obj->school_name; ?></td>
                                            <?php } ?>
                                            <td>
                                                <?php  if($obj->photo != ''){ ?>
                                                <img src="<?php echo UPLOAD_PATH; ?>/employee-photo/<?php echo $obj->photo; ?>" alt="" width="70" /> 
                                                <?php }else{ ?>
                                                <img src="<?php echo IMG_URL; ?>/default-user.png" alt="" width="70" /> 
                                                <?php } ?>
                                            </td>
                                            <td><?php echo ucfirst($obj->name); ?></td>
                                            <td><?php echo $obj->designation; ?></td>
                                            <td><?php echo $obj->phone; ?></td>
                                            <td><?php echo $obj->email; ?></td>
                                            <td><?php echo $obj->joining_date; ?></td>
                                            <td><?php echo $obj->stopped_at; ?></td>
                                            <td><?php echo $obj->retired_at ? ((new \DateTime($obj->retired_at))->format('Y-m-d')) : ''; ?></td>
                                            <td>
                                                <?php if(has_permission(EDIT, 'hrm', 'employee')){ ?> 
                                                    <a href="<?php echo site_url('hrm/employee/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> </a><br/>
                                                <?php } ?> 
                                                <?php if(has_permission(EDIT, 'hrm', 'employee') && $obj->status == 1 ){ /* stop button */?> 
                                                    <a href="<?php echo site_url('hrm/employee/stop/'.$obj->id); ?>" class="btn btn-danger btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('stop'); ?> </a><br/>
                                                <?php } ?> 
                                                <?php if(has_permission(EDIT, 'hrm', 'employee') && $obj->status == 2 ){ /* reactive button */?> 
                                                    <a href="<?php echo site_url('hrm/employee/reactive/'.$obj->id); ?>" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('re_active'); ?> </a><br/>
                                                <?php } ?> 
                                                <?php if(has_permission(EDIT, 'hrm', 'employee') && $obj->status == 3 ){ /* reactive button */?> 
                                                    <a href="<?php echo site_url('hrm/employee/resume/'.$obj->id); ?>" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('resume'); ?> </a><br/>
                                                <?php } ?> 
                                                <?php if(has_permission(EDIT, 'hrm', 'employee') && $obj->status != 3 ){ /* reactive button */?> 
                                                    <a href="<?php echo site_url('hrm/employee/retired/'.$obj->id); ?>" class="btn btn-danger btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('retired'); ?> </a><br/>
                                                <?php } ?> 
                                                <?php if(has_permission(VIEW, 'hrm', 'employee')){ ?>
                                                    <a href="<?php echo site_url('hrm/employee/view/'.$obj->id); ?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a><br/>
                                                <?php } ?>
                                                <?php if(has_permission(DELETE, 'hrm', 'employee')){ ?> 
                                                    <?php if($obj->id != 1){ ?> 
                                                        <a href="<?php echo site_url('hrm/employee/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_employee">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('hrm/employee/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                               <?php $this->load->view('layout/school_list_form'); ?> 
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><?php echo $this->lang->line('name'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="name"  id="name" value="<?php echo isset($post['name']) ?  $post['name'] : ''; ?>" placeholder="<?php echo $this->lang->line('name'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('name'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="designation_id"><?php echo $this->lang->line('designation'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="designation_id" id="add_designation_id" required="required">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <?php if(isset($designations) && !empty($designations)){ ?>
                                                <?php foreach($designations as $obj){ ?>
                                                    <option value="<?php echo $obj->id; ?>"><?php echo $obj->name; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('designation_id'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone"><?php echo $this->lang->line('phone'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="phone"  id="phone" value="<?php echo isset($post['phone']) ?  $post['phone'] : ''; ?>" placeholder="<?php echo $this->lang->line('phone'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('phone'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="present_address"><?php echo $this->lang->line('present'); ?> <?php echo $this->lang->line('address'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="present_address"  id="present_address" placeholder="<?php echo $this->lang->line('present'); ?> <?php echo $this->lang->line('address'); ?>"><?php echo isset($post['present_address']) ?  $post['present_address'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('present_address'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="permanent_address"><?php echo $this->lang->line('permanent'); ?> <?php echo $this->lang->line('address'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="permanent_address"  id="permanent_address"  placeholder="<?php echo $this->lang->line('permanent'); ?> <?php echo $this->lang->line('address'); ?>"><?php echo isset($post['permanent_address']) ?  $post['permanent_address'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('permanent_address'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="start_time"><?php echo $this->lang->line('start_work_time'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="start_work_time"  id="add_start_time"  placeholder="<?php echo $this->lang->line('start_work_time'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('start_time'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="end_time"><?php echo $this->lang->line('end_work_time'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="end_work_time"  id="add_end_time"  placeholder="<?php echo $this->lang->line('end_work_time'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('end_time'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gender"><?php echo $this->lang->line('gender'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="gender"  id="gender" required="required">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <?php $genders = get_genders(); ?>
                                            <?php foreach($genders as $key=>$value){ ?>
                                                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('gender'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="blood_group"><?php echo $this->lang->line('blood_group'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="blood_group" id="blood_group">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option> 
                                            <?php $bloods = get_blood_group(); ?>
                                            <?php foreach($bloods as $key=>$value){ ?>
                                                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('blood_group'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="religion"><?php echo $this->lang->line('religion'); ?> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="religion"  id="religion" value="<?php echo isset($post['religion']) ?  $post['religion'] : ''; ?>" placeholder="<?php echo $this->lang->line('religion'); ?>" type="text">
                                        <div class="help-block"><?php echo form_error('religion'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dob"><?php echo $this->lang->line('birth_date'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="dob"  id="add_dob" value="<?php echo isset($post['dob']) ?  $post['dob'] : ''; ?>" placeholder="<?php echo $this->lang->line('birth_date'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('dob'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="joining_date"><?php echo $this->lang->line('join_date'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="joining_date"  id="add_joining_date" value="<?php echo isset($post['joining_date']) ?  $post['joining_date'] : ''; ?>" placeholder="<?php echo $this->lang->line('join_date'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('joining_date'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="role_id"><?php echo $this->lang->line('role'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="role_id" id="role_id" required="required">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <?php foreach($roles as $obj){ ?>
                                            <?php if(in_array($obj->id, array(GUARDIAN, STUDENT, TEACHER))){ continue;} ?>
                                            <?php if(logged_in_role_id() != SUPER_ADMIN && $obj->id == SUPER_ADMIN){ continue; } ?>
                                                <option value="<?php echo $obj->id; ?>"><?php echo $obj->name; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('role_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="salary_grade_id"><?php echo $this->lang->line('salary_grade'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="salary_grade_id" id="add_salary_grade_id" required="required">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <?php foreach($grades as $obj){ ?>                                           
                                                <option value="<?php echo $obj->id; ?>"><?php echo $obj->grade_name; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('salary_grade_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="salary_type"><?php echo $this->lang->line('salary_type'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="salary_type" id="salary_type" required="required">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                    
                                            <option value="monthly"><?php echo $this->lang->line('monthly'); ?></option>                                           
                                            <option value="hourly"><?php echo $this->lang->line('hourly'); ?></option>                                           
                                        </select>
                                        <div class="help-block"><?php echo form_error('salary_type'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="monthly_leaves_credit"><?php echo $this->lang->line('monthly_leaves_credit'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="monthly_leaves_credit"  id="edit_monthly_leaves_credit" value="<?php echo isset($employee->monthly_leaves_credit) ?  $employee->monthly_leaves_credit : ''; ?>" placeholder="<?php echo $this->lang->line('monthly_leaves_credit'); ?>"  type="number">
                                        <div class="help-block"><?php echo form_error('monthly_leaves_credit'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email"><?php echo $this->lang->line('email'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="email"  id="email" value="<?php echo isset($post['email']) ?  $post['email'] : ''; ?>" placeholder="<?php echo $this->lang->line('email'); ?>" required="email" type="email">
                                        <div class="help-block"><?php echo form_error('email'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password"><?php echo $this->lang->line('password'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="password"  id="password" value="" placeholder="<?php echo $this->lang->line('password'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('password'); ?></div>
                                    </div>
                                </div>
                                
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $this->lang->line('photo'); ?> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>
                                            <input  class="form-control col-md-7 col-xs-12"  name="photo"  id="photo" value="" placeholder="email" type="file">
                                        </div>
                                        <div class="text-info"><?php echo $this->lang->line('valid_file_format_img'); ?></div>
                                        <div class="help-block"><?php echo form_error('photo'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $this->lang->line('resume'); ?>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>
                                            <input  class="form-control col-md-7 col-xs-12"  name="resume"  id="resume" type="file">
                                        </div>
                                        <div class="text-info"><?php echo $this->lang->line('valid_file_format_doc'); ?></div>
                                        <div class="help-block"><?php echo form_error('resume'); ?></div>
                                    </div>
                                </div>                               
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="other_info"><?php echo $this->lang->line('other_info'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="other_info"  id="other_info" placeholder="<?php echo $this->lang->line('other_info'); ?>"><?php echo isset($post['other_info']) ?  $post['other_info'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('other_info'); ?></div>
                                    </div>
                                </div>                                
                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('hrm/employee'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                                
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="instructions"><strong><?php echo $this->lang->line('instruction'); ?>: </strong> <?php echo $this->lang->line('add_employee_instruction'); ?></div>
                                </div>
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                        
                        <div class="tab-pane fade in active" id="tab_edit_employee">
                            <div class="x_content"> 
                            <?php echo form_open_multipart(site_url('hrm/employee/edit/'. $employee->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <?php $this->load->view('layout/school_list_form'); ?> 
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><?php echo $this->lang->line('name'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="name"  id="name" value="<?php echo isset($employee->name) ?  $employee->name : $post['name']; ?>" placeholder="<?php echo $this->lang->line('name'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('name'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="designation_id"><?php echo $this->lang->line('designation'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="designation_id" id="edit_designation_id" required="required">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <?php foreach($designations as $obj){ ?>
                                                <option value="<?php echo $obj->id; ?>" <?php if($employee->designation_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('designation_id'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone"><?php echo $this->lang->line('phone'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="phone"  id="phone" value="<?php echo isset($employee->phone) ?  $employee->phone : ''; ?>" placeholder="<?php echo $this->lang->line('phone'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('phone'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="present_address"><?php echo $this->lang->line('present'); ?> <?php echo $this->lang->line('address'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="present_address"  id="present_address" placeholder="<?php echo $this->lang->line('present'); ?> <?php echo $this->lang->line('address'); ?>"><?php echo isset($employee->present_address) ?  $employee->present_address : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('present_address'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="permanent_address"><?php echo $this->lang->line('permanent'); ?> <?php echo $this->lang->line('address'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="permanent_address"  id="permanent_address"  placeholder="<?php echo $this->lang->line('permanent'); ?> <?php echo $this->lang->line('address'); ?>"><?php echo isset($employee->permanent_address) ?  $employee->permanent_address : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('permanent_address'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="start_time"><?php echo $this->lang->line('start_time'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="start_work_time"  id="edit_start_time"  placeholder="<?php echo $this->lang->line('start_work_time'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('start_time'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="end_time"><?php echo $this->lang->line('start_time'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="end_work_time"  id="edit_end_time"  placeholder="<?php echo $this->lang->line('end_work_time'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('end_time'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gender"><?php echo $this->lang->line('gender'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="gender"  id="gender" required="required">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <?php $genders = get_genders(); ?>
                                            <?php foreach($genders as $key=>$value){ ?>
                                                <option value="<?php echo $key; ?>" <?php if($employee->gender == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('gender'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="blood_group"><?php echo $this->lang->line('blood_group'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="blood_group" id="blood_group">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <?php $bloods = get_blood_group(); ?>
                                            <?php foreach($bloods as $key=>$value){ ?>
                                                <option value="<?php echo $key; ?>" <?php if($employee->blood_group == $key){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('blood_group'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="religion"><?php echo $this->lang->line('religion'); ?> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="religion"  id="religion" value="<?php echo isset($employee->religion) ?  $employee->religion : ''; ?>" placeholder="<?php echo $this->lang->line('religion'); ?>" type="text">
                                        <div class="help-block"><?php echo form_error('religion'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dob"><?php echo $this->lang->line('birth_date'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="dob"  id="edit_dob" value="<?php echo isset($employee->dob) ?  date('d-m-Y', strtotime($employee->dob)) : $post['dob']; ?>" placeholder="<?php echo $this->lang->line('birth_date'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('dob'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="joining_date"><?php echo $this->lang->line('join_date'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="joining_date"  id="edit_joining_date" value="<?php echo isset($employee->joining_date) ?  date('d-m-Y', strtotime($employee->joining_date)) : $post['joining_date']; ?>" placeholder="<?php echo $this->lang->line('join_date'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('joining_date'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="role_id"><?php echo $this->lang->line('role'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="role_id" id="role_id" required="required">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <?php foreach($roles as $obj){ ?>
                                            <?php if(in_array($obj->id, array(GUARDIAN, STUDENT, TEACHER))){ continue;} ?>
                                            <?php if(logged_in_role_id() != SUPER_ADMIN && $obj->id == SUPER_ADMIN){ continue; } ?>
                                                <option value="<?php echo $obj->id; ?>" <?php if($employee->role_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->name; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('role_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="salary_grade_id"><?php echo $this->lang->line('salary_grade'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="salary_grade_id" id="edit_salary_grade_id" required="required">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <?php foreach($grades as $obj){ ?>                                           
                                                <option value="<?php echo $obj->id; ?>" <?php if($employee->salary_grade_id == $obj->id){ echo 'selected="selected"';} ?>><?php echo $obj->grade_name; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block"><?php echo form_error('salary_grade_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="salary_type"><?php echo $this->lang->line('salary_type'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12" name="salary_type" id="salary_type" required="required">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>                                                                                    
                                            <option value="monthly" <?php if($employee->salary_type == 'monthly'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('monthly'); ?></option>                                           
                                            <option value="hourly" <?php if($employee->salary_type == 'hourly'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('hourly'); ?></option>                                           
                                        </select>
                                        <div class="help-block"><?php echo form_error('salary_type'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="monthly_leaves_credit"><?php echo $this->lang->line('monthly_leaves_credit'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="monthly_leaves_credit"  id="edit_monthly_leaves_credit" value="<?php echo isset($employee->monthly_leaves_credit) ?   $employee->monthly_leaves_credit : ''; ?>" placeholder="<?php echo $this->lang->line('monthly_leaves_credit'); ?>"  type="number">
                                        <div class="help-block"><?php echo form_error('monthly_leaves_credit'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email"><?php echo $this->lang->line('email'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="email" readonly="readonly"  id="email" value="<?php echo isset($employee->email) ?  $employee->email : $post['email']; ?>" placeholder="<?php echo $this->lang->line('email'); ?>" required="email" type="email">
                                        <div class="help-block"><?php echo form_error('email'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" ><?php echo $this->lang->line('photo'); ?>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="hidden" name="prev_photo" id="prev_photo" value="<?php echo $employee->photo; ?>" />
                                        <?php if($employee->photo){ ?>
                                        <img src="<?php echo UPLOAD_PATH; ?>/employee-photo/<?php echo $employee->photo; ?>" alt="" width="70" /><br/><br/>
                                        <?php } ?>
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>
                                            <input  class="form-control col-md-7 col-xs-12"  name="photo"  id="photo" type="file">
                                        </div>
                                        <div class="text-info"><?php echo $this->lang->line('valid_file_format_img'); ?></div>
                                        <div class="help-block"><?php echo form_error('photo'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $this->lang->line('resume'); ?>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="hidden" name="prev_resume" id="prev_resume" value="<?php echo $employee->resume; ?>" />
                                        <?php if($employee->resume){ ?>
                                        <a href="<?php echo UPLOAD_PATH; ?>/employee-resume/<?php echo $employee->resume; ?>"><?php echo $employee->resume; ?></a> <br/>
                                        <?php } ?>
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> <?php echo $this->lang->line('upload'); ?>
                                            <input  class="form-control col-md-7 col-xs-12"  name="resume"  id="resume"  type="file">
                                        </div>
                                        <div class="text-info"><?php echo $this->lang->line('valid_file_format_doc'); ?></div>
                                        <div class="help-block"><?php echo form_error('resume'); ?></div>
                                    </div>
                                </div>
                                
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="other_info"><?php echo $this->lang->line('other_info'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="other_info"  id="other_info" placeholder="<?php echo $this->lang->line('other_info'); ?>"><?php echo isset($employee->other_info) ?  $employee->other_info : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('other_info'); ?></div>
                                    </div>
                                </div>                                
                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" name="id" id="edit_id" value="<?php echo $employee->id; ?>" />
                                        <a href="<?php echo site_url('hrm/employee'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('update'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>                          
                        <?php } ?>


                        <?php if(isset($retired)){ ?>
                        
                        <div class="tab-pane fade in active" id="tab_edit_employee">
                            <div class="x_content"> 
                            <?php echo form_open_multipart(site_url('hrm/employee/retired/'. $employee->id), array('name' => 'retired', 'id' => 'retired', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dob"><?php echo $this->lang->line('retired_date'); ?> <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="retired_at"  id="edit_dob" value="<?php echo isset($_POST['retired_at']) ?  date('d-m-Y', strtotime($_POST['retired_at'])) : '' ?>" placeholder="<?php echo $this->lang->line('retired_date'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('dob'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="conditions"><?php echo $this->lang->line('conditions'); ?><span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="conditions"  id="conditions" placeholder="<?php echo $this->lang->line('conditions'); ?>"><?php echo isset($_POST['conditions']) ? $_POST['conditions'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('present_address'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="duties"><?php echo $this->lang->line('duties'); ?><span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="duties"  id="duties" placeholder="<?php echo $this->lang->line('duties'); ?>"><?php echo isset($_POST['duties']) ?  $_POST['duties'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('present_address'); ?></div>
                                    </div>
                                </div>
                                 <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rights"><?php echo $this->lang->line('rights'); ?><span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12"  name="rights"  id="rights" placeholder="<?php echo $this->lang->line('rights'); ?>"><?php echo isset($_POST['rights']) ?  $_POST['rights'] : ''; ?></textarea>
                                        <div class="help-block"><?php echo form_error('present_address'); ?></div>
                                    </div>
                                </div>
                                <input type="hidden" name="employee_id" value="<?php echo $employee->id ?>">
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" name="id" id="retired_id" value="<?php echo $employee->id; ?>" />
                                        <a href="<?php echo site_url('hrm/employee'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('confirm'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>                          
                        <?php } ?>

                        <?php if(isset($resume)){ ?>

                            <div class="tab-pane fade in active" id="tab_edit_employee">
                                <div class="x_content">
                                    <?php echo form_open_multipart(site_url('hrm/employee/resume/'. $employee->id), array('name' => 'resume', 'id' => 'resume', 'class'=>'form-horizontal form-label-left'), ''); ?>

                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dob"><?php echo $this->lang->line('resume_date'); ?> <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="resume_at"  id="edit_dob" value="<?php echo isset($_POST['resume_at']) ?  date('d-m-Y', strtotime($_POST['resume_at'])) : '' ?>" placeholder="<?php echo $this->lang->line('resume_date'); ?>" required="required" type="text">
                                            <div class="help-block"><?php echo form_error('resume_at'); ?></div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="resume_conditions"><?php echo $this->lang->line('conditions'); ?><span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea  class="form-control col-md-7 col-xs-12"  name="resume_conditions"  id="resume_conditions" placeholder="<?php echo $this->lang->line('conditions'); ?>"><?php echo isset($_POST['resume_conditions']) ? $_POST['resume_conditions'] : ''; ?></textarea>
                                            <div class="help-block"><?php echo form_error('resume_conditions'); ?></div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="employee_id" value="<?php echo $employee->id ?>">
                                    <input type="hidden" name="retired_id" id="retired_id" value="<?php echo $employee->id; ?>" />
                                    <input type="hidden" name="retired_log_id" id="retired_log_id" value="<?php echo $ret_log->id; ?>" />
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">

                                            <a href="<?php echo site_url('hrm/employee'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                            <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('confirm'); ?></button>
                                        </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if(isset($addReward)){ ?>

                            <div class="tab-pane fade in active" id="tab_add_reward_employee">
                                <div class="x_content">
                                    <?php echo form_open_multipart(site_url('hrm/employee/addReward/'. $employee->id), array('name' => 'resume', 'id' => 'resume', 'class'=>'form-horizontal form-label-left'), ''); ?>


                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date"><?php echo $this->lang->line('date'); ?> <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="date"  id="edit_dob" value="<?php echo isset($_POST['date']) ?  date('d-m-Y', strtotime($_POST['date'])) : '' ?>" placeholder="<?php echo $this->lang->line('date'); ?>" required="required" type="text">
                                            <div class="help-block"><?php echo form_error('date'); ?></div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="value"><?php echo $this->lang->line('value'); ?> <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  class="form-control col-md-7 col-xs-12"  name="value"  id="value" value="<?php echo isset($_POST['value']) ?  date('d-m-Y', strtotime($_POST['value'])) : '' ?>" placeholder="<?php echo $this->lang->line('value'); ?>" required="required" type="number">
                                            <div class="help-block"><?php echo form_error('value'); ?></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">

                                            <a href="<?php echo site_url('hrm/employee'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                            <button id="send" type="submit" class="btn btn-success"><?php echo $this->lang->line('confirm'); ?></button>
                                        </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if(isset($detail)){ ?>
                        
                        <div class="tab-pane fade in active" id="tab_view_employee">
                            <div class="x_content"> 
                            <?php echo form_open_multipart(site_url('hrm/employee/edit/'. $employee->id), array('name' => 'editemployee', 'id' => 'editemployee', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('name'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                        : <?php echo $employee->name; ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('designation'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">                                        
                                        : <?php echo $employee->designation; ?>                                          
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('phone'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                        : <?php echo $employee->phone; ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('present'); ?> <?php echo $this->lang->line('address'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                       : <?php echo $employee->present_address; ?>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('permanent'); ?> <?php echo $this->lang->line('address'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                       : <?php echo $employee->permanent_address; ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('start_work_time'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                        : <?php echo $employee->start_work_time; ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('end_work_time'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                        : <?php echo $employee->end_work_time; ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('gender'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">                                            
                                        : <?php echo $this->lang->line($employee->gender); ?>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('blood_group'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                         : <?php echo $this->lang->line($employee->blood_group); ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('religion'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $employee->religion; ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('birth_date'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo date('M j, Y', strtotime($employee->dob)); ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('join_date'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                     : <?php echo date('M j, Y', strtotime($employee->joining_date)); ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('role'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                     : <?php echo $employee->role; ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('salary_grade'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                     : <?php echo $employee->grade_name; ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('salary_type'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                     : <?php echo $this->lang->line($employee->salary_type); ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('monthly_leaves_credit'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                        : <?php echo $employee->monthly_leaves_credit; ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('email'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                     : <?php echo $employee->email; ?>
                                    </div>
                                </div>
                                 
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('photo'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php if($employee->photo){ ?>
                                        <img src="<?php echo UPLOAD_PATH; ?>/employee-photo/<?php echo $employee->photo; ?>" alt="" width="70" /><br/><br/>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('resume'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php if($employee->resume){ ?>
                                        <a href="<?php echo UPLOAD_PATH; ?>/employee-resume/<?php echo $employee->resume; ?>" class="btn btn-success btn-xs"><i class="fa fa-download"></i> <?php echo $this->lang->line('download'); ?></a> <br/>
                                        <?php } ?>                                        
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('other_info'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                     : <?php echo $employee->other_info; ?>
                                    </div>
                                </div>
                                <h3><?php echo $this->lang->line('rewards'); ?></h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Value</th>
                                            <th scope="col">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ( $rewards as $reward )
                                        {
                                            $d = explode(' ',$reward->date);
                                            echo '<tr>
                                                    <td scope="row">'.$d[0].'</td>
                                                    <td>'.$reward->value.'</td>
                                                    <td><a href="'. site_url('hrm/employee/delete_reward/'.$reward->id).'" onclick="javascript: return confirm("'.$this->lang->line('confirm_alert').'")" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> '. $this->lang->line('delete').' </td>

                                                <?php } ?>
                                                  </tr>';
                                        }
                                        ?>

                                    </tbody>
                                </table>
                                
                                <?php if(has_permission(EDIT, 'hrm', 'employee')){ ?>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            <a href="<?php echo site_url('hrm/employee/edit/'.$employee->id); ?>" class="btn btn-primary"><?php echo $this->lang->line('update'); ?></a>
                                            <a href="<?php echo site_url('hrm/employee/addReward/'.$employee->id); ?>" class="btn btn-primary"><?php echo $this->lang->line('add-reward'); ?></a>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php echo form_close(); ?>

                                <h3><?php echo $this->lang->line('resignations'); ?></h3>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col"><?php echo $this->lang->line('Date of retirement'); ?></th>
                                        <th scope="col"><?php echo $this->lang->line('conditions'); ?></th>
                                        <th scope="col"><?php echo $this->lang->line('duties'); ?></th>
                                        <th scope="col"><?php echo $this->lang->line('rights'); ?></th>
                                        <th scope="col"><?php echo $this->lang->line('Date of resuming'); ?></th>
                                        <th scope="col"><?php echo $this->lang->line('conditions of resuming'); ?></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ( $resignations as $resignation )
                                    {
                                        $d1 = explode(' ',$resignation->retired_at);
                                        $d2 = explode(' ',$resignation->resume_at);
                                        $ret_at = null;
                                        $res_at = null;
                                        if (count($d1)>0)
                                            $ret_at = $d1[0];
                                        if (count($d2)>0)
                                            $res_at = $d2[0];
                                        echo '<tr>
                                                    <td scope="row">'.$ret_at.'</td>
                                                    <td>'.$resignation->conditions.'</td>
                                                    <td>'.$resignation->duties.'</td>
                                                    <td>'.$resignation->rights.'</td>
                                                    <td>'.$res_at.'</td>
                                                    <td>'.$resignation->resume_conditions.'</td>
                                                    
                                                  </tr>';
                                    }
                                    ?>

                                    </tbody>
                                </table>
                                <h3><?php echo $this->lang->line('stops'); ?></h3>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col"><?php echo $this->lang->line('Date of stopping'); ?></th>
                                        <th scope="col"><?php echo $this->lang->line('Date of resuming'); ?></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ( $stops as $stop )
                                    {
                                        $d1 = explode(' ',$stop->stopped_at);
                                        $d2 = explode(' ',$stop->resumed_at);
                                        $ret_at = null;
                                        $res_at = null;
                                        if (count($d1)>0)
                                            $ret_at = $d1[0];
                                        if (count($d2)>0)
                                            $res_at = $d2[0];
                                        echo '<tr>
                                                    <td scope="row">'.$ret_at.'</td>                                        
                                                    <td>'.$res_at.'</td>                                                 
                                                  </tr>';
                                    }
                                    ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
 <script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>


<link href="<?php echo VENDOR_URL; ?>datepicker/datepicker.css" rel="stylesheet">
<script src="<?php echo VENDOR_URL; ?>datepicker/datepicker.js"></script>
<link href="<?php echo VENDOR_URL; ?>timepicker/timepicker.css" rel="stylesheet">
<script src="<?php echo VENDOR_URL; ?>timepicker/timepicker.js"></script>

<!-- Super admin js START  -->
 <script type="text/javascript">

     $('#add_start_time').timepicker();
     $('#add_end_time').timepicker();
     $('#edit_start_time').timepicker();
     $('#edit_end_time').timepicker();
    $("document").ready(function() {
         <?php if(isset($edit) && !empty($edit)){ ?>
            $(".fn_school_id").trigger('change');
         <?php } ?>
    });
     
    $('.fn_school_id').on('change', function(){
      
        var school_id = $(this).val();
        var designation_id = '';
        var salary_grade_id = '';
        <?php if(isset($edit) && !empty($edit)){ ?>
            designation_id =  '<?php echo $employee->designation_id; ?>';
            salary_grade_id =  '<?php echo $employee->salary_grade_id; ?>';
         <?php } ?> 
        
        if(!school_id){
           alert('<?php echo $this->lang->line('select'); ?> <?php echo $this->lang->line('school'); ?>');
           return false;
        }
       
       $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_designation_by_school'); ?>",
            data   : { school_id:school_id, designation_id:designation_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {  
                   if(designation_id){
                       $('#edit_designation_id').html(response);   
                   }else{
                       $('#add_designation_id').html(response);   
                   }
                                    
                   get_salary_grade(school_id, salary_grade_id);
               }
            }
        });
    }); 
    
    
    function get_salary_grade(school_id, salary_grade_id){
    
        $.ajax({       
            type   : "POST",
            url    : "<?php echo site_url('ajax/get_salary_grade_by_school'); ?>",
            data   : { school_id:school_id, salary_grade_id:salary_grade_id},               
            async  : false,
            success: function(response){                                                   
               if(response)
               {    
                   if(salary_grade_id){
                       $('#edit_salary_grade_id').html(response);
                   }else{
                       $('#add_salary_grade_id').html(response); 
                   }
               }
            }
        });
    }
    
  </script>
  <!-- Super admin js end -->
  
  
  <!-- datatable with buttons -->
  <script type="text/javascript">

    $('#add_dob').datepicker();
    $('#add_joining_date').datepicker();
    $('#edit_dob').datepicker();
    $('#edit_joining_date').datepicker();
  
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