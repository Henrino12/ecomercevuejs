<template>
  <!-- Logo -->
  <a href="/" class="logo text-white">
    <img
      v-if="logo"
      :src="logo"
      :alt="title"
      :class="this.headerLogoStyle.custom_header_logo == 1 ? 'custom-logo' : ''"
    />
    <template v-else>
      {{ title.toUpperCase() }}
    </template>
  </a>
  <!-- End Logo -->
</template>

<script>
export default {
  name: "TheLogo",
  props: {
    logo: {
      type: String,
      default: "",
    },
    title: {
      type: String,
      default: "",
    },
    headerLogoStyle: {
      type: Object,
      required: false,
      default: () => {
        return {};
      },
    },
  },
};
</script>
