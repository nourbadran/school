<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-gears"></i><small> <?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('setting'); ?></small></h3>
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
                        <li class="<?php if(isset($list)){ echo 'active'; }?>"><a href="#tab_payment_list"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list-ol"></i> <?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('setting'); ?> <?php echo $this->lang->line('list'); ?></a> </li>
                        <?php if(has_permission(ADD, 'administrator', 'payment')){ ?>
                            <?php if(isset($edit)){ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="<?php echo site_url('administrator/payment/add'); ?>"  aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('setting'); ?></a> </li>                          
                             <?php }else{ ?>
                                <li  class="<?php if(isset($add)){ echo 'active'; }?>"><a href="#tab_add_payment"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> <?php echo $this->lang->line('add'); ?> <?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('setting'); ?> </a> </li>                          
                             <?php } ?>
                        <?php } ?>  
                            
                        <?php if(isset($edit)){ ?>
                            <li  class="active"><a href="#tab_edit_payment"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> <?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('setting'); ?> </a> </li>                          
                        <?php } ?>
                            
                        <?php if(isset($detail)){ ?>
                            <li  class="active"><a href="#tab_view_payment"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> <?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('setting'); ?></a> </li>                          
                        <?php } ?>     
                    </ul>
                    <br/>
                    
                    <div class="tab-content">
                        <div  class="tab-pane fade in <?php if(isset($list)){ echo 'active'; }?>" id="tab_payment_list" >
                            <div class="x_content">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('sl_no'); ?></th>
                                        <th><?php echo $this->lang->line('school'); ?></th>
                                        <th><?php echo $this->lang->line('paypal'); ?> <?php echo $this->lang->line('email'); ?></th>
                                        <th><?php echo $this->lang->line('paypal'); ?> <?php echo $this->lang->line('is_active'); ?></th>
                                        <th><?php echo $this->lang->line('payumoney'); ?> <?php echo $this->lang->line('key'); ?></th>
                                        <th><?php echo $this->lang->line('payumoney'); ?> <?php echo $this->lang->line('is_active'); ?></th>
                                        <th><?php echo $this->lang->line('action'); ?></th>                                            
                                    </tr>
                                </thead>
                                <tbody>   
                                    <?php $count = 1; if(isset($payment_settings) && !empty($payment_settings)){ ?>
                                        <?php foreach($payment_settings as $obj){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $obj->school_name; ?></td>
                                            <td><?php echo $obj->paypal_email; ?></td>
                                            <td><?php echo $obj->paypal_status ? $this->lang->line('yes') : $this->lang->line('no'); ?></td>
                                            <td><?php echo $obj->payumoney_key; ?></td>
                                            <td><?php echo $obj->payumoney_status ? $this->lang->line('yes') : $this->lang->line('no'); ?></td>                                           
                                            
                                            <td>
                                                <?php if(has_permission(VIEW, 'administrator', 'payment')){ ?>
                                                    <a href="<?php echo site_url('administrator/payment/view/'.$obj->id); ?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> <?php echo $this->lang->line('view'); ?> </a>
                                                <?php } ?>
                                                <?php if(has_permission(EDIT, 'administrator', 'payment')){ ?>
                                                    <a href="<?php echo site_url('administrator/payment/edit/'.$obj->id); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo $this->lang->line('edit'); ?> </a>
                                                <?php } ?>
                                                <?php if(has_permission(DELETE, 'administrator', 'payment')){ ?>
                                                    <a href="<?php echo site_url('administrator/payment/delete/'.$obj->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?> </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>                                
                            </div>
                        </div>

                        <div  class="tab-pane fade in <?php if(isset($add)){ echo 'active'; }?>" id="tab_add_payment">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('administrator/payment/add'), array('name' => 'add', 'id' => 'add', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <?php $this->load->view('layout/school_list_form'); ?> 
                                
                                <!-- Paypal -->
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <strong><?php echo $this->lang->line('paypal'); ?> <?php echo $this->lang->line('setting'); ?></strong>
                                    </div>
                                </div>
                                <!--<div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paypal_api_username">paypal_api_username <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="paypal_api_username" value="<?php echo isset($setting) ? $setting->paypal_api_username : ''; ?>"  placeholder="paypal_api_username" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('paypal_api_username'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paypal_api_password">paypal_api_password <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="paypal_api_password" value="<?php echo isset($setting) ? $setting->paypal_api_password : ''; ?>"  placeholder="paypal_api_password" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('paypal_api_password'); ?></div>
                                    </div>
                                </div>                  
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paypal_api_signature">paypal_api_signature <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="paypal_api_signature" value="<?php echo isset($setting) ? $setting->paypal_api_signature : ''; ?>"  placeholder="paypal_api_signature" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('paypal_api_signature'); ?></div>
                                    </div>
                                </div> -->                 
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paypal_email"><?php echo $this->lang->line('paypal'); ?> <?php echo $this->lang->line('email'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="paypal_email" value="<?php echo isset($payment_setting) ? $payment_setting->paypal_email : ''; ?>"  placeholder="<?php echo $this->lang->line('paypal'); ?> <?php echo $this->lang->line('email'); ?>" type="email">
                                        <div class="help-block"><?php echo form_error('paypal_email'); ?></div>
                                    </div>
                                </div>                  
                        
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paypal_demo"><?php echo $this->lang->line('is_demo'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="paypal_demo">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <option value="1" <?php if(isset($payment_setting) && $payment_setting->paypal_demo == '1'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('yes'); ?></option>
                                            <option value="0" <?php if(isset($payment_setting) && $payment_setting->paypal_demo == '0'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('no'); ?></option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('paypal_demo'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paypal_status"><?php echo $this->lang->line('is_active'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="paypal_status">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <option value="1" <?php if(isset($payment_setting) && $payment_setting->paypal_status == '1'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('yes'); ?></option>
                                            <option value="0" <?php if(isset($payment_setting) && $payment_setting->paypal_status == '0'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('no'); ?></option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('paypal_status'); ?></div>
                                    </div>
                                </div>
                                
                                
                                <!-- PayUMoney -->
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <strong><?php echo $this->lang->line('payumoney'); ?> <?php echo $this->lang->line('setting'); ?></strong>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payumoney_key"><?php echo $this->lang->line('payumoney'); ?> <?php echo $this->lang->line('key'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="payumoney_key" value="<?php echo isset($payment_setting) ? $payment_setting->payumoney_key : ''; ?>"  placeholder="<?php echo $this->lang->line('payumoney'); ?> <?php echo $this->lang->line('key'); ?>" type="text">
                                        <div class="help-block"><?php echo form_error('payumoney_key'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payumoney_salt"><?php echo $this->lang->line('payumoney'); ?> <?php echo $this->lang->line('key_salt'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="payumoney_salt" value="<?php echo isset($payment_setting) ? $payment_setting->payumoney_salt : ''; ?>"  placeholder="<?php echo $this->lang->line('payumoney'); ?> <?php echo $this->lang->line('key_salt'); ?>" type="text">
                                        <div class="help-block"><?php echo form_error('payumoney_salt'); ?></div>
                                    </div>
                                </div>                  
                        
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payumoney_demo"><?php echo $this->lang->line('is_demo'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="payumoney_demo">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <option value="1" <?php if(isset($payment_setting) && $payment_setting->payumoney_demo == '1'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('yes'); ?></option>
                                            <option value="0" <?php if(isset($payment_setting) && $payment_setting->payumoney_demo == '0'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('no'); ?></option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('payumoney_demo'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payumoney_status"><?php echo $this->lang->line('is_active'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="payumoney_status">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <option value="1" <?php if(isset($payment_setting) && $payment_setting->payumoney_status == '1'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('yes'); ?></option>
                                            <option value="0" <?php if(isset($payment_setting) && $payment_setting->payumoney_status == '0'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('no'); ?></option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('payumoney_status'); ?></div>
                                    </div>
                                </div>                                
                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('administrator/payment/index'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php  echo $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  

                        <?php if(isset($edit)){ ?>
                        <div class="tab-pane fade in active" id="tab_edit_payment">
                            <div class="x_content"> 
                               <?php echo form_open_multipart(site_url('administrator/payment/edit/'.$payment_setting->id), array('name' => 'edit', 'id' => 'edit', 'class'=>'form-horizontal form-label-left'), ''); ?>
                               
                                <?php $this->load->view('layout/school_list_edit_form'); ?> 
                                
                                <!-- Paypal -->
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <strong><?php echo $this->lang->line('paypal'); ?> <?php echo $this->lang->line('setting'); ?></strong>
                                    </div>
                                </div>
                                <!--<div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paypal_api_username">paypal_api_username <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="paypal_api_username" value="<?php echo isset($setting) ? $setting->paypal_api_username : ''; ?>"  placeholder="paypal_api_username" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('paypal_api_username'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paypal_api_password">paypal_api_password <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="paypal_api_password" value="<?php echo isset($setting) ? $setting->paypal_api_password : ''; ?>"  placeholder="paypal_api_password" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('paypal_api_password'); ?></div>
                                    </div>
                                </div>                  
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paypal_api_signature">paypal_api_signature <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="paypal_api_signature" value="<?php echo isset($setting) ? $setting->paypal_api_signature : ''; ?>"  placeholder="paypal_api_signature" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('paypal_api_signature'); ?></div>
                                    </div>
                                </div> -->                 
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paypal_email"><?php echo $this->lang->line('paypal'); ?> <?php echo $this->lang->line('email'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="paypal_email" value="<?php echo isset($payment_setting) ? $payment_setting->paypal_email : ''; ?>"  placeholder="<?php echo $this->lang->line('paypal'); ?> <?php echo $this->lang->line('email'); ?>" type="email">
                                        <div class="help-block"><?php echo form_error('paypal_email'); ?></div>
                                    </div>
                                </div>                  
                        
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paypal_demo"><?php echo $this->lang->line('is_demo'); ?> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="paypal_demo">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <option value="1" <?php if(isset($payment_setting) && $payment_setting->paypal_demo == '1'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('yes'); ?></option>
                                            <option value="0" <?php if(isset($payment_setting) && $payment_setting->paypal_demo == '0'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('no'); ?></option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('paypal_demo'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paypal_status"><?php echo $this->lang->line('is_active'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="paypal_status">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <option value="1" <?php if(isset($payment_setting) && $payment_setting->paypal_status == '1'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('yes'); ?></option>
                                            <option value="0" <?php if(isset($payment_setting) && $payment_setting->paypal_status == '0'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('no'); ?></option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('paypal_status'); ?></div>
                                    </div>
                                </div>
                                
                                
                                <!-- PayUMoney -->
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <strong><?php echo $this->lang->line('payumoney'); ?> <?php echo $this->lang->line('setting'); ?></strong>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payumoney_key"><?php echo $this->lang->line('payumoney'); ?> <?php echo $this->lang->line('key'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="payumoney_key" value="<?php echo isset($payment_setting) ? $payment_setting->payumoney_key : ''; ?>"  placeholder="<?php echo $this->lang->line('payumoney'); ?> <?php echo $this->lang->line('key'); ?>" type="text">
                                        <div class="help-block"><?php echo form_error('payumoney_key'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payumoney_salt"><?php echo $this->lang->line('payumoney'); ?> <?php echo $this->lang->line('key_salt'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="payumoney_salt" value="<?php echo isset($payment_setting) ? $payment_setting->payumoney_salt : ''; ?>"  placeholder="<?php echo $this->lang->line('payumoney'); ?> <?php echo $this->lang->line('key_salt'); ?>" type="text">
                                        <div class="help-block"><?php echo form_error('payumoney_salt'); ?></div>
                                    </div>
                                </div>                  
                        
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payumoney_demo"><?php echo $this->lang->line('is_demo'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="payumoney_demo">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <option value="1" <?php if(isset($payment_setting) && $payment_setting->payumoney_demo == '1'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('yes'); ?></option>
                                            <option value="0" <?php if(isset($payment_setting) && $payment_setting->payumoney_demo == '0'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('no'); ?></option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('payumoney_demo'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payumoney_status"><?php echo $this->lang->line('is_active'); ?></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="payumoney_status">
                                            <option value="">--<?php echo $this->lang->line('select'); ?>--</option>
                                            <option value="1" <?php if(isset($payment_setting) && $payment_setting->payumoney_status == '1'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('yes'); ?></option>
                                            <option value="0" <?php if(isset($payment_setting) && $payment_setting->payumoney_status == '0'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('no'); ?></option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('payumoney_status'); ?></div>
                                    </div>
                                </div>         
                                

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <input type="hidden" value="<?php echo isset($payment_setting) ? $payment_setting->id : '' ?>" name="id" />
                                        <a href="<?php echo site_url('administrator/payment/index'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php  echo $this->lang->line('update'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>  
                        <?php } ?>
                        
                          <?php if(isset($detail)){ ?>
                        <div class="tab-pane fade in active" id="tab_view_payment">
                            <div class="x_content">
                               <?php echo form_open_multipart(site_url('administrator/payment/view'), array('name' => 'view', 'id' => 'view', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('paypal'); ?> <?php echo $this->lang->line('email'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $payment_setting->paypal_email; ?>
                                    </div>
                                </div>                                
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('paypal'); ?> <?php echo $this->lang->line('is_demo'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $payment_setting->paypal_demo ? $this->lang->line('yes'): $this->lang->line('no'); ?>
                                    </div>
                                </div>                                
                                                    
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('paypal'); ?> <?php echo $this->lang->line('is_active'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $payment_setting->paypal_status ? $this->lang->line('yes'): $this->lang->line('no'); ?>
                                    </div>
                                </div>   
                                
                                
                                
                                 <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('payumoney'); ?> <?php echo $this->lang->line('key'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $payment_setting->payumoney_key; ?>
                                    </div>
                                </div>  
                                 <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('payumoney'); ?> <?php echo $this->lang->line('key_salt'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $payment_setting->payumoney_salt; ?>
                                    </div>
                                </div>  
                                 <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('payumoney'); ?> <?php echo $this->lang->line('is_demo'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $payment_setting->payumoney_demo ? $this->lang->line('yes'): $this->lang->line('no'); ?>
                                    </div>
                                </div>  
                                <div class="item form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('payumoney'); ?> <?php echo $this->lang->line('is_active'); ?></label>
                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                    : <?php echo $payment_setting->payumoney_status ? $this->lang->line('yes'): $this->lang->line('no'); ?>
                                    </div>
                                </div>           
                             
                                
                                <?php if(has_permission(EDIT, 'administrator', 'payment')){ ?>                                                             
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            <a href="<?php echo site_url('administrator/payment/edit/'.$payment_setting->id); ?>" class="btn btn-primary"><?php echo $this->lang->line('update'); ?></a>
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