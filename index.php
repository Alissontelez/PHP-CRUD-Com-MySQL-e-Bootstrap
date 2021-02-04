<html>
    <head>
        <title>PHP CRUD</title>
        <script scr="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    </head>
    <body>      
        <?php require_once 'process.php'; ?>
        
        <?php if (isset($_SESSION['message'])): ?>       
        <div class="alert alert-<?=$_SESSION['msg_type']?>">
        
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
        </div>
        <?php endif ?>
        
        <div class="container">
        <?php 
            $mysqli = mysqli_connect('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
            $record = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
            ?>
            
        <div class=" row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Localização</th>
                        <th colspan="2">Ação</th>
                    </tr>
                </thead>
                <?php while ($row = $record->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id']; ?>"
                           class="btn btn-info">Editar</a>
                        <a href="process.php?delete=<?php echo $row['id']; ?>"
                           class="btn btn-danger">Deletar</a>
                    </td>
                </tr>
                <?php endwhile;?>
            </table>
        </div>
        <?php    

        ?>
        
        <div class="row justify-content-center">
        <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
            <label>Nome</label>
            <input type="text" name="name" class="form-control"
                   value="<?php echo $name ?>" placeholder="Insira seu nome">
            </div>
            <div class="form-group">
            <label>Localização</label>
            <input type="text" name="location" class="form-control" 
                   value="<?php echo $location ?>" placeholder="Insira sua localização">
            </div>
            <div class="form-group">
            <?php if ($edit_state == false): ?>
                <button type="submit" class="btn btn-primary" name="save">Salvar</button>
            <?php else: ?>               
                <button type="submit" class="btn btn-primary" name="update">Atualizar</button>
            <?php endif; ?>
            </div>
        </form>
        </div>
        </div>
    </body>
</html>