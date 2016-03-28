<?php $this->load->view('commons/cabecalho'); ?>

<div class="container">
	<div class="page-header">
		<h1>Importando dados CSV com CodeIgniter</h1>
	</div>
	<?php if (isset($error)): ?>
		<div class="alert alert-error"><?php echo $error; ?></div>
	<?php endif; ?>
	<?php if ($this->session->flashdata('success') == TRUE): ?>
		<div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
	<?php endif; ?>

	<form method="post" action="<?=base_url('importar')?>" enctype="multipart/form-data">
		<div class="form-group">
			<label>Selecione o arquivo CSV para importação:</label>
				<input type="file" name="csvfile"/>
		</div>

		<input type="submit" value="Importar" class="btn btn-success" />
	</form>

	<br><br>
	<table class="table table-striped table-hover table-bordered">
		<caption>Contatos</caption>
		<thead>
			<tr>
				<th>Nome</th>
				<th>Email</th>
			</tr>
		</thead>
		<tbody>
			<?php if ($contatos == FALSE): ?>
				<tr><td colspan="2">Nenhum contato encontrado</td></tr>
			<?php else: ?>
				<?php foreach ($contatos as $row): ?>
					<tr>
						<td><?php echo $row['nome']; ?></td>
						<td><?php echo $row['email']; ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
</div>

<?php $this->load->view('commons/rodape'); ?>
