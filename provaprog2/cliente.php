<!DOCTYPE html>
<?php 

$procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
   $procura = isset($_POST["procura"]) ? $_POST["procura"] : "";

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    require_once "classe/cliente.class.php";
    $title = "cliente";
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : "2";
    $procurar = isset($_POST['procurar']) ? $_POST['procurar'] : "";
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    
    <script>
        function excluirRegistro(url){
            if (confirm("Confirma Exclusão?"))
                location.href = url;
        }
    </script>
</head>
<body>

<br>
<h2 class="text-dark">clientes</h2>
</br>
<form method="post">
<h3 ><input type="radio"  name="tipo" id="tipo" value="1" <?php if ($tipo == 1) { echo "checked"; }?>>id</h3><br>
    <h3><input  type="radio"  name="tipo" id="tipo" value="2" <?php if ($tipo == 2) { echo "checked"; }?>>nome</h3><br>
  
   <input type="text"   name="procurar" id="procurar"  value="<?php echo $procurar;?>">
    <input type="submit" class="btn btn-dark"  value="Consultar">
</form>
<br>

<table class="table table-dark table-striped">
    <tr><th>ID</th>
        <th>Nome</th> 
        <th>CPF</th>
        <th>data de nascimento</th>
         

    </tr>

<?php
$pdo = Conexao::getInstance();
    
    if($procura==""){
        $consulta = $pdo->query("SELECT * FROM cliente 
                                 WHERE c_idCliente LIKE '$procurar%' 
                                 ORDER BY c_idCliente");
}

else if($procura=="pro2"){
    $consulta = $pdo->query("SELECT * FROM cliente 
                             WHERE c_nome LIKE '$procurar%' 
                             ORDER BY c_nome");
}

else if($procura=="pro1"){
    $consulta = $pdo->query("SELECT * FROM cliente 
                             WHERE c_idCliente = '$procurar%' 
                             ORDER BY c_idCliente");
}




    
while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
    ?>

    <tr><td><?php echo $linha['c_idCliente'];?></td>
    <td><?php echo $linha['c_nome'];?></td>
    <td><?php echo $linha['c_cpf'];?></td>
    <td><?php echo $linha['c_dt_nascimento'];?></td>
    <td><a href='livro.php?acao_cliente.php=editar&c_idcliente=<?php echo $linha['c_idCliente'];?>'>editar</a></td>
    <td><a href="javascript:excluirRegistro('cliente.php?acao_cliente.php=excluir&c_idCliente=<?php echo $linha['c_idCliente'];?>')">xxxx</a></td>
</tr>

<?php } ?>
</table>    

<br><br><br><br>

<a href="venda.php" > venda </a> <br>
<a href="item_venda.php"> item venda </a><br>
<a href="livro.php" > livro </a><br>
<a href="autor.php" > autor </a><br>
</body>
</html>



