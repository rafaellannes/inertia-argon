<style>
.multiselect__content-wrapper {
  position: relative;
}

.character-option-icon {
  margin: 0 6px 0 0;
  height: 22px;
}

.character-label-icon {
  margin: 0 6px 0 0;
  height: 26px;
}

.map_holder {
  width: 100%;
  height: 450px;
}

.fa-minus-circle {
  color: #e74c3c;
  cursor: pointer;
}
.fa-plus-circle {
  color: #27c24c;
  cursor: pointer;
}

.redes {
  display: inline-block;
  width: calc(100% - 45px);
}
</style>
<template>
  <admin-layout>
    <template v-slot:breadcrumb>
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm">
          <a class="opacity-5 text-white" href="javascript:;">Admin</a>
        </li>
        <li class="breadcrumb-item text-sm text-white" aria-current="page">
          Serviços
        </li>
      </ol>
    </template>

    <template v-slot:header>
      <h5 class="font-weight-bolder text-white mt-4 mb-0">Serviços</h5>
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
                        Titulo
                      </th>

                      <th
                        class="
                          text-uppercase text-secondary text-xxs
                          font-weight-bolder
                          opacity-7
                        "
                      >
                        Subcategoria
                      </th>

                      <th
                        class="
                          text-uppercase text-secondary text-xxs
                          font-weight-bolder
                          opacity-7
                        "
                      >
                        Endereço
                      </th>

                      <th
                        class="
                          text-uppercase text-secondary text-xxs
                          font-weight-bolder
                          opacity-7
                        "
                      >
                        Lojista
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
                    <tr v-for="(servico, index) in servicos.data" :key="index">
                      <td>
                        <div class="px-4 py-1">
                          <div class="justify-content-center">
                            <h6 class="mb-0 text-sm">{{ servico.id }}</h6>
                            <!--        <p class="text-xs text-secondary mb-0">
                              john@creative-tim.com
                            </p> -->
                          </div>
                        </div>
                      </td>

                      <td>
                        <div class="px-4 py-1">
                          <div class="justify-content-center">
                            <h6 class="mb-0 text-sm">
                              {{ servico.titulo }}
                            </h6>
                            <!--        <p class="text-xs text-secondary mb-0">
                              john@creative-tim.com
                            </p> -->
                          </div>
                        </div>
                      </td>

                      <td>
                        <div class="px-4 py-1">
                          <div class="justify-content-center">
                            <h6 class="mb-0 text-sm">
                              {{ servico.subcategoria.descricao }}
                            </h6>
                            <!--        <p class="text-xs text-secondary mb-0">
                              john@creative-tim.com
                            </p> -->
                          </div>
                        </div>
                      </td>

                      <td>
                        <div class="px-4 py-1">
                          <div class="justify-content-center">
                            <h6 class="mb-0 text-sm">
                              {{ servico.endereco }}
                            </h6>
                            <!--        <p class="text-xs text-secondary mb-0">
                              john@creative-tim.com
                            </p> -->
                          </div>
                        </div>
                      </td>

                      <td class="align-middle text-center">
                        <Link
                          :href="
                            route('admin.servico.lojistas.index', {
                              uuid: servico.uuid,
                            })
                          "
                        >
                          <i
                            style="cursor: pointer"
                            class="fas fa-user-plus text-primary"
                          ></i>
                        </Link>
                      </td>

                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{
                          servico.created_at
                        }}</span>
                      </td>
                      <td class="align-middle">
                        <a
                          href="javascript:;"
                          class="text-secondary font-weight-bold text-xs"
                          data-toggle="tooltip"
                          data-original-title="Edit"
                          @click.prevent="edit(servico)"
                        >
                          Editar </a
                        >|
                        <a
                          href="javascript:;"
                          class="text-secondary font-weight-bold text-xs"
                          @click="deleteModal(servico)"
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
              <pagination :links="servicos.links"></pagination>
            </div>
          </div>
        </div>
      </div>
    </template>
  </admin-layout>

  <!-- Modal -->
  <div
    class="modal fade"
    id="modalServico"
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
                    >Título</label
                  >
                  <input
                    v-model="form.titulo"
                    class="form-control"
                    type="text"
                    onfocus="focused(this)"
                    onfocusout="defocused(this)"
                    :class="{ 'is-invalid': form.errors.titulo }"
                  />
                </div>
                <div
                  class="invalid-feedback mb-3"
                  :class="{ 'd-block': form.errors.titulo }"
                >
                  {{ form.errors.titulo }}
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label"
                    >Contato</label
                  >
                  <input
                    v-model="form.contato"
                    class="form-control"
                    type="text"
                    onfocus="focused(this)"
                    onfocusout="defocused(this)"
                    :class="{ 'is-invalid': form.errors.contato }"
                  />
                </div>
                <div
                  class="invalid-feedback mb-3"
                  :class="{ 'd-block': form.errors.contato }"
                >
                  {{ form.errors.contato }}
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label"
                    >Subcategoria</label
                  >
                  <select
                    id="subcategoria_id"
                    v-model="form.subcategoria_id"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.subcategoria_id }"
                  >
                    <option
                      v-for="(cat, index) in subcategorias"
                      :key="index"
                      :value="cat.id"
                    >
                      {{ cat.descricao }}
                    </option>
                  </select>
                </div>
                <div
                  class="invalid-feedback mb-3"
                  :class="{ 'd-block': form.errors.subcategoria_id }"
                >
                  {{ form.errors.subcategoria_id }}
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label"
                    >Tags</label
                  >

                  <multiselect
                    v-model="form.tags"
                    placeholder="Selecione as tags do serviço"
                    label="descricao"
                    :option-height="104"
                    :options="options"
                    :multiple="true"
                    :close-on-select="false"
                    :clear-on-select="false"
                    :preserve-search="true"
                    track-by="descricao"
                    :preselect-first="false"
                  >
                    <template v-slot:singlelabel="{ value }">
                      <div class="multiselect-single-label">
                        <img
                          class="character-label-icon"
                          :src="value.icone.link_img"
                        />
                        {{ value.descricao }}
                      </div>
                    </template>

                    <template v-slot:option="{ option }">
                      <img
                        class="character-option-icon"
                        :src="option.icone.link_img"
                      />
                      {{ option.descricao }}
                    </template>
                  </multiselect>
                </div>
                <div
                  class="invalid-feedback mb-3"
                  :class="{ 'd-block': form.errors.tags }"
                >
                  {{ form.errors.tags }}
                </div>
              </div>

              <div class="col-md-12">
                <div class="map_holder">
                  <place-search
                    v-bind:ready="ready"
                    placeholder="Digite o endereço"
                    loading="Map is loading"
                    v-bind:gps_timeout="7000"
                    v-bind:fallbackProcedure="fallbackProcedure"
                    v-bind:zoom="zoom"
                    v-bind:geolocation="geolocation"
                    v-bind:address="address"
                    v-bind:manually="manually"
                    @changed="getMapData"
                  >
                  </place-search>
                </div>
              </div>
              <div
                class="invalid-feedback mb-3"
                :class="{ 'd-block': form.errors.endereco }"
              >
                {{ form.errors.endereco }}
              </div>
              <hr class="mt-3" />
              <div class="col-md-12">
                <label for="example-text-input" class="h5"
                  >Mídias Sociais</label
                >

                <div
                  class="form-group"
                  v-for="(input, k) in form.redes"
                  :key="k"
                >
                  <div class="row">
                    <div class="col-4">
                      <label for="example-text-input" class="form-control-label"
                        >Mídia Social</label
                      >
                      <select
                        v-model="input.rede_id"
                        class="form-control"
                        :class="{
                          'is-invalid': form.errors[`redes.${k}.rede_id`],
                        }"
                      >
                        <option
                          v-for="(rede, index) in redes"
                          :key="index"
                          :value="rede.id"
                        >
                          {{ rede.descricao }}
                        </option>
                      </select>
                      <div
                        class="invalid-feedback mb-3"
                        :class="{
                          'd-block': form.errors[`redes.${k}.rede_id`],
                        }"
                      >
                        {{ form.errors[`redes.${k}.rede_id`] }}
                      </div>
                    </div>
                    <div class="col-5">
                      <label for="example-text-input" class="form-control-label"
                        >Link</label
                      >
                      <input
                        type="text"
                        class="form-control"
                        v-model="input.link"
                        :class="{
                          'is-invalid': form.errors[`redes.${k}.link`],
                        }"
                      />

                      <div
                        class="invalid-feedback mb-3"
                        :class="{
                          'd-block': form.errors[`redes.${k}.link`],
                        }"
                      >
                        {{ form.errors[`redes.${k}.link`] }}
                      </div>
                    </div>

                    <div class="col-3 mt-4 pt-3">
                      <span>
                        <i
                          class="fas fa-minus-circle"
                          @click="remove(k)"
                          v-show="k || (!k && form.redes.length > 1)"
                        ></i>
                        <i
                          class="mx-1 fas fa-plus-circle"
                          @click="add(k)"
                          v-show="k == form.redes.length - 1"
                        ></i>
                      </span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label"
                    >Descrição</label
                  >
                  <textarea
                    v-model="form.descricao"
                    class="form-control"
                    onfocus="focused(this)"
                    onfocusout="defocused(this)"
                    :class="{ 'is-invalid': form.errors.descricao }"
                    rows="4"
                  >
                  </textarea>
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
import { Link } from "@inertiajs/inertia-vue3";

