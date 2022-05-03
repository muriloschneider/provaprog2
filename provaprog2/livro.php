<!DOCTYPE html>
<?php 

$procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
   $procura = isset($_POST["procura"]) ? $_POST["procura"] : "";

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    require_once "classe/livro.class.php";
    $title = "livro";
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
<h2 class="text-dark">livros</h2>
</br>
<form method="post">
<h3 ><input type="radio"  name="tipo" id="tipo" value="1" <?php if ($tipo == 1) { echo "checked"; }?>>Preço</h3><br>
    <h3><input  type="radio"  name="tipo" id="tipo" value="2" <?php if ($tipo == 2) { echo "checked"; }?>>Título</h3><br>
  
   <input type="text"   name="procurar" id="procurar"  value="<?php echo $procurar;?>">
    <input type="submit" class="btn btn-dark"  value="Consultar">
</form>
<br>

<table class="table table-dark table-striped">
    <tr><th>ID</th>
        <th>Título</th> 
        <th>Ano de publicação</th>
        <th>Isdn</th>
        <th>preço</th>
         

    </tr>

<?php
$pdo = Conexao::getInstance();
    
    if($procura==""){
        $consulta = $pdo->query("SELECT * FROM livro 
                                 WHERE l_preco LIKE '$procurar%' 
                                 ORDER BY l_preco");
}

else if($procura=="pro2"){
    $consulta = $pdo->query("SELECT * FROM livro 
                             WHERE l_titulo LIKE '$procurar%' 
                             ORDER BY l_titulo");
}

else if($procura=="pro1"){
    $consulta = $pdo->query("SELECT * FROM livro 
                             WHERE l_preco = '$procurar%' 
                             ORDER BY l_preco");
}




    
while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
    ?>

    <tr><td><?php echo $linha['l_idLivro'];?></td>
    <td><?php echo $linha['l_titulo'];?></td>
    <td><?php echo $linha['l_ano_publicacao'];?></td>
    <td><?php echo $linha['l_isdn'];?></td>
    <td><?php echo $linha['l_preco'];?></td>
    <td><a href='livro.php?livro.class.php=editar&idlivro=<?php echo $linha['l_idLivro'];?>'>editar</a></td>
    <td><a href="javascript:excluirRegistro('livro.php?acao_livro.php=excluir&idlivro=<?php echo $linha['l_idLivro'];?>')">xxxx</a></td>
</tr>

<?php } ?>
</table>    

<br><br><br><br>

<a href="venda.php" > venda </a><br><br>
<a href="item_venda.php"> item venda </a><br><br>
<a href="cliente.php" > cliente </a><br><br>
<a href="autor.php" > autor </a><br><br>
</body>
</html>



