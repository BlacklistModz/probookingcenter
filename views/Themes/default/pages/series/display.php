<section id="product" class="module parallax product" style="padding-top: 180px; background-image: url(<?=IMAGES?>/demo/curtain/curtain-3.jpg)">
	<div class=" clearfix">
		<div class="primary-content post">
			<div class="card">
				<header class="header clearfix">
					<h1 class="tac"><i class="icon-book"></i> Series Online</h1>
				</header>
				<div class="clearfix">
					<?php foreach ($this->results['lists'] as $key => $value) { ?>
					<table class="table-bordered mtl" width="100%">
						<caption><?=$value['name']?></caption>
						<thead>
							<tr>
								<th>TESt</th>
							</tr>
						</thead>
					</table>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>