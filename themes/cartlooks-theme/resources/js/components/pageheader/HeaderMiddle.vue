<template>
  <!-- Header Top -->
  <div
    class="custom-header-mid header-top py-4 c1-bg"
    @scroll="scrollHandler"
    ref="fooHeader"
  >
    <div class="custom-container2">
      <div class="row align-items-center">
        <div class="col-lg-3" v-if="!this.isSticky">
          <template v-if="mode == 'dark'">
            <the-logo
              :header-logo-style="headerLogoStyle"
              :logo="siteProperties.logo_dark"
              :title="siteProperties.site_name"
              v-if="siteProperties.logo_dark"
            />
            <h2 class="site-title" v-else>
              <a href="/">{{ siteProperties.site_name }}</a>
            </h2>
          </template>
          <template v-else>
            <the-logo
              :header-logo-style="headerLogoStyle"
              :logo="siteProperties.logo"
              :title="siteProperties.site_name"
              v-if="siteProperties.logo"
            />
            <h2 class="site-title" v-else>
              <a href="/">{{ siteProperties.site_name }}</a>
            </h2>
          </template>
        </div>
        <div class="col-lg-3" v-else>
          <template v-if="mode == 'dark'">
            <div v-if="siteProperties.sticky_black_logo">
              <the-logo
                :header-logo-style="headerLogoStyle"
                :logo="siteProperties.sticky_black_logo"
                :title="siteProperties.site_name"
              />
            </div>
            <div v-else>
              <h2 class="site-title">
                <a href="/">{{ siteProperties.site_name }}</a>
              </h2>
            </div>
          </template>
          <template v-else>
            <div v-if="siteProperties.sticky_logo">
              <the-logo
                :header-logo-style="headerLogoStyle"
                :logo="siteProperties.sticky_logo"
                :title="siteProperties.site_name"
              />
            </div>
            <div v-else>
              <h2 class="site-title">
                <a href="/">{{ siteProperties.site_name }}</a>
              </h2>
            </div>
          </template>
        </div>
        <div class="col-lg-6 position-relative">
          <!-- Search Form -->
          <search-form
            @search-suggestions="getSearchProducts"
            rounded
            style-two
          />
          <!-- End Search Form -->
          <div
            class="search-suggestion box-shadow bg-white"
            ref="searchSuggestion"
            v-if="suggestionsOpen"
          >
            <div
              v-if="
                tag_suggestions.length ||
                category_suggestions ||
                products_suggestions
              "
            >
              <!--Tags suggestions List-->
              <div v-if="tag_suggestions.length">
                <div
                  class="px-2 py-1 text-uppercase fs-10 text-right text-muted bg-soft-secondary"
                >
                  {{ $t("Popular Suggestions") }}
                </div>
                <ul class="list-unstyled mb-0">
                  <li
                    class="d-block text-left suggestion_list"
                    v-for="(tag, index) in tag_suggestions"
                    :key="index"
                  >
                    <router-link :to="`/product/search?tag=${tag.permalink}`">{{
                      tag.name
                    }}</router-link>
                  </li>
                </ul>
              </div>
              <!--End Tags suggestion List--->

              <!--Categories suggestions List-->
              <div v-if="category_suggestions">
                <div
                  class="px-2 py-1 text-uppercase fs-10 text-right text-muted bg-soft-secondary"
                >
                  {{ $t("Category Suggestions") }}
                </div>
                <ul class="list-unstyled mb-0">
                  <li
                    class="d-block text-left suggestion_list"
                    v-for="(category, index) in category_suggestions"
                    :key="index"
                  >
                    <router-link :to="`/products/category/${category.slug}`">{{
                      category.name
                    }}</router-link>
                  </li>
                </ul>
              </div>
              <!--End Categories suggestion List--->
              <div v-if="products_suggestions">
                <div
                  class="px-2 py-1 text-uppercase fs-10 text-right text-muted bg-soft-secondary"
                >
                  {{ $t("Products Suggestions") }}
                </div>
                <!--Product List-->
                <ul class="list-unstyled mb-0">
                  <li
                    class="d-block text-left suggestion_list"
                    v-for="(product, index) in products_suggestions"
                    :key="index"
                  >
                    <single-product :item="product" small />
                  </li>
                </ul>
                <!--End Product List--->
              </div>
            </div>

            <div class="p-3 text-center mt-1" v-else>
              {{ $t("Sorry, nothing found for") }}
              <strong>{{ search_key }}</strong>
            </div>
          </div>
        </div>

        <div class="col-lg-3">
          <div class="d-flex align-items-center justify-content-end">
            <!-- Top bar Buttons -->
            <ul
              class="top-bar-buttons header-middle list-inline mb-0 align-items-center"
            >
              <li v-if="enable_product_compare == 1">
                <router-link to="/compare" class="pr-3">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="18"
                    viewBox="0 0 18 12"
                    class="svg replaced-svg"
                  >
                    <path
                      id="Path_29515"
                      data-name="Path 29515"
                      d="M8.309,13.616H2.9a.955.955,0,0,0,0,1.907H8.309V17.23a.443.443,0,0,0,.765.334l2.5-2.661a.511.511,0,0,0,0-.677l-2.5-2.661a.445.445,0,0,0-.765.334Zm5.382-2.108V9.8H19.1a.955.955,0,0,0,0-1.907H13.691V6.187a.443.443,0,0,0-.765-.334l-2.5,2.661a.511.511,0,0,0,0,.677l2.5,2.661A.447.447,0,0,0,13.691,11.508Z"
                      transform="translate(-2 -5.708)"
                      fill="#141414"
                    ></path>
                  </svg>
                  <span class="count" v-if="compareItem > 0">
                    {{ compareItem }}
                  </span>
                </router-link>
              </li>

              <li>
                <router-link to="/dashboard/wishlist" class="pr-3">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    viewBox="0 0 16 16"
                    class="svg replaced-svg"
                  >
                    <path
                      id="wishlist"
                      d="M1731.994,46a.633.633,0,0,1-.47-.223l-6.2-7.033a5.613,5.613,0,0,1-.007-7.241,4.161,4.161,0,0,1,6.409.007l.276.313.269-.306a4.163,4.163,0,0,1,6.409,0,5.628,5.628,0,0,1-.006,7.244l-6.211,7.023A.632.632,0,0,1,1731.994,46Zm-3.475-14.517a2.991,2.991,0,0,0-2.255,1.062,4.01,4.01,0,0,0,0,5.164l5.728,6.5,5.741-6.49a4.02,4.02,0,0,0,0-5.168,2.933,2.933,0,0,0-4.521,0l-.739.839a.614.614,0,0,1-.944,0l-.746-.846A3,3,0,0,0,1728.519,31.481Z"
                      transform="translate(-1723.999 -29.999)"
                      fill="#333"
                    ></path>
                  </svg>
                  <span class="count" v-if="wishlistItem">
                    {{ wishlistItem }}
                  </span>
                </router-link>
              </li>
              <li>
                <router-link to="/cart" class="pr-3">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 20 20"
                    class="svg replaced-svg"
                    style=""
                  >
                    <path
                      id="Cart"
                      d="M1783.345,37.526h-3.636l-4.545-6.364c-.343-.493-.326-.909-.909-.909h0a2.618,2.618,0,0,0-1.818.909l-4.546,6.364h-2.727a.9.9,0,0,0-.909.909h0a12.409,12.409,0,0,0,2.727,8.182,9.091,9.091,0,0,0,14.545,0,12.412,12.412,0,0,0,2.727-8.182h0A.9.9,0,0,0,1783.345,37.526Zm-9.091-5.455c.021-.029-.009.006,0,0s-.021-.029,0,0l3.636,5.455h-8.182Zm0,16.364c-4.317,0-7.922-4.229-8.182-9.091h16.364C1782.176,44.206,1778.572,48.435,1774.254,48.435Z"
                      transform="translate(-1764.254 -30.253)"
                      fill="#333"
                    ></path>
                  </svg>
                  <span class="count" v-if="cartItem > 0">
                    {{ cartItem }}
                  </span>
                </router-link>
              </li>
            </ul>
            <!-- End Top bar Buttons -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Header Top -->
