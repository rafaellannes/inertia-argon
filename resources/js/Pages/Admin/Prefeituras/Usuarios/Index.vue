<template>
  <admin-layout>
    <template v-slot:breadcrumb>
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm">
          <a class="opacity-5 text-white" href="javascript:;">Admin</a>
        </li>
        <li class="breadcrumb-item text-sm text-white" aria-current="page">
          Prefeituras
        </li>

        <li
          class="breadcrumb-item text-sm text-white active"
          aria-current="page"
        >
          Usuários / {{ prefeitura.descricao }}
        </li>
      </ol>
    </template>

    <template v-slot:header>
      <h5 class="font-weight-bolder text-white mt-4 mb-0">
        Usuários - {{ prefeitura.descricao }}
      </h5>
    </template>

    <template #content>
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-8">
                  <button class="btn btn-primary" @click="openModal()">
                    Novo <i class="fas fa-plus"></i>
                  </button>
                </div>

                <div class="col-4">
                  <div class="input-group">
                    <input
                      v-model="filter"
                      @keyup="search"
                      type="text"
                      class="form-control"
                      placeholder="Pesquisar"
                    />
                    <span class="input-group-text text-body"
                      ><i
                        @click="search"
                        class="fas fa-search"
                        style="cursor: pointer"
                        aria-hidden="true"
                      ></i
                    ></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th
                        class="
                          text-uppercase text-secondary text-xxs
                          font-weight-bolder
                          opacity-7
                        "
                      >
                        #
                      </th>
                      <th
                        class="
                          text-uppercase text-secondary text-xxs
                          font-weight-bolder
                          opacity-7
                        "
                      >
                        Nome
                      </th>
                      <th
                        class="
                          text-uppercase text-secondary text-xxs
                          font-weight-bolder
                          opacity-7
                          ps-2
                        "
                      >
                        E-mail
                      </th>

                      <th
                        class="
                          text-center text-uppercase text-secondary text-xxs
                          font-weight-bolder
                          opacity-7
                        "
                      >
                        Data de criação
                      </th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                        <tr v-for="(user, index) in users.data" :key="index">
                      <td>
                        <div class="px-4 py-1">
                          <div class="justify-content-center">
                            <h6 class="mb-0 text-sm">{{ user.id }}</h6>

                          </div>
                        </div>
                      </td>

                      <td>
                        <div class="px-4 py-1">
                          <div class="justify-content-center">
                            <h6 class="mb-0 text-sm">{{ user.name }}</h6>

                          </div>
                        </div>
                      </td>

                            <td>
                        <div class="px-4 py-1">
                          <div class="justify-content-center">
                            <h6 class="mb-0 text-sm">{{ user.email }}</h6>

                          </div>
                        </div>
                      </td>


                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{
                          user.created_at
                        }}</span>
                      </td>
                      <td class="align-middle">
                        <a
                          href="javascript:;"
                          class="text-secondary font-weight-bold text-xs"
                          data-toggle="tooltip"
                          data-original-title="Edit user"
                          @click.prevent="edit(user)"
                        >
                          Editar </a
                        ><!-- |
                        <a
                          href="javascript:;"
                          class="text-secondary font-weight-bold text-xs"
                          @click="deleteModal(user)"
                        >
                          Remover
                        </a> -->
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer">
              <pagination :links="users.links"></pagination>
            </div>
          </div>
        </div>
      </div>
    </template>
  </admin-layout>

  <!-- Modal -->
  <div
    class="modal fade"
    id="modalPrefeitura"
    tabindex="-1"
    aria-labelledby="modalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <form @submit.prevent="checkMode">
          <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">{{ formTitle }}</h5>
            <span
              style="cursor: pointer"
              @click="closeModal"
              aria-label="Close"
              aria-hidden="true"
              >×</span
            >
          </div>
          <div class="modal-body">
            <div class="col-md-12">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label"
                  >Nome</label
                >
                <input
                  v-model="form.name"
                  class="form-control"
                  type="text"
                  onfocus="focused(this)"
                  onfocusout="defocused(this)"
                  :class="{ 'is-invalid': form.errors.name }"
                />
              </div>
              <div
                class="invalid-feedback mb-3"
                :class="{ 'd-block': form.errors.name }"
              >
                {{ form.errors.name }}
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label"
                  >E-mail</label
                >
                <input
                  v-model="form.email"
                  class="form-control"
                  type="email"
                  onfocus="focused(this)"
                  onfocusout="defocused(this)"
                  :class="{ 'is-invalid': form.errors.email }"
                />
              </div>
              <div
                class="invalid-feedback mb-3"
                :class="{ 'd-block': form.errors.email }"
              >
                {{ form.errors.email }}
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label"
                  >Senha</label
                >
                <input
                  v-model="form.password"
                  class="form-control"
                  type="password"
                  onfocus="focused(this)"
                  onfocusout="defocused(this)"
                  :class="{ 'is-invalid': form.errors.password }"
                />
              </div>
              <div
                class="invalid-feedback mb-3"
                :class="{ 'd-block': form.errors.password }"
              >
                {{ form.errors.password }}
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label"
                  >Confirmar Senha</label
                >
                <input
                  v-model="form.checkPassword"
                  class="form-control"
                  type="password"
                  onfocus="focused(this)"
                  onfocusout="defocused(this)"
                  :class="{ 'is-invalid': form.errors.checkPassword }"
                />
              </div>
              <div
                class="invalid-feedback mb-3"
                :class="{ 'd-block': form.errors.checkPassword }"
              >
                {{ form.errors.checkPassword }}
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="closeModal">
              Fechar
            </button>
            <button v-if="form.password === form.checkPassword" type="submit" class="btn btn-success">
              {{ buttonTxt }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import Pagination from "@/Components/Pagination";

export default {
  props: ["prefeitura", "users"],
  components: {
    AdminLayout,
    Pagination,
  },

  data() {
    return {
      modal: Object,

      filter: "",
      editMode: false,
      form: this.$inertia.form({
        id: "",
        name: "",
        email: "",
        password: null,
        checkPassword: null,
        uuid: this.prefeitura.uuid,
      }),
    };
  },
  computed: {
    formTitle() {
      return this.editMode === false ? "Adicionar Usuário" : "Editar Usuário";
    },
    buttonTxt() {
      return this.editMode === false ? "Salvar" : "Editar";
    },
    checkMode() {
      return this.editMode === false ? this.create : this.update;
    },
  },

  methods: {
    openModal() {
      this.editMode = false;
      this.form.clearErrors();
      this.modal.show();
      this.form.reset();
    },

    closeModal() {
      this.modal.hide();
      this.form.clearErrors();
      this.editMode = false;
    },

    create() {
      this.form.post(this.route("admin.prefeitura.usuarios.store"), {
        preserveScroll: true,
        onSuccess: () => {
          this.closeModal();
          this.form.reset();
        },
      });
    },

    edit(user) {
      this.openModal();
      this.editMode = true;
      this.form = Object.assign(this.form, user);
    },

    update() {
      this.form.patch(
        this.route("admin.prefeitura.usuarios.update", this.form.id, this.form),
        {
          preserveScroll: true,
          onSuccess: () => {
            this.closeModal();
            this.form.reset();
          },
        }
      );
    },

    search() {
      this.$inertia.get(
        route("admin.prefeitura.usuarios.index"),
        {
          filter: this.filter,
          uuid: this.form.uuid,
        },
        { preserveState: true }
      );
    },

    deleteModal(pref) {
      Swal.fire({
        title: "Tem certeza que deseja deletar?",
        text: "Você não será capaz de reverter essa ação!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim, deletar!",
      }).then((result) => {
        if (result.isConfirmed) {
          this.form.delete(this.route("admin.prefeituras.destroy", pref), {
            preserveScroll: true,
            onSuccess: () => {
              Swal.fire("Deletado!", "Prefeitura deletada", "success");
            },
          });
        }
      });
    },
  },

  mounted() {
    this.modal = new bootstrap.Modal(
      document.getElementById("modalPrefeitura"),
      {}
    );
  },
};
</script>

