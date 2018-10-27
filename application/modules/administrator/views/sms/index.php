<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-gears"></i><small> <?php echo $this->lang->line('sms'); ?> <?php echo $this->lang->line('setting'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content quick-link">
                <?php echo $this->lang->line('quick_link'); ?>:
                
                <?php if(has_permission(VIEW, 'administrator', 'school')){ ?>
                    <a href="<?php echo site_url('administrator/school'); ?>"><?php echo $this->lang->line('manage_school'); ?></a>
                <?php } ?>
                <?php if(has_permission(VIEW, 'administrator', 'year')){ ?>
                    | <a href="<?php echo site_url('administrator/year'); ?>"><?php echo $this->lang->line('academic_year'); ?></a>
                <?php } ?>
                    
                <?php if(has_permission(VIEW, 'administrator', 'payment')){ ?>
                    | <a href="<?php echo site_url('administrator/payment'); ?>"><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('setting'); ?></a>
                <?php } ?>
                    
                <?php if(has_permission(VIEW, 'administrator', 'sms')){ ?>
                    | <a href="<?php echo site_url('administrator/sms'); ?>"><?php echo $this->lang->line('sms'); ?> <?php echo $this->lang->line('setting'); ?></a>
                <?php } ?>
                    
                <?php if(has_permission(VIEW, 'administrator', 'role')){ ?>
                   | <a href="<?php echo site_url('administrator/role'); ?>"><?php echo $this->lang->line('user_role'); ?></a>
                <?php } ?>
                <?php if(has_permission(VIEW, 'administrator', 'permission')){ ?>
                   | <a href="<?php echo site_url('administrator/permission'); ?>"><?php echo $this->lang->line('role_permission'); ?></a>                   
                <?php } ?>
                <?php if(has_permission(VIEW, 'administrator', 'user')){ ?>
                   | <a href="<?php echo site_url('administrator/user'); ?>"><?php echo $this->lang->line('manage_user'); ?></a>                
                <?php } ?>
                <?php if(has_permission(EDIT, 'administrator', 'password')){ ?>
                   | <a href="<?php echo site_url('administrator/password'); ?>"><?php echo $this->lang->line('reset_user_password'); ?></a>                   
                <?php } ?>
                <?php if(has_permission(VIEW, 'administrator', 'backup')){ ?>
                   | <a href="<?php echo site_url('administrator/backup'); ?>"><?php echo $this->lang->line('backup'); ?> <?php echo $this->lang->line('database'); ?></a>                  
                <?php } ?>
            </div>
            
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_sms_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('sms'); ?> <?php echo $this->lang->line('setting'); ?> <?php echo $this->lang->line('list'); ?></a> </li>
                        <?php if(has_permission(ADD, 'administrator', 'sms')){ ?>
                            <?php if(isset($edit)){ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('administrator/sms/add'); ?>"  aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('sms'); ?> <?php echo $this->lang->line('setting'); ?></a> </li>                          
                             <?php }else{ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_sms"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('sms'); ?> <?php echo $this->lang->line('setting'); ?> </a> </li>                          
                             <?php } ?>
                        <?php } ?>  
                            
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_sms"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> <?php echo $this->lang->line('sms'); ?> <?php echo $this->lang->line('setting'); ?> </a> </li>                          
                        <?php } ?>
                            
                        <?php if(isset($detail)){ ?>
                            <li  class="active"><a href="#tab_view_sms"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> <?php echo $this->lang->line('sms'); ?> <?php echo $this->lang->line('setting'); ?></a> </li>                          
                        <?php } ?>     
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_sms_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th><?php echo $this->lang->line('school'); ?></th>
                                        <th><?php echo $this->lang->line('clicktell'); ?></th>
                                        <th><?php echo $this->lang->line('twilio'); ?></th>
                                        <th><?php echo $this->lang->line('bulk'); ?></th>
                                        <th><?php echo $this->lang->line('msg91'); ?></th>
                                        <th><?php echo $this->lang->line('plivo'); ?></th>
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($sms_settings) && !empty($sms_settings)){ ?>
                                        <?php foreach($sms_settings as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $obj->school_name; ?></td>
                                            <td><?php echo $obj->clickatell_username; ?></td>
                                            <td><?php echo $obj->twilio_account_sid; ?></td>
                                            <td><?php echo $obj->bulk_username; ?></td>
                                            <td><?php echo $obj->msg91_auth_key; ?></td>                                            
                                            <td><?php echo $obj->plivo_auth_id; ?></td>                                            
                                            
                                            <td>
                                                <?php if(has_permission(VIEW, 'administrator', 'sms')){ ?>
                                                    <a href="<?php echo site_url('administrator/sms/view/'.$obj->id); ?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a>
                                                <?php } ?>
                                                <?php if(has_permission(EDIT, 'administrator', 'sms')){ ?>
                                                    <a href="<?php echo site_url('administrator/sms/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> </a>
                                                <?php } ?>
                                                <?php if(has_permission(DELETE, 'administrator', 'sms')){ ?>
                                                    <a href="<?php echo site_url('administrator/sms/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>                                
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_sms">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('administrator/sms/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <?php $this->load->view('layout/school_list_form'); ?> 
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <strong><?php echo $this->lang->line('clicktell'); ?> <?php echo $this->lang->line('setting'); ?></strong>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clickatell_username"><?php echo $this->lang->line('username'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="clickatell_username" value="<?php echo isset($sms_setting) ? $sms_setting->clickatell_username : ''; ?>"  placeholder="<?php echo $this->lang->line('username'); ?>"  type="text">
                                        <div class="help-block"><?php echo form_error('clickatell_username'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clickatell_password"><?php echo $this->lang->line('password'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="clickatell_password" value="<?php echo isset($sms_setting) ? $sms_setting->clickatell_password : ''; ?>"  placeholder="<?php echo $this->lang->line('password'); ?>"  type="text">
                                        <div class="help-block"><?php echo form_error('clickatell_password'); ?></div>
                                    </div>
                                </div>                  
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clickatell_api_key"><?php echo $this->lang->line('api_key'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="clickatell_api_key" value="<?php echo isset($sms_setting) ? $sms_setting->clickatell_api_key : ''; ?>"  placeholder="<?php echo $this->lang->line('api_key'); ?>"  type="text">
                                        <div class="help-block"><?php echo form_error('clickatell_api_key'); ?></div>
                                    </div>
                                </div>       
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clickatell_from_number"><?php echo $this->lang->line('from_number'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="clickatell_from_number" value="<?php echo isset($sms_setting) ? $sms_setting->clickatell_from_number : ''; ?>"  placeholder="<?php echo $this->lang->line('from_number'); ?>"  type="text">
                                        <div class="help-block"><?php echo form_error('clickatell_from_number'); ?></div>
                                    </div>
                                </div>       
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clickatell_mo_no"><?php echo $this->lang->line('clickatell_mo_no'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="clickatell_mo_no" value="<?php echo isset($sms_setting) ? $sms_setting->clickatell_mo_no : ''; ?>"  placeholder="<?php echo $this->lang->line('clickatell_mo_no'); ?>" type="text">
                                        <div class="help-block"><?php echo form_error('clickatell_mo_no'); ?></div>
                                    </div>
                                </div>       
                        
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clickatell_status"><?php echo $this->lang->line('is_active'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="clickatell_status">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <option value="1" <?php if(isset($sms_setting) && $sms_setting->clickatell_status == '1'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('yes'); ?></option>
                                            <option value="0" <?php if(isset($sms_setting) && $sms_setting->clickatell_status == '0'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('no'); ?></option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('clickatell_status'); ?></div>
                                    </div>
                                </div>
                                
                                <!-- TWILIO -->
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <strong><?php echo $this->lang->line('twilio'); ?> <?php echo $this->lang->line('setting'); ?></strong>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="twilio_account_sid"><?php echo $this->lang->line('account_sid'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="twilio_account_sid" value="<?php echo isset($sms_setting) ? $sms_setting->twilio_account_sid : ''; ?>"  placeholder="twilio_account_sid" type="text">
                                        <div class="help-block"><?php echo form_error('twilio_account_sid'); ?></div>
                                    </div>
                                </div>                                               
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="twilio_auth_token"><?php echo $this->lang->line('auth_token'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="twilio_auth_token" value="<?php echo isset($sms_setting) ? $sms_setting->twilio_auth_token : ''; ?>"  placeholder="twilio_auth_token" type="text">
                                        <div class="help-block"><?php echo form_error('twilio_auth_token'); ?></div>
                                    </div>
                                </div>                                               
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="twilio_from_number"><?php echo $this->lang->line('from_number'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="twilio_from_number" value="<?php echo isset($sms_setting) ? $sms_setting->twilio_from_number : ''; ?>"  placeholder="twilio_from_number" type="text">
                                        <div class="help-block"><?php echo form_error('twilio_from_number'); ?></div>
                                    </div>
                                </div> 
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="twilio_status"><?php echo $this->lang->line('is_active'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="twilio_status">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <option value="1" <?php if(isset($sms_setting) && $sms_setting->twilio_status == '1'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('yes'); ?></option>
                                            <option value="0" <?php if(isset($sms_setting) && $sms_setting->twilio_status == '0'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('no'); ?></option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('twilio_status'); ?></div>
                                    </div>
                                </div>
                          
                                
                                 <!-- BULK -->
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <strong><?php echo $this->lang->line('bulk'); ?> <?php echo $this->lang->line('setting'); ?></strong>
                                    </div>
                                </div>
                              
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bulk_username"><?php echo $this->lang->line('username'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="bulk_username" value="<?php echo isset($sms_setting) ? $sms_setting->bulk_username : ''; ?>"  placeholder="<?php echo $this->lang->line('username'); ?>" type="text">
                                        <div class="help-block"><?php echo form_error('bulk_username'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bulk_password"><?php echo $this->lang->line('password'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="bulk_password" value="<?php echo isset($sms_setting) ? $sms_setting->bulk_password : ''; ?>"  placeholder="<?php echo $this->lang->line('password'); ?>"  type="text">
                                        <div class="help-block"><?php echo form_error('bulk_password'); ?></div>
                                    </div>
                                </div>                  
                        
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bulk_status"><?php echo $this->lang->line('is_active'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="bulk_status">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <option value="1" <?php if(isset($sms_setting) && $sms_setting->bulk_status == '1'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('yes'); ?></option>
                                            <option value="0" <?php if(isset($sms_setting) && $sms_setting->bulk_status == '0'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('no'); ?></option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('bulk_status'); ?></div>
                                    </div>
                                </div>
                                
                                <!-- MSG91 -->    
                                 <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <strong><?php echo $this->lang->line('msg91'); ?> <?php echo $this->lang->line('setting'); ?></strong>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="msg91_auth_key"><?php echo $this->lang->line('auth_key'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="msg91_auth_key" value="<?php echo isset($sms_setting) ? $sms_setting->msg91_auth_key : ''; ?>"  placeholder="<?php echo $this->lang->line('auth_key'); ?>"  type="text">
                                        <div class="help-block"><?php echo form_error('msg91_auth_key'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="msg91_sender_id"><?php echo $this->lang->line('sender_id'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="msg91_sender_id" value="<?php echo isset($sms_setting) ? $sms_setting->msg91_sender_id : ''; ?>"  placeholder="<?php echo $this->lang->line('sender_id'); ?>" type="text">
                                        <div class="help-block"><?php echo form_error('msg91_sender_id'); ?></div>
                                    </div>
                                </div>                  
             
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="msg91_status"><?php echo $this->lang->line('is_active'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="msg91_status" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <option value="1" <?php if(isset($sms_setting) && $sms_setting->msg91_status == '1'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('yes'); ?></option>
                                            <option value="0" <?php if(isset($sms_setting) && $sms_setting->msg91_status == '0'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('no'); ?></option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('msg91_status'); ?></div>
                                    </div>
                                </div>
                               
                                <!-- PLIVO -->  
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <strong><?php echo $this->lang->line('plivo'); ?> <?php echo $this->lang->line('setting'); ?></strong>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="plivo_auth_id"><?php echo $this->lang->line('auth_id'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="plivo_auth_id" value="<?php echo isset($sms_setting) ? $sms_setting->plivo_auth_id : ''; ?>"  placeholder="<?php echo $this->lang->line('auth_id'); ?>"  type="text">
                                        <div class="help-block"><?php echo form_error('plivo_auth_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="plivo_auth_token"><?php echo $this->lang->line('auth_token'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="plivo_auth_token" value="<?php echo isset($sms_setting) ? $sms_setting->plivo_auth_token : ''; ?>"  placeholder="<?php echo $this->lang->line('auth_token'); ?>" type="text">
                                        <div class="help-block"><?php echo form_error('plivo_auth_token'); ?></div>
                                    </div>
                                </div>  
                                 
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="plivo_from_number"><?php echo $this->lang->line('from_number'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="plivo_from_number" value="<?php echo isset($sms_setting) ? $sms_setting->plivo_from_number : ''; ?>"  placeholder="<?php echo $this->lang->line('from_number'); ?>"  type="text">
                                        <div class="help-block"><?php echo form_error('plivo_from_number'); ?></div>
                                    </div>
                                </div>                  
                     
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="plivo_status"><?php echo $this->lang->line('is_active'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="plivo_status">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <option value="1" <?php if(isset($sms_setting) && $sms_setting->plivo_status == '1'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('yes'); ?></option>
                                            <option value="0" <?php if(isset($sms_setting) && $sms_setting->plivo_status == '0'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('no'); ?></option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('plivo_status'); ?></div>
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('administrator/sms/index'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php  echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_sms">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('administrator/sms/edit/'.$sms_setting->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                               
                                <?php $this->load->view('layout/school_list_edit_form'); ?> 
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <strong><?php echo $this->lang->line('clicktell'); ?> <?php echo $this->lang->line('setting'); ?></strong>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clickatell_username"><?php echo $this->lang->line('username'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="clickatell_username" value="<?php echo isset($sms_setting) ? $sms_setting->clickatell_username : ''; ?>"  placeholder="<?php echo $this->lang->line('username'); ?>"  type="text">
                                        <div class="help-block"><?php echo form_error('clickatell_username'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clickatell_password"><?php echo $this->lang->line('password'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="clickatell_password" value="<?php echo isset($sms_setting) ? $sms_setting->clickatell_password : ''; ?>"  placeholder="<?php echo $this->lang->line('password'); ?>"  type="text">
                                        <div class="help-block"><?php echo form_error('clickatell_password'); ?></div>
                                    </div>
                                </div>                  
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clickatell_api_key"><?php echo $this->lang->line('api_key'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="clickatell_api_key" value="<?php echo isset($sms_setting) ? $sms_setting->clickatell_api_key : ''; ?>"  placeholder="<?php echo $this->lang->line('api_key'); ?>"  type="text">
                                        <div class="help-block"><?php echo form_error('clickatell_api_key'); ?></div>
                                    </div>
                                </div>       
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clickatell_from_number"><?php echo $this->lang->line('from_number'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="clickatell_from_number" value="<?php echo isset($sms_setting) ? $sms_setting->clickatell_from_number : ''; ?>"  placeholder="<?php echo $this->lang->line('from_number'); ?>"  type="text">
                                        <div class="help-block"><?php echo form_error('clickatell_from_number'); ?></div>
                                    </div>
                                </div>       
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clickatell_mo_no"><?php echo $this->lang->line('clickatell_mo_no'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="clickatell_mo_no" value="<?php echo isset($sms_setting) ? $sms_setting->clickatell_mo_no : ''; ?>"  placeholder="<?php echo $this->lang->line('clickatell_mo_no'); ?>" type="text">
                                        <div class="help-block"><?php echo form_error('clickatell_mo_no'); ?></div>
                                    </div>
                                </div>       
                        
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clickatell_status"><?php echo $this->lang->line('is_active'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="clickatell_status">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <option value="1" <?php if(isset($sms_setting) && $sms_setting->clickatell_status == '1'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('yes'); ?></option>
                                            <option value="0" <?php if(isset($sms_setting) && $sms_setting->clickatell_status == '0'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('no'); ?></option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('clickatell_status'); ?></div>
                                    </div>
                                </div>
                                
                                <!-- TWILIO -->
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <strong><?php echo $this->lang->line('twilio'); ?> <?php echo $this->lang->line('setting'); ?></strong>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="twilio_account_sid"><?php echo $this->lang->line('account_sid'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="twilio_account_sid" value="<?php echo isset($sms_setting) ? $sms_setting->twilio_account_sid : ''; ?>"  placeholder="twilio_account_sid" type="text">
                                        <div class="help-block"><?php echo form_error('twilio_account_sid'); ?></div>
                                    </div>
                                </div>                                               
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="twilio_auth_token"><?php echo $this->lang->line('auth_token'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="twilio_auth_token" value="<?php echo isset($sms_setting) ? $sms_setting->twilio_auth_token : ''; ?>"  placeholder="twilio_auth_token" type="text">
                                        <div class="help-block"><?php echo form_error('twilio_auth_token'); ?></div>
                                    </div>
                                </div>                                               
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="twilio_from_number"><?php echo $this->lang->line('from_number'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="twilio_from_number" value="<?php echo isset($sms_setting) ? $sms_setting->twilio_from_number : ''; ?>"  placeholder="twilio_from_number" type="text">
                                        <div class="help-block"><?php echo form_error('twilio_from_number'); ?></div>
                                    </div>
                                </div> 
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="twilio_status"><?php echo $this->lang->line('is_active'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="twilio_status">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <option value="1" <?php if(isset($sms_setting) && $sms_setting->twilio_status == '1'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('yes'); ?></option>
                                            <option value="0" <?php if(isset($sms_setting) && $sms_setting->twilio_status == '0'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('no'); ?></option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('twilio_status'); ?></div>
                                    </div>
                                </div>
                          
                                
                                 <!-- BULK -->
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <strong><?php echo $this->lang->line('bulk'); ?> <?php echo $this->lang->line('setting'); ?></strong>
                                    </div>
                                </div>
                              
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bulk_username"><?php echo $this->lang->line('username'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="bulk_username" value="<?php echo isset($sms_setting) ? $sms_setting->bulk_username : ''; ?>"  placeholder="<?php echo $this->lang->line('username'); ?>" type="text">
                                        <div class="help-block"><?php echo form_error('bulk_username'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bulk_password"><?php echo $this->lang->line('password'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="bulk_password" value="<?php echo isset($sms_setting) ? $sms_setting->bulk_password : ''; ?>"  placeholder="<?php echo $this->lang->line('password'); ?>"  type="text">
                                        <div class="help-block"><?php echo form_error('bulk_password'); ?></div>
                                    </div>
                                </div>                  
                        
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bulk_status"><?php echo $this->lang->line('is_active'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="bulk_status">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <option value="1" <?php if(isset($sms_setting) && $sms_setting->bulk_status == '1'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('yes'); ?></option>
                                            <option value="0" <?php if(isset($sms_setting) && $sms_setting->bulk_status == '0'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('no'); ?></option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('bulk_status'); ?></div>
                                    </div>
                                </div>
                                
                                <!-- MSG91 -->    
                                 <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <strong><?php echo $this->lang->line('msg91'); ?> <?php echo $this->lang->line('setting'); ?></strong>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="msg91_auth_key"><?php echo $this->lang->line('auth_key'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="msg91_auth_key" value="<?php echo isset($sms_setting) ? $sms_setting->msg91_auth_key : ''; ?>"  placeholder="<?php echo $this->lang->line('auth_key'); ?>"  type="text">
                                        <div class="help-block"><?php echo form_error('msg91_auth_key'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="msg91_sender_id"><?php echo $this->lang->line('sender_id'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="msg91_sender_id" value="<?php echo isset($sms_setting) ? $sms_setting->msg91_sender_id : ''; ?>"  placeholder="<?php echo $this->lang->line('sender_id'); ?>" type="text">
                                        <div class="help-block"><?php echo form_error('msg91_sender_id'); ?></div>
                                    </div>
                                </div>                  
             
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="msg91_status"><?php echo $this->lang->line('is_active'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="msg91_status" >
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <option value="1" <?php if(isset($sms_setting) && $sms_setting->msg91_status == '1'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('yes'); ?></option>
                                            <option value="0" <?php if(isset($sms_setting) && $sms_setting->msg91_status == '0'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('no'); ?></option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('msg91_status'); ?></div>
                                    </div>
                                </div>
                               
                                <!-- PLIVO -->  
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <strong><?php echo $this->lang->line('plivo'); ?> <?php echo $this->lang->line('setting'); ?></strong>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="plivo_auth_id"><?php echo $this->lang->line('auth_id'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="plivo_auth_id" value="<?php echo isset($sms_setting) ? $sms_setting->plivo_auth_id : ''; ?>"  placeholder="<?php echo $this->lang->line('auth_id'); ?>"  type="text">
                                        <div class="help-block"><?php echo form_error('plivo_auth_id'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="plivo_auth_token"><?php echo $this->lang->line('auth_token'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="plivo_auth_token" value="<?php echo isset($sms_setting) ? $sms_setting->plivo_auth_token : ''; ?>"  placeholder="<?php echo $this->lang->line('auth_token'); ?>" type="text">
                                        <div class="help-block"><?php echo form_error('plivo_auth_token'); ?></div>
                                    </div>
                                </div>  
                                 
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="plivo_from_number"><?php echo $this->lang->line('from_number'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="plivo_from_number" value="<?php echo isset($sms_setting) ? $sms_setting->plivo_from_number : ''; ?>"  placeholder="<?php echo $this->lang->line('from_number'); ?>"  type="text">
                                        <div class="help-block"><?php echo form_error('plivo_from_number'); ?></div>
                                    </div>
                                </div>                  
                     
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="plivo_status"><?php echo $this->lang->line('is_active'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="plivo_status">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <option value="1" <?php if(isset($sms_setting) && $sms_setting->plivo_status == '1'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('yes'); ?></option>
                                            <option value="0" <?php if(isset($sms_setting) && $sms_setting->plivo_status == '0'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('no'); ?></option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('plivo_status'); ?></div>
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($sms_setting) ? $sms_setting->id : '' ?>" name="id" />
                                        <a href="<?php echo site_url('administrator/sms/index'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php  echo $this->lang->line('update'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  
                        <?php } ?>
                        
                          <?php if(isset($detail)){ ?>
                        <div class="tab-pane fade in active" id="tab_view_sms">
                            <div class="x_content">
                               <?php echo form_open_multipart(site_url('administrator/sms/view'), array('name' => 'view', 'id' => 'view', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('clicktell'); ?> <?php echo $this->lang->line('username'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $sms_setting->clickatell_username; ?>
                                    </div>
                                </div>                                
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('clicktell'); ?> <?php echo $this->lang->line('password'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $sms_setting->clickatell_password; ?>
                                    </div>
                                </div>                                
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('clicktell'); ?> <?php echo $this->lang->line('api_key'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $sms_setting->clickatell_api_key; ?>
                                    </div>
                                </div>                                
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('clicktell'); ?> <?php echo $this->lang->line('from_number'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $sms_setting->clickatell_from_number; ?>
                                    </div>
                                </div>                                
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('clicktell'); ?> <?php echo $this->lang->line('clickatell_mo_no'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $sms_setting->clickatell_mo_no; ?>
                                    </div>
                                </div>                                
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('clicktell'); ?> <?php echo $this->lang->line('is_active'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $sms_setting->clickatell_status ? $this->lang->line('yes'): $this->lang->line('no'); ?>
                                    </div>
                                </div>   
                                
                                
                                
                                 <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('twilio'); ?> <?php echo $this->lang->line('account_sid'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $sms_setting->twilio_account_sid; ?>
                                    </div>
                                </div>     
                                 <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('twilio'); ?> <?php echo $this->lang->line('auth_token'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $sms_setting->twilio_auth_token; ?>
                                    </div>
                                </div>     
                                 <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('twilio'); ?> <?php echo $this->lang->line('from_number'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $sms_setting->twilio_from_number; ?>
                                    </div>
                                </div>     
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('twilio'); ?> <?php echo $this->lang->line('is_active'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $sms_setting->twilio_status ? $this->lang->line('yes'): $this->lang->line('no'); ?>
                                    </div>
                                </div>    
                                
                                
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('bulk'); ?> <?php echo $this->lang->line('username'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $sms_setting->bulk_username; ?>
                                    </div>
                                </div>     
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('bulk'); ?> <?php echo $this->lang->line('password'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $sms_setting->bulk_password; ?>
                                    </div>
                                </div>     
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('bulk'); ?> <?php echo $this->lang->line('is_active'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $sms_setting->bulk_status ? $this->lang->line('yes'): $this->lang->line('no'); ?>
                                    </div>
                                </div>  
                                                                
                                
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('msg91'); ?> <?php echo $this->lang->line('auth_key'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $sms_setting->msg91_auth_key; ?>
                                    </div>
                                </div>     
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('msg91'); ?> <?php echo $this->lang->line('sender_id'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $sms_setting->msg91_sender_id; ?>
                                    </div>
                                </div>     
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('msg91'); ?> <?php echo $this->lang->line('is_active'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $sms_setting->msg91_status ? $this->lang->line('yes'): $this->lang->line('no'); ?>
                                    </div>
                                </div>  
                                
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('plivo'); ?> <?php echo $this->lang->line('auth_id'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $sms_setting->plivo_auth_id; ?>
                                    </div>
                                </div>     
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('plivo'); ?> <?php echo $this->lang->line('auth_token'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $sms_setting->plivo_auth_token; ?>
                                    </div>
                                </div>     
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('plivo'); ?> <?php echo $this->lang->line('from_number'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $sms_setting->plivo_from_number; ?>
                                    </div>
                                </div>     
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('plivo'); ?> <?php echo $this->lang->line('is_active'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $sms_setting->plivo_status ? $this->lang->line('yes'): $this->lang->line('no'); ?>
                                    </div>
                                </div>                                
                             
                                
                                <?php if(has_permission(EDIT, 'administrator', 'sms')){ ?>                                                             
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            <a href="<?php echo site_url('administrator/sms/edit/'.$sms_setting->id); ?>" class="btn btn-primary"><?php echo $this->lang->line('update'); ?></a>
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
<!-- datatable with buttons -->
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