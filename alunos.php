<?php
session_start();

if (!isset($_SESSION['loggedin'])){
  header('Location: index.php');	
}

require("sidemenu.php");

require_once('connection.php');

$mysql_query = "SELECT a.*, t.curso FROM aluno a 
                INNER JOIN turma t ON a.turma_codigo = t.codigo 
                ORDER BY a.codigo";

$result = $conn->query($mysql_query);
mysqli_close($conn);
?> 
<div class="container p-3">
  <h2>Alunos</h2>
  <p>Listagem de alunos cadastrados.</p>
  <hr>
  <div class="float-right p-1">
    <a href="insert-aluno.php"><button type="button" class="btn btn-dark mb-3">Adicionar Aluno</button></a>
  </div>
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr class="table-dark" style="text-align:center">
        <th scope="col" style="width: 5%;">Código</th>
        <th scope="col">Nome</th>
        <th scope="col" style="width: 20%;">CPF</th>
        <th scope="col" style="width: 15%;">Data Nascimento</th>
        <th scope="col" style="width: 25%;">Turma</th>
        <th scope="col" style="width: 20%;">Ação</th>
      </tr>
    </thead>
    <tbody>
      <?php while($data = mysqli_fetch_array($result)) { ?> 
      <tr> 
        <th scope="row" style="text-align:center"><?php echo $data['codigo']; ?></th>
        <td style="text-align:center"><?php echo $data['nome']; ?></td> 
        <td style="text-align:center"><?php echo $data['cpf']; ?></td> 
        <td style="text-align:center"><?php echo date('d/m/Y', strtotime($data['data_nasc'])); ?></td>
        <td style="text-align:center"><?php echo $data['curso']; ?></td> 
        <td style="text-align:center">
          <a href="update-contato.php?id=<?php echo $data['codigo']; ?>">
            <button type="button" class="btn btn-dark">Editar</button></a>
          <a href="delete-contato.php?id=<?php echo $data['codigo']; ?>">
            <button type="button" class="btn btn-danger">Excluir</button></a>
        </td> 
      </tr> 
      <?php } ?>       
    </tbody>
  </table>
</div>

