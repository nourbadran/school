<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-envelope-o"></i><small> <?php echo $this->lang->line('manage_email'); ?></small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content quick-link">
                <?php echo $this->lang->line('quick_link'); ?>:
                <?php if(has_permission(VIEW, 'message', 'mail')){ ?>
                    <a href="<?php echo site_url('message/mail/index/'); ?>"><?php echo $this->lang->line('manage_email'); ?></a> |
                <?php } ?>
                <?php if(has_permission(VIEW, 'message', 'text')){ ?>
                    <a href="<?php echo site_url('message/text/index/'); ?>"><?php echo $this->lang->line('manage_sms'); ?></a>                    
                <?php } ?>
            </div>
            
            <div class="x_content">
                <!-- Main content -->
                <section class="content">
                    <div class="row">                       
                        <!-- /.col -->
                        <div class="col-md-12">
                                <div class="box-header">
                                    <h3 class="box-title"><?php echo $this->lang->line('subject'); ?>: <?php echo $email->subject; ?></h3>              
                                </div>
                           <div class="box box-primary">
                                <!-- /.box-header -->
                                <div class="box-body no-padding">
                                  <div class="mailbox-read-info">
                                   
                                    <h5>
                                        <?php $user = get_user_by_role($email->sender_role_id, $email->created_by); ?>
                                        <?php echo $this->lang->line('sender'); ?>: <?php echo $user->name; ?>
                                    </h5>
                                    <h5>                                        
                                        <?php echo $this->lang->line('receiver_type'); ?>: <?php echo $email->receiver_type; ?>
                                    </h5>
                                    <h5>
                                        <?php echo $this->lang->line('receiver'); ?>: <?php echo $email->receivers; ?>
                                      <span class="mailbox-read-time pull-right"><?php echo date('M j, Y H:i:s a', strtotime($email->created_at)); ?></span>
                                    </h5>
                                  </div>
                                  <div class="ln_solid"></div>  
                                  <div class="mailbox-read-message">
                                    <?php echo nl2br($email->body); ?>
                                  </div>                                  
                                  
                                </div>
                               
                                <!-- /.box-footer -->
                                <div class="ln_solid no-print"></div>
                                <div class="box-footer no-print">                                 
                                    <a href="<?php echo site_url('message/mail/delete/'.$email->id); ?>" onclick="javascript: return confirm('<?php echo $this->lang->line('confirm_alert'); ?>');"><button type="button" class="btn btn-default"><i class="fa fa-trash-o"></i> <?php echo $this->lang->line('delete'); ?></button></a>
                                  <button type="button" class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> <?php echo $this->lang->line('print'); ?></button>
                                </div>
                              </div>
                            <!-- /. box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->
            </div>
        </div>
    </div>
</div>