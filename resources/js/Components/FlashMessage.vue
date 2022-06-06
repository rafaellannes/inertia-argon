<template>
  <div
    v-if="showAlert && $page.props.flash"
    class="
      alert alert-dismissible
      fade
      position-absolute
      show
      top-0
      end-0
      mt-3
      me-5
      col-6
    "
    :class="{
      'alert-success': $page.props.flash.success,
      'alert-danger': $page.props.flash.danger,
      'alert-info': $page.props.flash.info,
      'alert-warning': $page.props.flash.warning,
    }"
    role="alert"
  >
    <div v-if="$page.props.flash.success" id="success">
      <span class="alert-icon text-white"><i class="ni ni-like-2"></i> </span>
      <span class="alert-text text-white">{{ $page.props.flash.success }}</span>
    </div>

    <div v-if="$page.props.flash.danger" id="danger">
      <span class="alert-icon text-white"><i class="ni ni-like-2"></i> </span>
      <span class="alert-text text-white">{{ $page.props.flash.danger }}</span>
    </div>

    <div v-if="$page.props.flash.info" id="info">
      <span class="alert-icon text-white"><i class="ni ni-like-2"></i> </span>
      <span class="alert-text text-white">{{ $page.props.flash.info }}</span>
    </div>

    <div v-if="$page.props.flash.warning" id="warning">
      <span class="alert-icon text-white"><i class="ni ni-like-2"></i> </span>
      <span class="alert-text text-white">{{ $page.props.flash.warning }}</span>
    </div>

    <button
      type="button"
      class="btn-close"
      data-bs-dismiss="alert"
      aria-label="Close"
    >
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
</template>
<script>
export default {
  data() {
    return {
      showAlert: false,
    };
  },

  methods: {
    controlAlert() {
      this.showAlert = true;
      setTimeout(() => (this.showAlert = false), 2000);
    },
  },
  mounted() {
    this.controlAlert();
  },
  watch: {
    "$page.props.flash.success": {
      handler() {
        this.controlAlert();
      },
      deep: true,
    },

    "$page.props.flash.danger": {
      handler() {
        this.controlAlert();
      },
      deep: true,
    },

    "$page.props.flash.info": {
      handler() {
        this.controlAlert();
      },
      deep: true,
    },
    "$page.props.flash.warning": {
      handler() {
        this.controlAlert();
      },
      deep: true,
    },
  },
};
</script>
