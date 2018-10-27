 <div class="tab-pane fade in active" id="tab_view_payment">
    <div class="x_content_"> 
       <?php echo form_open(site_url(), array('name' => 'detail', 'id' => 'detail', 'class'=>'form-horizontal form-label-left'), ''); ?>

        <div class="item form-group">
            <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('month'); ?></label>
            <div class="col-md-9 col-sm-9 col-xs-8">
            : <?php echo $payment->salary_month; ?>
            </div>
        </div>
        <div class="item form-group">
            <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('grade_name'); ?></label>
            <div class="col-md-9 col-sm-9 col-xs-8">
            : <?php echo $payment->grade_name; ?>
            </div>
        </div>
        
        <div class="item form-group">
            <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('salary_type'); ?></label>
            <div class="col-md-9 col-sm-9 col-xs-8">
            : <?php echo $this->lang->line(strtolower($payment->salary_type)); ?>
            </div>
        </div>

        <?php if(strtolower($payment->salary_type) == 'monthly'){ ?>
            <div class="item form-group">
                <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('basic_salary'); ?></label>
                <div class="col-md-9 col-sm-9 col-xs-8">
                : <?php echo $payment->basic_salary; ?>
                </div>
            </div>
            <div class="item form-group">
                <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('house_rent'); ?></label>
                <div class="col-md-9 col-sm-9 col-xs-8">
                : <?php echo $payment->house_rent; ?>
                </div>
            </div>
            <div class="item form-group">
                <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('transport'); ?> <?php echo $this->lang->line('allowance'); ?></label>
                <div class="col-md-9 col-sm-9 col-xs-8">
                : <?php echo $payment->transport; ?>
                </div>
            </div>                                
            <div class="item form-group">
                <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('medical'); ?> <?php echo $this->lang->line('allowance'); ?></label>
                <div class="col-md-9 col-sm-9 col-xs-8">
                : <?php echo $payment->medical; ?>
                </div>
            </div>
            <div class="item form-group">
                <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('over_time_hourly_rate'); ?></label>
                <div class="col-md-9 col-sm-9 col-xs-8">
                : <?php echo $payment->over_time_hourly_rate; ?>
                </div>
            </div>
            <div class="item form-group">
                <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('over_time_total_hour'); ?></label>
                <div class="col-md-9 col-sm-9 col-xs-8">
                : <?php echo $payment->over_time_total_hour; ?>
                </div>
            </div>
            <div class="item form-group">
                <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('over_time_amount'); ?></label>
                <div class="col-md-9 col-sm-9 col-xs-8">
                : <?php echo $payment->over_time_amount; ?>
                </div>
            </div>
            <div class="item form-group">
                <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('provident_fund'); ?></label>
                <div class="col-md-9 col-sm-9 col-xs-8">
                : <?php echo $payment->provident_fund; ?>
                </div>
            </div>
        <?php } ?>
        
        <?php if(strtolower($payment->salary_type) == 'hourly'){ ?>
            <div class="item form-group">
                <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('hourly_rate'); ?></label>
                <div class="col-md-9 col-sm-9 col-xs-8">
                : <?php echo $payment->hourly_rate; ?>
                </div>
            </div>
            <div class="item form-group">
                <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('total_hour'); ?></label>
                <div class="col-md-9 col-sm-9 col-xs-8">
                : <?php echo $payment->total_hour; ?>
                </div>
            </div>
        <?php } ?>
        
        
        <div class="item form-group">
            <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('bonus'); ?></label>
            <div class="col-md-9 col-sm-9 col-xs-8">
            : <?php echo $payment->bonus; ?>
            </div>
        </div>
        <div class="item form-group">
            <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('penalty'); ?></label>
            <div class="col-md-9 col-sm-9 col-xs-8">
            : <?php echo $payment->penalty; ?>
            </div>
        </div>
        <div class="item form-group">
            <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('allowance'); ?></label>
            <div class="col-md-9 col-sm-9 col-xs-8">
            : <?php echo $payment->total_allowance; ?>
            </div>
        </div>
        
        <div class="item form-group">
            <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('total'); ?> <?php echo $this->lang->line('deduction'); ?></label>
            <div class="col-md-9 col-sm-9 col-xs-8">
            : <?php echo $payment->total_deduction; ?>
            </div>
        </div>
        <div class="item form-group">
            <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('gross_salary'); ?></label>
            <div class="col-md-9 col-sm-9 col-xs-8">
            : <?php echo $payment->gross_salary; ?>
            </div>
        </div>
        <div class="item form-group">
            <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('net_salary'); ?></label>
            <div class="col-md-9 col-sm-9 col-xs-8">
            : <?php echo $payment->net_salary; ?>
            </div>
        </div>                                

        <div class="item form-group">
            <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('payment'); ?> <?php echo $this->lang->line('method'); ?></label>
            <div class="col-md-9 col-sm-9 col-xs-8">
            : <?php echo $this->lang->line($payment->payment_method); ?>
            </div>
        </div>
        
         <?php if($payment->payment_method == 'cheque'){ ?>
            <div class="item form-group">
                <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('bank'); ?> <?php echo $this->lang->line('name'); ?></label>
                <div class="col-md-9 col-sm-9 col-xs-8">
                : <?php echo $payment->bank_name; ?>
                </div>
            </div>
            <div class="item form-group">
                <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('cheque'); ?></label>
                <div class="col-md-9 col-sm-9 col-xs-8">
                : <?php echo $payment->cheque_no; ?>
                </div>
            </div>
         <?php } ?> 
        
        <div class="item form-group">
            <label class="col-md-3 col-sm-3 col-xs-4"><?php echo $this->lang->line('note'); ?></label>
            <div class="col-md-9 col-sm-9 col-xs-8">
            : <?php echo $payment->note; ?>
            </div>
        </div>
        <?php if(has_permission(EDIT, 'payroll', 'payment')){ ?>
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                    <a  href="<?php echo site_url('payroll/payment/edit/'.$payment->id); ?>" class="btn btn-primary"><?php echo $this->lang->line('update'); ?></a>
                </div>
            </div>
        <?php } ?>
        <?php echo form_close(); ?>
    </div>
</div>  