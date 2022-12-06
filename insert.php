<?php 
    

    if (isset($_POST['senha']) && isset($_POST['email'])) {
        $name = $_POST['email'];
        $senha = $_POST['senha'];

        include 'model.php';
 
        $model = new Model();
        $rows = $model->findAll();
        $data = array('rows' => $rows);

        $teste = $data['rows'];

        $usuarioEncontrado = false;
        for ($i = 1; $i < sizeof($teste); $i++) {
            if ($name == $teste[$i]['email']) {
                $usuarioEncontrado = true;
            } 
        }
        $senhaEncontrada = false;
        if ($usuarioEncontrado) {
            $senha = md5($senha);
            for ($i = 1; $i < sizeof($teste); $i++) {
                if ($senha == $teste[$i]['senha']) {
                    $senhaEncontrada = true;
                } 
            }
        }
        if ($senhaEncontrada) {
            echo"achou";
        } else {
            echo"nao achou";
        }
        return;
        


        include 'model.php';
 
        $model = new Model();
 
        if ($model->store($name, $email)) {
            $data = array('res' => 'success');
        }else{
            $data = array('res' => 'error');
        }
 
        echo json_encode($data);
    }