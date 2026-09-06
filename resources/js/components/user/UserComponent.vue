<template>
  <div class="panel panel-inverse">
    <!-- BEGIN panel-heading -->
    <div class="panel-heading">
      <h4 class="panel-title">Lista de Usuarios</h4>
      <div class="panel-heading-btn">
        <a
          href="javascript:;"
          class="btn btn-xs btn-icon btn-default"
          data-toggle="panel-expand"
          ><i class="fa fa-expand"></i
        ></a>
        <a
          href="javascript:;"
          class="btn btn-xs btn-icon btn-success"
          data-toggle="panel-reload"
          ><i class="fa fa-redo"></i
        ></a>
        <a
          href="javascript:;"
          class="btn btn-xs btn-icon btn-warning"
          data-toggle="panel-collapse"
          ><i class="fa fa-minus"></i
        ></a>
        <a
          href="javascript:;"
          class="btn btn-xs btn-icon btn-danger"
          data-toggle="panel-remove"
          ><i class="fa fa-times"></i
        ></a>
      </div>
    </div>
    <!-- END panel-heading -->
    <!-- BEGIN panel-body -->
    <div class="panel-body">
      <ul id="ioniconsTab" class="nav nav-pills mb-3">
        <li class="nav-item">
          <a
            href="usuarios/create"
            class="nav-link active d-flex align-items-center"
          >
            <i class="ion-md-add-circle-outline fa-lg"></i>
            <span class="d-none d-lg-inline ms-2">Agregar</span>&nbsp;
          </a>
        </li>
      </ul>
      <hr class="bg-gray-500" />
      <table
        id="example"
        class="table table-striped table-bordered align-middle"
      >
        <thead>
          <tr>
            <th width="1%">#</th>
            <th width="1%" data-orderable="false"></th>
            <th class="text-nowrap">Nombre</th>
            <th class="text-nowrap">Username</th>
            <th class="text-nowrap">Email</th>
            <th class="text-nowrap">Rol</th>
            <th class="text-nowrap">Estado</th>
            <th class="text-nowrap">Acción</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(user, index) in users">
            <td width="1%">{{ user.id }}</td>
            <td width="1%">
              <img
                v-if="user.photo !== null"
                :src="'/uploads/users/' + user.photo"
                class="rounded h-30px my-n1 mx-n1"
              />
              <img
                v-else
                :src="'/img/sinusuario.jpg'"
                class="rounded h-30px my-n1 mx-n1"
              />
            </td>
            <td>{{ user.firstname + " " + user.lastname }}</td>
            <td>{{ user.username }}</td>
            <td>{{ user.email }}</td>
            <td class="text-center">
              <span class="badge bg-cyan">{{ user.rol_name }}</span>
            </td>
            <td class="text-center">
              <span v-if="user.status" class="badge bg-blue rounded-pill"
                >Activo</span
              >
              <span v-else class="badge bg-lime rounded-pill">Inactivo</span>
            </td>
            <td class="text-center">
              <a
                :href="'usuarios/' + user.id + '/edit'"
                method="GET"
                class="btn btn-outline-red btn-circle btn-xs"
                ><i class="fas fa-edit"></i
              ></a>
              <a
                v-on:click.prevent="deleteUser(index, user.id)"
                class="btn btn-outline-blue btn-circle btn-xs"
              >
                <i class="far fa-trash-alt"></i>
              </a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    this.getUsers();
  },
  data() {
    return {
      users: [],
    };
  },
  methods: {
    mounted() {
      console.log("VIRTAL DOM");
    },
    mytable() {
      $(function () {
        $("#example").DataTable();
      });
    },
    getUsers() {
      var urlUsers = "usuarios/indexData";
      axios.get(urlUsers).then((response) => {
        console.log(response);
        this.users = response.data;
        this.mytable();
      });
    },
    deleteUser(index, id) {
      var urlDeleteUsers = "usuarios/" + id;
      axios.delete(urlDeleteUsers).then((response) => console.log(response));
        


      //this.users.splice(index, 1);>
      //user = this.users[index];
      //var updatedPhone = update(user.id)
      //this.users.splice(index, 1, updatedPhone)

    },
  },
};
</script>
