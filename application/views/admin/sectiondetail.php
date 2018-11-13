<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Section Detail</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="box-body no-padding">
						<div class="mailbox-read-info">
							<h3>Name : <?=$sd['section_data'][0]->SectionName?></h3>
							<h5>Posted By : <a href="<?=site_url('/admin/admin/admindetail/'.$sd['section_data'][0]->AddedByAdminID);?>"><?=$sd['section_data'][0]->AddedByAdminName?></a>
								<span class="mailbox-read-time pull-right">Posted On : <?=$sd['section_data'][0]->CreatedDateTime?></span>
							</h5>
						</div>
						
						<div class="mailbox-read-message">
							<p>
								<?=$sd['section_data'][0]->SectionContent?>
							</p>
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

	echo AIOAjax();
//.$DataTableCode
//.addEntityAjaxCode($Entity,true)
//.updateEntityAjaxCode($Entity,true);

	?>
</script>