</template>
<script>
import { mapState } from "vuex";
import SearchForm from "@/components/ui/SearchForm.vue";
import SingleProduct from "../product/SingleProduct.vue";
import axios from "axios";
export default {
  name: "HeaderMiddle",
  components: {
    SearchForm,
    SingleProduct,
  },
  props: {
    siteProperties: {
      type: Object,
      required: false,
    },
    mode: {
      type: String,
      required: false,
    },
    cartItem: {
      type: Number,
      required: false,
      default: 0,
    },
    wishlistItem: {
      type: Number,
      required: false,
      default: 0,
    },
    compareItem: {
      type: Number,
      required: false,
      default: 0,
    },
    headerLogoStyle: {
      type: Object,
      required: false,
      default: () => {
        return {};
      },
    },
  },
  data() {
    return {
      loading: false,
      search_key: "",
      suggestionsOpen: false,
      products_suggestions: [],
      category_suggestions: [],
      tag_suggestions: [],
      active: 1,
      isSticky: false,
    };
  },
  computed: mapState({
    enable_product_compare: (state) =>
      state.siteSettings != null
        ? state.siteSettings.enable_product_compare
        : 0,
  }),
  mounted() {
    window.addEventListener("scroll", this.scrollHandler);
    document.addEventListener("click", this.close);
    if (this.suggestionsOpen) {
      window.addEventListener("click", (e) => {
        if (!this.$el.contains(e.target)) {
          this.suggestionsOpen = false;
        }
      });
    }
  },
  methods: {
    /**
     * Will close dropdown area
     *
     * @param {*} e
     */
    close(e) {
      let el1 = this.$refs.searchSuggestion;
      let target = e.target;
      if (el1 !== target && !el1?.contains(target)) {
        this.suggestionsOpen = false;
      }
    },
    /**
     * Get suggestions products
     *
     */
    getSearchProducts(search_key) {
      this.search_key = search_key;
      this.loading = true;
      if (search_key) {
        axios
          .post("/api/v1/ecommerce-core/search-suggestions", {
            search_key: search_key,
          })
          .then((response) => {
            this.loading = false;
            if (response.data.success) {
              this.suggestionsOpen = true;
              this.category_suggestions = response.data.categories.data;
              this.products_suggestions = response.data.products.data;
              this.tag_suggestions = response.data.tags;
            }
          })
          .catch((error) => {});
      } else {
        this.suggestionsOpen = false;
      }
    },
    scrollHandler() {
      const fooHeader = this.$refs.fooHeader;
      if (window.pageYOffset > 100) {
        this.isSticky = true;
        fooHeader.classList.add("sticky", "fadeInDowns");
      } else {
        this.isSticky = false;
        fooHeader.classList.remove("sticky", "fadeInDowns");
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.search-suggestion {
  z-index: 9;
  position: absolute;
  top: 99%;
  width: 90%;
  left: 50%;
  max-height: 500px;
  min-height: 100px;
  overflow-y: scroll;
  overflow-x: hidden;
  transform: translateX(-50%);
  border-radius: 0px;
  scrollbar-width: none !important;
  box-shadow: 0 10px 15px -3px rgb(0 0 0 / 10%), 0 4px 6px -2px rgb(0 0 0 / 5%) !important;
}
.search-suggestion::-webkit-scrollbar {
  display: none;
}
.color-gray {
  color: #0a0e33b8;
}
.font-weight-custom {
  font-weight: 600;
}
.suggestion_list {
  padding: 10px 5px;
}
.suggestion_list:not(:last-child) {
  border-bottom: 1px solid rgba(51, 51, 51, 0.1);
}
.suggestion_list:hover {
  background-color: #dcdcdc36;
}
.bg-soft-secondary {
  background-color: rgb(238 240 242) !important;
}
.fs-10 {
  font-size: 0.625rem !important;
}
.text-muted {
  color: #6c757d !important;
}
.site-title a {
  color: #fff;
}
</style>