<?php

$url = URL .'user/';

?><div class="pal"><div class="setting-header cleafix">

<div class="rfloat">

	<a class="btn btn-green" data-plugins="dialog" href="<?=$url?>add_group"><i class="icon-plus mrs"></i><span><?=$this->lang->translate('Add New')?></span></a>

</div>

<div class="setting-title">กลุ่มผู้ใช้งาน</div>
</div>

<section class="setting-section">
	<table class="settings-table admin"><tbody>
		<tr>
			<th class="name"><?=$this->lang->translate('Name')?></th>
			<th class="actions"><?=$this->lang->translate('Action')?></th>

		</tr>

		<?php foreach ($this->data as $key => $item) { ?>
		<tr>
			<td class="name"><?=$item['name']?></td>

			<td class="actions whitespace">
				<span class="gbtn">
					<a data-plugins="dialog" href="<?=$url?>edit_group/<?=$item['id']?>" class="btn btn-blue btn-no-padding"><i class="icon-pencil"></i></a>
				</span>
				<span class="gbtn">
					<a data-plugins="dialog" href="<?=$url?>del_group/<?=$item['id']?>" class="btn btn-red btn-no-padding"><i class="icon-trash"></i></a>
				</span>
			</td>

		</tr>
		<?php } ?>
	</tbody></table>
</section>
</div>