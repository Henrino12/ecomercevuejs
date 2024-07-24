<template>
  <!-- Categories -->
  <section class="category-section home-page-section">
    <div class="category-wrapper style--two">
      <!-- Category Trigger -->
      <div
        class="category-trigger d-flex align-items-center"
        data-toggle="collapse"
        data-target="cat_drop"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="22"
          height="16.004"
          viewBox="0 0 22 16.004"
          class="svg replaced-svg"
        >
          <g id="list-icon" transform="translate(0 -7.434)">
            <path
              id="Path_21225"
              data-name="Path 21225"
              d="M29.23,48.019H14.983a1.063,1.063,0,1,1,0-2.126H29.229a1.063,1.063,0,0,1,0,2.126Z"
              transform="translate(-8.292 -24.864)"
              fill="#1e202c"
            ></path>
            <path
              id="Path_21226"
              data-name="Path 21226"
              d="M29.23,29.188H14.983a1.063,1.063,0,1,1,0-2.126H29.229a1.063,1.063,0,0,1,0,2.126Z"
              transform="translate(-8.292 -12.689)"
              fill="#1e202c"
            ></path>
            <path
              id="Path_21227"
              data-name="Path 21227"
              d="M29.23,10.357H14.983a1.063,1.063,0,0,1,0-2.126H29.229a1.063,1.063,0,0,1,0,2.126Z"
              transform="translate(-8.292 -0.515)"
              fill="#1e202c"
            ></path>
            <circle
              id="Ellipse_56"
              data-name="Ellipse 56"
              cx="1.428"
              cy="1.428"
              r="1.428"
              transform="translate(0 7.434)"
              fill="#1e202c"
            ></circle>
            <circle
              id="Ellipse_57"
              data-name="Ellipse 57"
              cx="1.428"
              cy="1.428"
              r="1.428"
              transform="translate(0 14.008)"
              fill="#1e202c"
            ></circle>
            <circle
              id="Ellipse_58"
              data-name="Ellipse 58"
              cx="1.428"
              cy="1.428"
              r="1.428"
              transform="translate(0 20.582)"
              fill="#1e202c"
            ></circle>
          </g>
        </svg>
        <router-link to="/categories">
          {{ properties.category_list_header_text_t_ }}
        </router-link>
      </div>
      <!-- End Category Trigger -->
      <div class="category-list-wrap">
        <ul
          class="category-list"
          v-for="(cat, index) in properties.category_list"
          :key="index"
        >
          <li>
            <router-link :to="`/products/category/${cat.slug}`">
              <img :src="`${cat.icon}`" :alt="cat.name" class="cat-icon" />
              <span>
                {{ cat.name }}
              </span>
            </router-link>
          </li>
        </ul>
      </div>
    </div>
  </section>
  <!-- End Categories -->
</template>

<script>
export default {
  name: "CategoryList",
  props: {
    properties: {
      type: Object,
      default: {},
    },
  },
};
</script>

<style lang="scss" scoped>
.category-wrapper {
  position: relative;
}
.category-wrapper.style--two .category-trigger {
  font-weight: 600;
  min-width: 160px;
  padding: 10px 10px;
  line-height: 1px;
  -webkit-box-shadow: 15px 20px 30px rgba(0, 0, 0, 0.03);
  box-shadow: 15px 20px 30px rgba(0, 0, 0, 0.03);
  background-color: #ffffff;
  border-radius: 50px;
  height: 50px;
}
.category-wrapper.style--two .category-trigger svg {
  margin-right: 10px;
}
.category-list {
  padding: 0;
  margin: 0;
  list-style: none;
}

.category-list li {
  padding: 16px 0;
  font-weight: 500;
  border-bottom: 1px solid #efefef;
}

.category-list li a {
  margin-left: 16px;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
}

.cat-icon {
  width: 25px;
  height: 25px;
  border-radius: 0px;
  margin-right: 8px;
}
</style>
