<section id="product" class="module parallax product" style="padding-top: 180px; background-image: url(<?=IMAGES?>/demo/curtain/curtain-3.jpg)">
	<div class=" container clearfix">
		<div class="primary-content post">
			<div class="card">
				<header class="header clearfix">
					<h1 class="tac"><i class="icon-book"></i> Booking History</h1>
				</header>

				<div class="clearfix">
					<table class="table-bordered" style="color:#000;">
						<thead>
							<tr style="color:#fff; background-color: #003;">
								<th width="10%">วันที่</th>
								<th width="10%">CODE</th>
								<th width="40%">ซีรีย์</th>
								<th width="5%">ที่นั่ง</th>
								<th width="10%">ราคา</th>
								<th width="10%">สถานะ</th>
								<th width="10%">จัดการ</th>
							</tr>
						</thead>
						<tbody>
							<?php if( !empty($this->results["lists"]) ) { 
								foreach ($this->results["lists"] as $key => $value) {
									$dayStr = date("d", strtotime($value["book_date"]));
									$monthStr =  $this->fn->q('time')->month( date("n", strtotime($value["book_date"])) );
									$yearStr = date("Y", strtotime($value["book_date"])) + 543;

									$timeStr = date("H:i:s", strtotime($value["book_date"]));
									$dateTime = "{$dayStr} {$monthStr} {$yearStr}";
									?>
									<tr>
										<td class="tac"><?=$dateTime?><br/><?=$timeStr?></td>
										<td class="tac"><?=$value["book_code"]?></td>
										<td></td>
										<td class="tac"><?=$value["book_qty"]?></td>
										<td></td>
										<td class="tac">
											<span class="fwb status_<?=$value['status']?>"><?=$value["book_status"]['name']?></span>
										</td>
										<td></td>
									</tr>
									<?php } 
								}
								else{
									echo '<tr><td colspan="6" style="color:red;" class="tac fwb">ไม่มีข้อมูลการจอง</td></tr>';
								} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>