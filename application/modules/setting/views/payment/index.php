<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-dollar"></i><small> <?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('setting'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content quick-link">
                <?php echo $this->lang->line('quick_link'); ?>:
                <?php if(has_permission(VIEW, 'setting', 'setting')  && $this->session->userdata('role_id') != SUPER_ADMIN){ ?>
                    <a href="<?php echo site_url('setting'); ?>"><?php echo $this->lang->line('general'); ?> <?php echo $this->lang->line('setting'); ?></a>
                <?php } ?>
                <?php if(has_permission(VIEW, 'setting', 'payment')){ ?>
                  | <a href="<?php echo site_url('setting/payment'); ?>"><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('setting'); ?></a>
                <?php } ?>
                <?php if(has_permission(VIEW, 'setting', 'sms')){ ?>
                   | <a href="<?php echo site_url('setting/sms'); ?>"><?php echo $this->lang->line('sms'); ?> <?php echo $this->lang->line('setting'); ?></a>                    
                <?php } ?>                 
            </div>
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    <ul  class="nav nav-tabs bordered">                     
                        <li  class="<?php echo isset($paypal) ? 'active':''; ?>"><a href="#tab_paypal_setting"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-gear"></i> <?php echo $this->lang->line('paypal'); ?> <?php echo $this->lang->line('setting'); ?></a> </li>                          
                        <!--<li  class="<?php echo isset($stripe) ? 'active':''; ?>"><a href="#tab_stripe_setting"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-gear"></i> <?php echo $this->lang->line('stripe'); ?> <?php echo $this->lang->line('setting'); ?></a> </li>-->                          
                        <li  class="<?php echo isset($payumoney) ? 'active':''; ?>"><a href="#tab_pumoney_setting"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-gear"></i> <?php echo $this->lang->line('payumoney'); ?> <?php echo $this->lang->line('setting'); ?></a> </li>                          
                    </ul>
                    <br/>
                    <div class="tab-content">
               
                        <div class="tab-pane fade in <?php echo isset($paypal) ? 'active':''; ?>" id="tab_paypal_setting">
                            <div class="x_content"> 
                                <?php echo form_open_multipart(site_url('setting/payment/paypal'), array('name' => 'paypal', 'id' => 'paypal', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                <?php $this->load->view('layout/school_list_form'); ?>
                                <input type="hidden" value="<?php echo isset($setting) ? $setting->id : ''; ?>" name="id" />
                                <input type="hidden" value="1" name="paypal" />
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paypal_email"><?php echo $this->lang->line('paypal'); ?> <?php echo $this->lang->line('email'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="paypal_email" value="<?php echo isset($setting) ? $setting->paypal_email : ''; ?>"  placeholder="<?php echo $this->lang->line('paypal'); ?> <?php echo $this->lang->line('email'); ?>" required="required" type="email">
                                        <div class="help-block"><?php echo form_error('paypal_email'); ?></div>
                                    </div>
                                </div>                  
                        
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paypal_demo"><?php echo $this->lang->line('is_demo'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="paypal_demo" required="required">
                                            <option value="1" <?php if(isset($setting) && $setting->paypal_demo == '1'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('yes'); ?></option>
                                            <option value="0" <?php if(isset($setting) && $setting->paypal_demo == '0'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('no'); ?></option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('paypal_demo'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="paypal_status"><?php echo $this->lang->line('is_active'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="paypal_status" required="required">
                                            <option value="1" <?php if(isset($setting) && $setting->paypal_status == '1'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('yes'); ?></option>
                                            <option value="0" <?php if(isset($setting) && $setting->paypal_status == '0'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('no'); ?></option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('paypal_status'); ?></div>
                                    </div>
                                </div>
                          
                         
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('dashboard'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo isset($setting) ? $this->lang->line('update') : $this->lang->line('submit'); ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div> 
                        
                          <div class="tab-pane fade in <?php echo isset($stripe) ? 'active':''; ?> display" id="tab_stripe_setting">
                             <div class="x_content"> 
                                <?php echo form_open_multipart(site_url('setting/payment/stripe'), array('name' => 'stripe', 'id' => 'stripe', 'class'=>'form-horizontal form-label-left'), ''); ?>
                               
                                <?php $this->load->view('layout/school_list_form'); ?>
                                 <input type="hidden" value="<?php echo isset($setting) ? $setting->id : ''; ?>" name="id" />
                                <input type="hidden" value="1" name="stripe" />
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="stripe_secret"><?php echo $this->lang->line('secret'); ?> <?php echo $this->lang->line('key'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="stripe_secret" value="<?php echo isset($setting) ? $setting->stripe_secret : ''; ?>"  placeholder="stripe_secret" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('stripe_secret'); ?></div>
                                    </div>
                                </div>                                               
                        
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="stripe_demo"><?php echo $this->lang->line('is_demo'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="stripe_demo" required="required">
                                            <option value="1" <?php if(isset($setting) && $setting->stripe_demo == '1'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('yes'); ?></option>
                                            <option value="0" <?php if(isset($setting) && $setting->stripe_demo == '0'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('no'); ?></option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('stripe_demo'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="stripe_status"><?php echo $this->lang->line('is_active'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="stripe_status" required="required">
                                            <option value="1" <?php if(isset($setting) && $setting->stripe_status == '1'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('yes'); ?></option>
                                            <option value="0" <?php if(isset($setting) && $setting->stripe_status == '0'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('no'); ?></option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('stripe_status'); ?></div>
                                    </div>
                                </div>
                          
                         
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('dashboard'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo isset($setting) ? $this->lang->line('update') : $this->lang->line('submit') ?></button>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div> 
                        
                          <div class="tab-pane fade in <?php echo isset($payumoney) ? 'active':''; ?>" id="tab_pumoney_setting">
                            <div class="x_content"> 
                                <?php echo form_open_multipart(site_url('setting/payment/payumoney'), array('name' => 'payumoney', 'id' => 'payumoney', 'class'=>'form-horizontal form-label-left'), ''); ?>
                                
                                <?php $this->load->view('layout/school_list_form'); ?>
                                <input type="hidden" value="<?php echo isset($setting) ? $setting->id : ''; ?>" name="id" />
                                 <input type="hidden" value="1" name="payumoney" />
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payumoney_key"><?php echo $this->lang->line('payumoney'); ?> <?php echo $this->lang->line('key'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="payumoney_key" value="<?php echo isset($setting) ? $setting->payumoney_key : ''; ?>"  placeholder="<?php echo $this->lang->line('payumoney'); ?> <?php echo $this->lang->line('key'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('payumoney_key'); ?></div>
                                    </div>
                                </div>
                                
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payumoney_salt"><?php echo $this->lang->line('payumoney'); ?> <?php echo $this->lang->line('key_salt'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  class="form-control col-md-7 col-xs-12"  name="payumoney_salt" value="<?php echo isset($setting) ? $setting->payumoney_salt : ''; ?>"  placeholder="<?php echo $this->lang->line('payumoney'); ?> <?php echo $this->lang->line('key_salt'); ?>" required="required" type="text">
                                        <div class="help-block"><?php echo form_error('payumoney_salt'); ?></div>
                                    </div>
                                </div>                  
                        
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payumoney_demo"><?php echo $this->lang->line('is_demo'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="payumoney_demo" required="required">
                                            <option value="1" <?php if(isset($setting) && $setting->payumoney_demo == '1'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('yes'); ?></option>
                                            <option value="0" <?php if(isset($setting) && $setting->payumoney_demo == '0'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('no'); ?></option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('payumoney_demo'); ?></div>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payumoney_status"><?php echo $this->lang->line('is_active'); ?> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select  class="form-control col-md-7 col-xs-12"  name="payumoney_status" required="required">
                                            <option value="1" <?php if(isset($setting) && $setting->payumoney_status == '1'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('yes'); ?></option>
                                            <option value="0" <?php if(isset($setting) && $setting->payumoney_status == '0'){ echo 'selected="selected"';} ?>><?php echo $this->lang->line('no'); ?></option>
                                        </select>
                                        <div class="help-block"><?php echo form_error('payumoney_status'); ?></div>
                                    </div>
                                </div>
                          
                         
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="<?php echo site_url('dashboard'); ?>" class="btn btn-primary"><?php echo $this->lang->line('cancel'); ?></a>
                                        <button id="send" type="submit" class="btn btn-success"><?php echo isset($setting) ? $this->lang->line('update') : $this->lang->line('submit'); ?></button>
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
<script type="text/javascript">
    $("#paypal").validate();  
    $("#stripe").validate();  
    $("#payumoney").validate();  
</script>