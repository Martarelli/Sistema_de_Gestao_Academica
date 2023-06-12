<?php

session_start();

if (!isset($_SESSION['loggedin'])){
  header('Location: index.php');	
}

require("sidemenu.php");
require_once('connection.php');



if($_SESSION["id"] === "1"){
    $mysql_query = "SELECT * FROM usuario ORDER BY codigo";
  $result = $conn->query($mysql_query);
?>

<div class="container p-3">
  <h2>Seja bem vindo <?php echo "<span>".strtoupper($_SESSION["username"])."</span>"?></h2>
  <hr>
  <div class="float-right p-1">
    <a href="insert-user.php"><button type="button" class="btn btn-dark mb-3">Adicionar Usuário</button></a>
  </div>
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr class="table-dark" style="text-align:center">
        <th scope="col" style="width: 10%;">Código</th>
        <th scope="col">Nome</th>
        <th scope="col" style="width: 15%;">Data Criação</th>
        <th scope="col" style="width: 15%;">Data Atualização</th>
        <th scope="col" style="width: 20%;">Ação</th>
      </tr>
    </thead>
    <tbody>
      <?php while($data = mysqli_fetch_array($result)) { ?> 
      <tr> 
        <th scope="row" style="text-align:center"><?php echo $data['codigo']; ?></th>
        <td style="text-align:center"><?php echo $data['username']; ?></td> 
        <td style="text-align:center"><?php echo date('d/m/Y H:i', strtotime($data['created_at'])); ?></td> 
        <td style="text-align:center"><?php echo date('d/m/Y H:i', strtotime($data['updated_at'])); ?></td> 
        <td style="text-align:center">
          <a href="update-user.php?codigo=<?php echo $data['codigo']; ?>">
            <button type="button" class="btn btn-dark">Editar</button></a>
          <a href="delete-user.php?codigo=<?php echo $data['codigo']; ?>">
            <button type="button" class="btn btn-danger">Excluir</button></a>
        </td> 
      </tr> 
      <?php } ?>       
    </tbody>
  </table>
</div>

<?php
} else { 
  $mysql_query = "SELECT * FROM usuario WHERE codigo='{$_SESSION['id']}'";
  $result = $conn->query($mysql_query);
  $data = mysqli_fetch_array($result)
  ?>

<div class="container p-3">
  <h2>Seja bem vindo <?php echo "<span>".strtoupper($_SESSION["username"])."</span>"?></h2>
  <hr>
  <p>Usuário cadastrado em: <?php echo date('d/m/Y', strtotime($data['created_at']))?></p> 
    
    
    <a href="update-user.php?codigo=<?php echo $data['codigo']; ?>">
      <button type="button" class="btn btn-dark">Alterar senha</button></a>       
</div>


<?php } 
mysqli_close($conn);
?>