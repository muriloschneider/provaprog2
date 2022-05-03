<!DOCTYPE html>
<?php 

$procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
   $procura = isset($_POST["procura"]) ? $_POST["procura"] : "";

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    $title = "venda";
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
<h2 class="text-dark">vendas</h2>
</br>
<form method="post">
<h3 class="input text-dark"><input type="radio"  name="tipo" id="tipo" value="1" <?php if ($tipo == 1) { echo "checked"; }?>>Preço</h3><br>
    <h3 class="input text-dark"><input type="radio"  name="tipo" id="tipo" value="2" <?php if ($tipo == 2) { echo "checked"; }?>>Título</h3><br>
  
   <input type="text"   name="procurar" id="procurar"  value="<?php echo $procurar;?>">
    <input type="submit" class="btn btn-dark"  value="Consultar">
</form>
<br>

<table >
    <tr><th>ID Livro</th>
        <th>Título</th> 
        <th>quantidade</th>
        <th>Valor unitario</th>
        <th>valor total</th>
         

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
else if($procura=="pro3"){
    $consulta = $pdo->query("SELECT * FROM item_venda UNION venda UNION livro 
                             WHERE iv_quantidade = '$procurar%' 
                             ORDER BY iv_quantidade");
}


    
while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
    ?>

    <tr><td><?php echo $linha['l_idLivro'];?></td>
    <td><?php echo $linha['l_titulo'];?></td>
    <td><?php  echo $linha['iv_quantidade'];?></td>
    <td><?php echo $linha['l_preco'];?></td>
    <td><?php echo $linha['v_preco_total_venda'];?></td>
    <td><a href='marca2.php?acao2=editar&id=<?php echo $linha['id'];?>'>editar</a></td>
    <td><a href="javascript:excluirRegistro('acao2.php?acao2=excluir&id=<?php echo $linha['id'];?>')">xxxx</a></td>
</tr>

<?php } ?>
</table>   

<a href="livro.php" > livro </a><br><br>
<a href="item_venda.php"> item venda </a><br><br>
<a href="cliente.php" > cliente </a><br><br>
<a href="autor.php" > autor </a><br><br>

</body>
</html>



