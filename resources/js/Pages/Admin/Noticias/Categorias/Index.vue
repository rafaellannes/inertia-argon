<template>
  <admin-layout>
    <template v-slot:breadcrumb>
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm">
          <a class="opacity-5 text-white" href="javascript:;">Admin</a>
        </li>
        <li class="breadcrumb-item text-sm text-white" aria-current="page">
          Noticias
        </li>

        <li class="breadcrumb-item text-sm text-white" aria-current="page">
          Categorias
        </li>
      </ol>
    </template>

    <template v-slot:header>
      <h5 class="font-weight-bolder text-white mt-4 mb-0">Categorias</h5>
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
                        Descrição
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
                    <tr v-for="(cat, index) in categorias.data" :key="index">
                      <td>
                        <div class="px-4 py-1">
                          <div class="justify-content-center">
                            <h6 class="mb-0 text-sm">{{ cat.id }}</h6>
                            <!--        <p class="text-xs text-secondary mb-0">
                              john@creative-tim.com
                            </p> -->
                          </div>
                        </div>
                      </td>

                      <td>
                        <div class="px-4 py-1">
                          <div class="justify-content-center">
                            <h6 class="mb-0 text-sm">{{ cat.descricao }}</h6>
                            <!--        <p class="text-xs text-secondary mb-0">
                              john@creative-tim.com
                            </p> -->
                          </div>
                        </div>
                      </td>

                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{
                          cat.created_at
                        }}</span>
                      </td>
                      <td class="align-middle">
                        <a
                          href="javascript:;"
                          class="text-secondary font-weight-bold text-xs"
                          data-toggle="tooltip"
                          data-original-title="Edit"
                          @click.prevent="edit(cat)"
                        >
                          Editar </a
                        >|
                        <a
                          href="javascript:;"
                          class="text-secondary font-weight-bold text-xs"
                          @click="deleteModal(cat)"
                        >
                          Remover
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer">
              <pagination :links="categorias.links"></pagination>
            </div>
          </div>
        </div>
      </div>
    </template>
  </admin-layout>

  <!-- Modal -->
  <div
    class="modal fade"
    id="modalCategoria"
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
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label"
                    >Descrição</label
                  >
                  <input
                    v-model="form.descricao"
                    class="form-control"
                    type="text"
                    onfocus="focused(this)"
                    onfocusout="defocused(this)"
                    :class="{ 'is-invalid': form.errors.descricao }"
                  />
                </div>
                <div
                  class="invalid-feedback mb-3"
                  :class="{ 'd-block': form.errors.descricao }"
                >
                  {{ form.errors.descricao }}
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="closeModal">
              Fechar
            </button>
            <button type="submit" class="btn btn-success">
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
  props: ["categorias"],
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
        descricao: "",
      }),
    };
  },
  computed: {
    formTitle() {
      return this.editMode === false
        ? "Adicionar Categoria"
        : "Editar Categoria";
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
      this.form.post(this.route("admin.noticias-categoria.store"), {
        preserveScroll: true,
        onSuccess: () => {
          this.closeModal();
          this.form.reset();
        },
      });
    },

    edit(pref) {
      this.openModal();
      this.editMode = true;
      this.form = Object.assign(this.form, pref);
    },

    update() {
      this.form.patch(
        this.route("admin.noticias-categoria.update", this.form.id, this.form),
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
        route("admin.noticias-categoria.index"),
        {
          filter: this.filter,
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
          this.form.delete(
            this.route("admin.noticias-categoria.destroy", pref),
            {
              preserveScroll: true,
              onSuccess: () => {
                Swal.fire("Deletado!", "Prefeitura deletada", "success");
              },
            }
          );
        }
      });
    },
  },

  mounted() {
    this.modal = new bootstrap.Modal(
      document.getElementById("modalCategoria"),
      {}
    );
  },
};
</script>

