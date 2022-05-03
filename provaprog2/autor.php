<!DOCTYPE html>
<?php 

$procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
   $procura = isset($_POST["procura"]) ? $_POST["procura"] : "";

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    require_once "classe/autor.class.php";
    $title = "autor";
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
<h2 class="text-dark">autor</h2>
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
        <th>Sobrenome</th>
         

    </tr>

<?php
$pdo = Conexao::getInstance();
    
    if($procura==""){
        $consulta = $pdo->query("SELECT * FROM autor 
                                 WHERE a_idAutor LIKE '$procurar%' 
                                 ORDER BY a_idAutor");
}

else if($procura=="pro2"){
    $consulta = $pdo->query("SELECT * FROM autor 
                             WHERE a_nome LIKE '$procurar%' 
                             ORDER BY a_nome");
}

else if($procura=="pro1"){
    $consulta = $pdo->query("SELECT * FROM autor 
                             WHERE a_idAutor = '$procurar%' 
                             ORDER BY a_idAutor");
}




    
while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
    ?>

    <tr><td><?php echo $linha['a_idAutor'];?></td>
    <td><?php echo $linha['a_nome'];?></td>
    <td><?php echo $linha['a_sobrenome'];?></td>
    <td><a href='autor.php?acao_autor.php=editar&a_idAutor=<?php echo $linha['a_idAutor'];?>'>editar</a></td>
    <td><a href="javascript:excluirRegistro('autor.php?acao_autor.php=excluir&a_idAutor=<?php echo $linha['a_idAutor'];?>')">xxxx</a></td>
</tr>

<?php } ?>
</table>    

<br><br><br><br>

<a href="venda.php" > venda </a> <br>
<a href="item_venda.php"> item venda </a><br>
<a href="livro.php" > livro </a><br>
<a href="cliente.php" > cliente </a><br>
</body>
</html>



