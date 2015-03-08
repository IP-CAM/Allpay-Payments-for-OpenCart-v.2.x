<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-bank-transfer" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <div class="warning"><?php echo $error_warning; ?>
		<button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
    <?php } ?>
    <div class="panel panel-default">
	  <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
        <div class="panel-body">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-bank-transfer" class="form-horizontal">
            <?php foreach ($languages as $language) { ?>
            <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-bank<?php echo $language['language_id']; ?>"><?php echo $entry_bank; ?></label>
                <div class="col-sm-10">
					<div class="input-group"><span class="input-group-addon"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /></span>
						<textarea name="bank_mandiri_bank<?php echo $language['language_id']; ?>" cols="80" rows="10" placeholder="<?php echo $entry_bank; ?>" id="input-bank<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset(${'bank_mandiri_bank' . $language['language_id']}) ? ${'bank_mandiri_bank' . $language['language_id']} : ''; ?></textarea>
					</div>
					<?php if (${'error_bank' . $language['language_id']}) { ?>
					<div class="text-danger"><?php echo ${'error_bank' . $language['language_id']}; ?></div>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
			
            <div class="form-group required">
				<label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_test_mode; ?></label>
                <div class="col-sm-10">
					<select name="allpay_<?php echo $entry_subfix; ?>_test_mode" id="input-order-status" class="form-control">
                        <option value="1" <?php echo ($allpay_test_mode ? 'selected="selected"' : ''); ?> >Yes</option>
                        <option value="0" <?php echo (!$allpay_test_mode ? 'selected="selected"' : ''); ?> >No</option>
                    </select>
				</div>
            </div>
			
			<div class="form-group">
				<label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_test_fix; ?></label>
				<div class="col-sm-10">
                    <input type="text" name="allpay_<?php echo $entry_subfix; ?>_test_fix" value="<?php echo isset($allpay_test_fix) ? $allpay_test_fix : ''; ?>" id="input-sort-order" class="form-control" />
					<br />
					<?php if (isset($error_warning5)) { ?>
						<div class="text-danger"><?php echo $error_warning5; ?></div>
					<?php } ?>
                </div>
            </div>
			
			<div class="form-group required">
			<label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_merchant_id; ?></label>
				<div class="col-sm-10">
                    <input type="text" name="allpay_<?php echo $entry_subfix; ?>_merchant_id" value="<?php echo isset($allpay_merchant_id) ? $allpay_merchant_id : ''; ?>" id="input-sort-order" class="form-control" />
					<br />
					<?php if (isset($error_warning2)) { ?>
						<div class="text-danger"><?php echo $error_warning2; ?></div>
					<?php } ?>
				</div>
			</div>
			
			<div class="form-group required">
			<label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_hash_key; ?></label>
				<div class="col-sm-10">
                    <input type="text" name="allpay_<?php echo $entry_subfix; ?>_hash_key" value="<?php echo isset($allpay_hash_key) ? $allpay_hash_key : ''; ?>" id="input-sort-order" class="form-control" />
					<br />
					<?php if (isset($error_warning3)) { ?>
						<div class="text-danger"><?php echo $error_warning3; ?></div>
					<?php } ?>
				</div>
			</div>
			
			<div class="form-group required">
			<label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_hash_iv; ?></label>
				<div class="col-sm-10">
                    <input type="text" name="allpay_<?php echo $entry_subfix; ?>_hash_iv" value="<?php echo isset($allpay_hash_iv) ? $allpay_hash_iv : ''; ?>" id="input-sort-order" class="form-control" />
					<br />
					<?php if (isset($error_warning4)) { ?>
						<div class="text-danger"><?php echo $error_warning4; ?></div>
					<?php } ?>
				</div>
			</div>
			
			 <div class="form-group">
				<label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_order_status; ?></label>
				<div class="col-sm-10">
				  <select name="allpay_<?php echo $entry_subfix; ?>_order_status_id" id="input-order-status" class="form-control">
					<?php foreach ($order_statuses as $order_status) { ?>
					<?php if ($order_status['order_status_id'] == $bank_mandiri_order_status_id) { ?>
					<option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
					<?php } else { ?>
					<option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
					<?php } ?>
					<?php } ?>
				  </select>
				</div>
			 </div>
			
			<div class="form-group">
				<label class="col-sm-2 control-label" for="input-geo-zone"><?php echo $entry_order_finish_status; ?></label>
				<div class="col-sm-10">
				  <select name="allpay_<?php echo $entry_subfix; ?>_order_finish_status_id" id="input-order-finish-status" class="form-control">
						<?php foreach ($order_statuses as $order_status) { ?>
						<?php if ($order_status['order_status_id'] == '15') { ?>
						<option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
						<?php } else { ?>
						<option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
						<?php } ?>
						<?php } ?>
				  </select>
				</div>
			</div>
					
			<div class="form-group">
				<label class="col-sm-2 control-label" for="input-geo-zone"><?php echo $entry_geo_zone; ?></label>
				<div class="col-sm-10">
				  <select name="allpay_<?php echo $entry_subfix; ?>_geo_zone_id" id="input-geo-zone" class="form-control">
					<option value="0"><?php echo $text_all_zones; ?></option>
					<?php foreach ($geo_zones as $geo_zone) { ?>
					<?php if ($geo_zone['geo_zone_id'] == $bank_mandiri_geo_zone_id) { ?>
					<option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
					<?php } else { ?>
					<option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
					<?php } ?>
					<?php } ?>
				  </select>
				</div>
			</div>
			
			 <div class="form-group">
				<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
				<div class="col-sm-10">
				  <select name="allpay_<?php echo $entry_subfix; ?>_status" id="input-status" class="form-control">
					<?php if ($allpay_status) { ?>
					<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
					<option value="0"><?php echo $text_disabled; ?></option>
					<?php } else { ?>
					<option value="1"><?php echo $text_enabled; ?></option>
					<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
					<?php } ?>
				  </select>
				</div>
			 </div>
			 
			<div class="form-group">
				<label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
				<div class="col-sm-10">
				  <input type="text" name="allpay_<?php echo $entry_subfix; ?>_sort_order" value="<?php echo $allpay_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
				</div>
			</div>
          </form>
        </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>