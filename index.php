<!-- Faça um endpoint utilizando boas práticas e REST que valide login e senha retornando se o usuário logou ou não e devolvendo essa resposta. 
Em caso de o usuário mandar um formato inválido de e-mail no login, o endpoint deve retornar o erro.
Em caso de o usuário mandar uma senha com menos de 6 caracteres, o sistema não precisa nem bater no banco e já pode devolver um aviso de login inválido.
Bônus: Caso ainda haja tempo, retorne um token de validação que tmb poderá ser utilizado para consultar outro endpoint que só retorne conteúdo (Qualquer) caso o token seja válido. Pode utilizar um cliente de chamadas de api como insomnia, postman ou similar, para testar. -->


<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link type="text/css" rel="stylesheet" href="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css" />
<title>Project VUE</title>
<style>
[v-cloak] {
    display: none;
}
</style>
</head>
<body class="bg-light">
    <div class="container" id="app" v-cloak>
        <div class="row">
            <div class="col-md-10"><h3>Vuejs PHP OOP PDO Mysql CRUD (Create, Read, Update and Delete)</h3>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex d-flex justify-content-between">
                            <div class="lead">PHP PDO VUEJS CRUD</div>
                            <button id="show-btn" @click="showModal('my-modal')" class="btn btn-primary">Add Records</button>
                        </div>
                    </div>
                    <!-- AA: {{records}} -->
                    <div class="card-body">
                        <div class="text-muted lead text-center" v-if="!records.length">No record found</div>
                        <div class="table table-success table-striped" v-if="records.length">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(record, i) in records" :key="record.id">
                                        <td>{{i + 1}}</td>
                                        <td>{{record.name}}</td>
                                        <td>{{record.email}}</td>
                                        <td>
                                            <a href="#" @click.prevent="deleteRecord(record.id)" class="btn btn-danger">Delete</a>
                                            <a href="#" @click.prevent="editRecord(record.id)" class="btn btn-primary">Edit</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
 
                <!-- Add Records Modal -->
                <b-modal ref="my-modal" hide-footer title="Add Records">
                    <form action="" @submit.prevent="onSubmit">
                        <!-- <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" v-model="name" class="form-control">
                        </div> -->
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" v-model="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="">Senha</label>
                            <input type="password" v-model="senha" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-sm btn-outline-info">Add Records</button>
                        </div>
                    </form>
                    <b-button class="mt-3" variant="outline-danger" block @click="hideModal('my-modal')">Close Me</b-button>
                </b-modal>
                         
                <!-- Update Record Modal -->
                <div>
                    <b-modal ref="my-modal1" hide-footer title="Update Record">
                        <div>
                            <form action="" @submit.prevent="onUpdate">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" v-model="edit_name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" v-model="edit_email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-sm btn-outline-info">Update Record</button>
                                </div>
                            </form>
                        </div>
                        <b-button class="mt-3" variant="outline-danger" block @click="hideModal('my-modal1')">Close Me</b-button>
                    </b-modal>
                </div>
            </div>
        </div>
 
    </div>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<!-- BootstrapVue js -->
<script src="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js"></script>
<!-- Axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="js/app.js"></script>
</body>
</html>