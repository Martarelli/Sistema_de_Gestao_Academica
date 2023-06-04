<?php

session_start();

if (!isset($_SESSION['loggedin'])){
  header('Location: index.php');	
}

require("sidemenu.php");

require_once('connection.php');

// Mysql query to select data from table
$mysql_query = "SELECT * FROM turma ORDER BY codigo";
$result = $conn->query($mysql_query);

//Connection Close
mysqli_close($conn);
?> 
<div class="container p-3">
  <h2>Turmas</h2>
  <p>Listagem das turmas cadastradas.</p>
  <hr>
  <div class="float-right p-1">
    <a href="insert-turma.php"><button type="button" class="btn btn-dark mb-3">Adicionar Turma</button></a>
  </div>
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr class="table-dark" style="text-align:center">
        <th scope="col" style="width: 10%;">Código</th>
        <th scope="col">Curso</th>
        <th scope="col" style="width: 15%;">Semestre</th>
        <th scope="col" style="width: 15%;">Periodo</th>
        <th scope="col" style="width: 20%;">Ação</th>
      </tr>
    </thead>
    <tbody>
      <?php while($data = mysqli_fetch_array($result)) { ?> 
      <tr> 
        <th scope="row" style="text-align:center"><?php echo $data['codigo']; ?></th>
        <td style="text-align:center"><?php echo $data['curso']; ?></td> 
        <td style="text-align:center"><?php echo $data['semestre']; ?></td> 
        <td style="text-align:center"><?php echo $data['periodo']; ?></td> 
        <td style="text-align:center">
          <a href="update-turma.php?codigo=<?php echo $data['codigo']; ?>">
            <button type="button" class="btn btn-dark">Editar</button></a>
          <a href="delete-turma.php?codigo=<?php echo $data['codigo']; ?>">
            <button type="button" class="btn btn-danger">Excluir</button></a>
        </td> 
      </tr> 
      <?php } ?>       
    </tbody>
  </table>
</div>