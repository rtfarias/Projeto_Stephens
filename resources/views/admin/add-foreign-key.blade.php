<tr data-count="<?php echo $count; ?>">
	<td>
		<input id="fk-label-<?php echo $count; ?>" type="text" class="form-control" name="fk-label[]" value="">
	</td>
	<td>
		<input id="fk-nome-<?php echo $count; ?>" type="text" class="form-control" name="fk-nome[]" value="">
	</td>
	<td>
		<select class="form-control" name="fk-modulo[]">
			<?php foreach ($modulos as $modulo): ?>
				<option value="<?php echo $modulo->id; ?>"><?php echo $modulo->label; ?></option>
			<?php endforeach; ?>
		</select>
	</td>
	<td>
		<select class="form-control" name="fk-campo-label[]">
			<?php foreach ($modulos as $modulo): ?>
				<optgroup data-id="<?php echo $modulo->id; ?>" label="<?php echo $modulo->label; ?>">
					<?php foreach ($modulo->campos as $campo): ?>
						<option value="<?php echo $campo->id; ?>"><?php echo $campo->label; ?></option>
					<?php endforeach; ?>
				</optgroup>
			<?php endforeach; ?>
		</select>
	</td>
	<td>
		<select class="form-control" name="fk-listagem[]">
			<option value="1">Sim</option>
			<option value="0">Não</option>
		</select>
	</td>
	<td>
		<input type="text" class="form-control" name="fk-ordem[]" value="">
	</td>
	<td>
		<button type="button" class="btn btn-danger removeFk"><i class="fa fa-trash-o"></i></button>
	</td>
</tr>
<script>
	$('tr[data-count="<?php echo $count; ?>"] .removeFk').click(function(){
		$(this).closest('tr').remove();
	});
	$('tr[data-count="<?php echo $count; ?>"] [name="fk-modulo[]"]').change(function(){
		var campo_label_select = $(this).closest('tr').find('[name="fk-campo-label[]"]');
		campo_label_select.find('option:selected').prop('selected',false);
		campo_label_select.find('optgroup').hide();
		campo_label_select.find('optgroup[data-id="'+$(this).find('option:selected').val()+'"]').show();
		campo_label_select.find('option:visible:eq(0)').prop('selected',true);
	});$('tr[data-count="<?php echo $count; ?>"] [name="fk-modulo[]"]').trigger('change');

</script>
