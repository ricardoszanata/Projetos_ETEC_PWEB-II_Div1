<?php
require '../controle/conexao.php';
$pdo = Conexao::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $id = filter_input(INPUT_GET, 'id');
    $sql = "select * from categorias where catid = ?;";
    $prp = $pdo->prepare($sql);
    $prp->execute([$id]);
    $ds = $prp->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $categoria = strtoupper(filter_input(INPUT_POST, 'edtcategoria'));
    $sql = "update categorias set catnome = ? where catid = ?;";
    $prp = $pdo->prepare($sql);
    $prp->execute([$categoria,$id]);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Alteração de Categorias</title>
</head>

<body>
    <div class="container mt-3">
        <form action="" method="post">
            <div class="form-group">
                <label for="edtid">Identificação</label>
                <input type="text" name="edtid" id="edtid" class="form-control" readonly value="<?php echo $ds['catid'];?>">
            </div>
            <div class="form-group">
                <label for="edtcategoria">Categoria</label>
                <input type="text" name="edtcategoria" id="edtcategoria" class="form-control" required value="<?php echo $ds['catnome'];?>">
            </div>
            <button type="submit" class="btn btn-outline-primary mt-3">Gravar</button>
        </form>
    </div>
</body>

</html>