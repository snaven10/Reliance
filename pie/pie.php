
					</div>
				</div>
				<?php
					include 'modal.php';
				 ?>
				<?php if (isset($_SESSION['Id']) && isset($_SESSION['Nivel']) && $_SESSION['Nivel'] == 2 || $_SESSION['Nivel'] == 3 ) {
				 ?>
				<script type="text/javascript">
					$(document).ready(function() {
						data_table();
						$(".contP").hide('slow');
						$.post('../admin/addentradas.php', {key: '0.01'}, function(data, textStatus, xhr) {
							$("#dp").html(data);
						});

						$('#vp').click(function(event) {
							shCont();
						});
					})
				</script>
				<?php }else if(isset($_SESSION['Id']) && isset($_SESSION['Nivel']) && $_SESSION['Nivel'] ==1){ ?>
				<script type="text/javascript">
					$(document).ready(function() {
						data_table();
						$(".contP").hide('slow');
						$.post('../admin/addSSpedido.php', {key: '0.01'}, function(data, textStatus, xhr) {
							$("#dp").html(data);
						});

						$('#vp').click(function(event) {
							shCont();
						});
					});
				</script>
				<?php } ?>
			</body>
		</html>
