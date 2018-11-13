<link rel="stylesheet" href="<?=base_url('resources/admin/assets/')?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<div class="content-wrapper">
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Compose New Message</h3>
          </div>
          <form method="POST" action="<?=site_url('/admin/SiteReport/Send')?>">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group no-margin">
                <input name="aMailTo" class="form-control" placeholder="To:" value="<?=isset($SendTo)?$SendTo:''?>">
                <?=form_error('aMailTo');?>
              </div>
              <div class="form-group no-margin">
                <input name="aSubject" class="form-control" placeholder="Subject:">
              </div>
              <div class="form-group">
                    <textarea placeholder="Message" name="aMessage" id="compose-textarea" class="form-control" style="height: 300px"></textarea>
                    <?=form_error('aMessage');?>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <button type="submit" class="btn btn-primary btn-raised"><i class="fa fa-envelope-o"></i> Send</button>
              </div>
              <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i> Reset</button>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
        <!-- /. box -->
      </div>
      <script>
        $(function () {
          //Add text editor
          $("#compose-textarea").wysihtml5();
        });
      </script>
    </div>
  </div>
</div>
<script src="<?=base_url('resources/admin/assets/')?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>