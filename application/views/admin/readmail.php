<div class="content-wrapper">
	<!-- 
		<section class="content-header">
			<h1>
				Data Tables
				<small>advanced tables</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Tables</a>`</li>
				<li class="active">Data tables</li>
			</ol>
		</section>
	 -->
	<section class="content">
		<div class="row">
<div class="col-md-10 col-md-offset-1">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Read Report</h3>
		</div>
		<div class="box-body no-padding">
			<div class="mailbox-read-info">
				<h3><?=$rd[0]->SiteReportSubject;?></h3>
				<h5>From: <?=$rd[0]->UserEmail;?>
					<span class="mailbox-read-time pull-right" title="<?=$rd[0]->CreatedDateTime;?>" data-toggle="tooltip">
    					<?php
    						$dt = DateTime::createFromFormat('Y-m-d H:i:s', $rd[0]->CreatedDateTime);
    						$dd3 = $dt->getTimestamp();
    						echo timespan($dd3, '', 2). ' ago';
    					?>					    
					</span>
				</h5>
			</div>
			<div class="mailbox-read-message">
                <?=$rd[0]->SiteReportContent;?>
			</div>
		</div>
		<div class="box-footer">
			<div class="pull-right">
				<a href="<?=site_url('/admin/SiteReport/Compose/'.$rd[0]->UserEmail);?>" class="btn btn-default"><i class="fa fa-reply"></i> Reply</a>
			</div>
		</div>
	</div>
</div>
		</div>
	</section>
</div>
<script type="text/javascript">

	<?php

		$this->load->helper([
			'AIOAjax_helper',
			'addUpdateEntityAjaxCode_helper'
		]);

		echo AIOAjax()
					.$DataTableCode
						.addEntityAjaxCode($Entity,true)
							.updateEntityAjaxCode($Entity,true);

	?>
</script>