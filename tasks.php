<section>
	<header>
		<?php include "header.php"; ?>
	</header>		
	<main>
		<div class="w3-container">
		  	<p>Clique no bot&atilde;o abaixo para inserir um nova Tarefa:</p>        
        	<p><a href="?Dados=create-task" class="w3-btn w3-teal">Criar Terefa</a></p>
			<?php 
				$consulta = "SELECT * FROM tasks where user_id = ".$_SESSION['conectado'];
				$resultConsulta = $conn->query($consulta);

				if($resultConsulta->num_rows != 0){	
			?>
			<table class="w3-table w3-striped w3-border w3-margin-bottom">
			    <tr>
			      <th>C&oacute;digo</th>
			      <th>Nome</th>
			      <th>a&ccedil;&otilde;es</th>
			    </tr>
			<?php
				while ($row = $resultConsulta->fetch_array()) {
			?>
				<tr>
			      <td><?php echo $row["task_id"]; ?></td>
			      <td><?php echo $row["task_name"]; ?></td>
			      <td>						
						<a class="w3-btn w3-teal" onclick="document.getElementById('view<?php echo $row["task_id"]; ?>').style.display='block'" title="Ver"><i class="fa fa-eye"></i></a> 
						<a href="arquivos/<?php echo $row['task_attach']; ?>" target="_blank" title="Download" class="w3-btn w3-blue"><span class="fa fa-download"></span></a>
                        <a href="?Dados=edit-task&amp;&amp;id=<?php echo $row['task_id']; ?>" class="w3-btn w3-green" title="Editar"><i class="fa fa-pencil"></i></a>  
                        <a class="w3-btn w3-red" onclick="document.getElementById('delete<?php echo $row["task_id"]; ?>').style.display='block'" title="excluir"><i class="fa fa-close"></i></a>
			      </td>
			    </tr>
			<?php			
					}
			?>
			</table>
			<?php
				}else{		
			?>
			<h3 class="w3-center w3-text-red">N&atilde;o h&aacute; tarefas no momento.</h3>
			<?php
				}
			?>    			   
		  	
		</div>
	</main>	
	<footer>
		<?php include "footer.php"; ?>
	</footer>
</section>

<!--begin modal view-->
<?php  
	$view = "SELECT * FROM tasks where user_id = ".$_SESSION['conectado'];
	$resultView = $conn->query($view);
	while ($rowView = $resultView->fetch_array()) {
?>
<div id="view<?php echo $rowView["task_id"]; ?>" class="w3-modal">
	<div class="w3-modal-content">
		<div class="w3-container w3-blue">
            <span onclick="document.getElementById('view<?php echo $rowView["task_id"]; ?>').style.display='none'" class="w3-button w3-display-topright w3-hover-red">&times;</span>
            <h3>Tarefa</h3>
        </div>
		<div class="w3-container">           
            <table class="w3-table w3-striped">
                <tr>
                    <td><span class="azul-dae">C&oacute;digo: </span></td>
                    <td><?php echo $rowView["task_id"]; ?></td>
                </tr> 
                <tr>
                    <td><span class="azul-dae">Nome: </span></td>
                    <td><?php echo $rowView["task_name"]; ?></td>
                </tr>       
                <tr>
                    <td><span class="azul-dae">Descri&ccedil;&atilde;o: </span></td>
                    <td><?php echo $rowView["task_desc"]; ?></td>
                </tr>
                                             
            </table>              
         </div>
        <div class="w3-container w3-light-grey w3-right-align">
			<p>Painel view task</p>
        </div>    
	</div>
</div>
<?php } ?>
<!--end modal view-->

<!--begin modal delete-->
<?php  
	$delete = "SELECT * FROM tasks where user_id = ".$_SESSION['conectado'];
	$resultDelete = $conn->query($delete);
	while ($rowDel = $resultDelete->fetch_array()) {
?>
<div id="delete<?php echo $rowDel['task_id']; ?>" class="w3-modal">
	<div class="w3-modal-content">
        <div class="w3-container w3-blue">
            <span onclick="document.getElementById('delete<?php echo $rowDel["task_id"]; ?>').style.display='none'" class="w3-button w3-display-topright w3-hover-red">&times;</span>
		    <h3>Excluir Tarefa</h3>
        </div>  
		<div class="w3-container">           
                <form  class="form" action="index.php" method="post">          	 
                <input type="hidden" name="Dados" value="tasks">
                <input type="hidden" name="delete_attach" value="<?php echo $rowDel['task_attach']; ?>">                 		
                <input type="hidden" name="id" value="<?php echo $rowDel['task_id']; ?>">                 		
                <p>Voc&ecirc; tem certeza que deseja excluir Tarefa?</p>
                <p class="azul-dae"><strong>C&oacute;digo:</strong> <?php echo $rowDel["task_id"]; ?> <br /> <strong>Nome:</strong> <?php echo $rowDel["task_name"]; ?></p>     
                <p><input type="submit" name="btnDelete" class="w3-btn w3-red"  value="Sim Excluir"></p>              
                </form>
         </div>
         <div class="w3-container w3-blue w3-right-align">
            <p>Painel delete task</p>
        </div>   
	</div>
</div>
<?php } ?>
<!--end modal delete-->

