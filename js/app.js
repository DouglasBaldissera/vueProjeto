var app = new Vue({
    el: "#app",
    data: {
        name: "",
        email: "",
        records: [],
        edit_id: "",
        edit_name: "",
        edit_email: "",
        senha: ""
    },
 
    methods: {
        showModal(id) {
            this.$refs[id].show();
        },
        hideModal(id) {
            this.$refs[id].hide();
        },
 
        onSubmit() {            
            if (this.senha.length < 6) {
                alert("Senha precisa ter 6 caracteres ou mais");
                return;
            }

            var fd = new FormData();
            fd.append("email", this.email);
            fd.append("senha", this.senha);
 
                axios({
                    url: "insert.php",
                    method: "post",
                    data: fd,
                })
                    .then((res) => {
                        if (res.data.res == "success") {
                            app.makeToast("Success", "Record Added", "default");
 
                            this.name = "";
                            this.email = "";
 
                            app.hideModal("my-modal");
                            app.getRecords();
                        } else {
                            app.makeToast("Error", "Failed to add record. Please try again", "default");
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            return;
            
            
            if (this.name !== "" && this.email !== "") {
                var fd = new FormData();
 
                fd.append("name", this.name);
                fd.append("email", this.email);
 
                axios({
                    url: "insert.php",
                    method: "post",
                    data: fd,
                })
                    .then((res) => {
                        if (res.data.res == "success") {
                            app.makeToast("Success", "Record Added", "default");
 
                            this.name = "";
                            this.email = "";
 
                            app.hideModal("my-modal");
                            app.getRecords();
                        } else {
                            app.makeToast("Error", "Failed to add record. Please try again", "default");
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            } else {
                alert("All field are required");
            }
        },
 
        getRecords() {
            axios({
                url: "records.php",
                method: "get",
            })
                .then((res) => {
                    this.records = res.data.rows;
                    console.log("record: ", this.records);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
 
        // DELETEEEEEEEEE
        deleteRecord(id) {
            // Crie uma função que teste se a palavra é um palíndromo e retorne true ou false.
            // Não é permitido usar método array.reverse.
            // Exemplos de palíndromo: Anilina, Arara, Esse, Reviver
            // Tempo máximo de teste: 30 min
            // let palavra = "Anilina";
            let palavra = "Anilina";
            palavra = palavra.toLowerCase();

            let resultado = palavra.split("");

            let stringFormada = '';
            for (let i = resultado.length - 1; i >= 0; i--) {
                stringFormada = stringFormada + resultado[i];
            }
            if (palavra === stringFormada) {
                console.log("A palavra é um palíndromo");
            } else {
                console.log("A palavra não é um palíndromo");
            }
            return;

            if (window.confirm("Delete this record")) {
                var fd = new FormData();
 
                fd.append("id", id);
 
                axios({
                    url: "delete.php",
                    method: "post",
                    data: fd,
                })
                    .then((res) => {
                        if (res.data.res == "success") {
                            app.makeToast("Success", "Record delete successfully", "default");
                            app.getRecords();
                        } else {
                            app.makeToast("Error", "Failed to delete record. Please try again", "default");
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            }
        },
 
        // EDITARRRRRRRRRRRRRRR
        editRecord(id) {
            var fd = new FormData();
 
            fd.append("id", id);
 
            axios({
                url: "edit.php",
                method: "post",
                data: fd,
            })
                .then((res) => {
                    if (res.data.res == "success") {
                        this.edit_id = res.data.row[0];
                        this.edit_name = res.data.row[1];
                        this.edit_email = res.data.row[2];
                        app.showModal("my-modal1");
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },
 
        onUpdate() {
            if (
                this.edit_name !== "" &&
                this.edit_email !== "" &&
                this.edit_id !== ""
            ) {
                var fd = new FormData();
 
                fd.append("id", this.edit_id);
                fd.append("name", this.edit_name);
                fd.append("email", this.edit_email);
 
                axios({
                    url: "update.php",
                    method: "post",
                    data: fd,
                })
                    .then((res) => {
                        if (res.data.res == "success") {
                            app.makeToast("Sucess", "Record update successfully", "default");
 
                            this.edit_name = "";
                            this.edit_email = "";
                            this.edit_id = "";
 
                            app.hideModal("my-modal1");
                            app.getRecords();
                        }
                    })
                    .catch((err) => {
                        app.makeToast("Error", "Failed to update record", "default");
                    });
            } else {
                alert("All field are required");
            }
        },
 
        makeToast(vNodesTitle, vNodesMsg, variant) {
            this.$bvToast.toast([vNodesMsg], {
                title: [vNodesTitle],
                variant: variant,
                autoHideDelay: 1000,
                solid: true,
            });
        },
    },
 
    mounted: function () {
        this.getRecords();
    },
});