export default {
  props: ["servicos", "subcategorias", "tags", "redes"],
  components: {
    AdminLayout,
    Pagination,
    Link,
  },

  data() {
    return {
      modal: Object,

      options: this.tags,
      filter: "",
      editMode: false,
      form: this.$inertia.form({
        id: "",
        titulo: "",
        contato: "",
        descricao: "",
        subcategoria_id: "",
        tags: "",
        latitude: "",
        longitude: "",
        endereco: "",
        redes: [{}],
      }),

      ready: true, //Add ready:false to stop map from loading, and then when changed to true map will auto load
      fallbackProcedure: "address", //gps | geolocation | address | manually
      zoom: 10, //Default Zoom
      geolocation: {
        // If GPS and Find by address fails then, map will be positioned by a default geolocation
        lat: 31.73858,
        lng: -35.98628,
        zoom: 2,
      },
      address: {
        query: "Brazil", //If GPS fails, Find by address is triggered
        zoom: 5,
      },
      manually: {
        address_description: "",
        city: "",
        country: "",
        lat: -22.9597,
        lng: -44.0411,
        state: "",
        zip_code: "",
        zoom: 13,
      },
      place: {},
      form_data: {},
    };
  },
  computed: {
    formTitle() {
      return this.editMode === false ? "Adicionar Serviço" : "Editar Serviço";
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
      this.form.post(this.route("admin.servicos.store"), {
        preserveScroll: true,
        onSuccess: () => {
          this.closeModal();
          this.form.reset();
        },
      });
    },

    edit(servico) {
      this.form.reset();
      this.openModal();
      this.editMode = true;

      this.form = Object.assign(this.form, servico);

      let redes = servico.redes.map((item) => {
        return item.pivot;
      });

      this.form.redes = redes;
    },

    update() {
      this.form.patch(
        this.route("admin.servicos.update", this.form.id, this.form),
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
        route("admin.servicos.index"),
        {
          filter: this.filter,
        },
        { preserveState: true }
      );
    },

    deleteModal(servico) {
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
          this.form.delete(this.route("admin.servicos.destroy", servico), {
            preserveScroll: true,
            onSuccess: () => {
              Swal.fire("Deletado!", "Serviço deletado", "success");
            },
          });
        }
      });
    },

    getMapData(place) {
      this.place = place;
      /*  console.log(place); */
      this.form.latitude = place.lat;
      this.form.longitude = place.lng;
      this.form.endereco = place.address_description;
      /*      console.log(place.address_description);
      console.log(place.lat);
      console.log(place.lng); */
    },
    triggerReady() {
      this.fallbackProcedure = "manually";
      this.ready = true;
    },

    add(k) {
      this.form.redes.push({
        rede_id: "",
        link: "",
      });
    },

    remove(k) {
      this.form.redes.splice(k, 1);
    },
  },
  created() {},
  mounted() {
    this.modal = new bootstrap.Modal(
      document.getElementById("modalServico"),
      {}
    );
  },
};
</script>

