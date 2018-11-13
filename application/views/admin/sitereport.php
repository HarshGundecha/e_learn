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
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title" style="font-size: 1.8em;"><?=$Entity?> Info.</h3>
							<a href="<?=site_url('/admin/SiteReport/Compose')?>" style="border-style:solid;border-width: 2px;" class="btn btn-success pull-right">
								Send Mail
							</a>
					</div>
					<div class="box-body">
						<div class="alert alert-success alert-dismissible" style="display: none">
							<button type="button" onclick="$(this).parent().toggle();" class="close" aria-hidden="true">
								×
							</button>
							<h4><i class="icon fa fa-check"></i>Success Notice :)</h4>
							<div id="pageAlert">
						
							</div>
						</div>
						<table id="tblView<?=$Entity?>" class="table table-bordered table-striped text-center">
							<thead>
								<tr>
									<?php
										foreach ($thead as $th){echo "<th>$th</th>";}
									?>
								</tr>
							</thead>

							<tfoot>
								<tr>
									<?php
										foreach ($thead as $th){echo "<th>$th</th>";}
									?>
								</tr>
							</tfoot>
						</table>
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
					.$DataTableCode;
	?>
</script>