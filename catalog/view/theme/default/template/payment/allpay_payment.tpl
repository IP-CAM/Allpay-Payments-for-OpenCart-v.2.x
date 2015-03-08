<div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;">
    <?php echo $text_payment; ?><br /><br />
    <?php echo ($allpay_payment_description == "") ? "" : $text_instruction . "<br /><font color='#FF9900'>" . $allpay_payment_description . "</font><br />"; ?>	
    <br />
</div>

<div class="buttons">
    <div class="pull-right">
		<?php echo $allpay_payment_form; ?>
	</div>
</div>
<script type="text/javascript">
//<![CDATA[
    $("#__paymentButton").click(function() {
        var total = <?php echo $total; ?>;
        if (total >= 10 && total <= 2000000) {
            $.ajax({
                type: 'GET',
                url: '<?php echo $continue; ?>',
				cache: false,
				beforeSend: function() {
					$('#__paymentButton').button('loading');
				},
				complete: function() {
					$('#__paymentButton').button('reset');
				},		
                success: function() {
                    $('#__allpayForm').submit();
                }
            });
        }
        else {
            alert('<?php echo $text_total_error; ?>');
        }

        return false;
    });
//]]>
</script>
