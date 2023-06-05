<?php
session_start();

if (!isset($_SESSION['loggedin'])){
  header('Location: index.php');	
}

require("sidemenu.php");

  require_once('connection.php');

  $mysql_query = "SELECT d.*, p.nome AS nome_professor, t.codigo AS codigo_turma, t.curso AS curso_turma
                            FROM disciplina d
                            LEFT JOIN professor p ON d.professor_codigo = p.codigo
                            LEFT JOIN turma t ON d.turma_codigo = t.codigo
                            ORDER BY d.codigo";

  $result = $conn -> query($mysql_query);

  mysqli_close($conn);
?> 
<div class="container p-3">
  <h2>Disciplinas</h2>
  <p>Listagem de disciplinas cadastradas.</p>
  <hr>
  <div class="float-right p-1">
    <a href="insert-disciplina.php"><button type="button" class="btn btn-dark mb-3">Adicionar Disciplina</button></a>
  </div>
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr class="table-dark" style="text-align:center">
        <th scope="col" style="width: 5%;">Código</th>
        <th scope="col" style="width: 20%;">Nome</th>
        <th scope="col" style="width: 20%;">Descrição</th>
        <th scope="col" style="width: 20%;">Professor</th>
        <th scope="col" style="width: 20%;">Turma</th>
        <th scope="col" style="width: 20%;">Ação</th>
      </tr>
    </thead>
    <tbody>
      <?php while($data = mysqli_fetch_array($result)) { ?> 
      <tr> 
        <th scope="row" style="text-align:center"><?php echo $data['codigo']; ?></th>
        <td style="text-align:center"><?php echo $data['nome']; ?></td> 
        <td style="text-align:center"><?php echo $data['descricao']; ?></td>
        <td style="text-align:center"><?php echo $data['nome_professor']; ?></td>
        <td style="text-align:center"><?php echo $data['curso_turma']; ?></td>
        <td style="text-align:center">
          <a href="update-disciplina.php?codigo=<?php echo $data['codigo']; ?>">
            <button type="button" class="btn btn-dark">Editar</button></a>
          <a href="delete-disciplina.php?codigo=<?php echo $data['codigo']; ?>">
            <button type="button" class="btn btn-danger">Excluir</button></a>
        </td> 
      </tr> 
      <?php } ?>       
    </tbody>
  </table>
</div>

