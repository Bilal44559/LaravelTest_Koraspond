<template>
<header>
  <!-- Sidebar -->
  <nav
       id="sidebarMenu"
       class="collapse d-lg-block sidebar collapse bg-white"
       >
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-3 mt-4">
            <router-link
                :to="{ name: 'ProductList' }"
                class="list-group-item list-group-item-action py-2 ripple"
                :class="{ active: $route.name === 'ProductList' }"
                >
                <i class="fas fa-tachometer-alt fa-fw me-3"></i>
                Products
            </router-link>
            <router-link
                :to="{ name: 'CreateProduct' }"
                class="list-group-item list-group-item-action py-2 ripple"
                :class="{ active: $route.name === 'CreateProduct' }"
                >
                <i class="fas fa-building fa-fw me-3"></i>
                Create Product
            </router-link>
            <router-link
                :to="{ name: 'CreateOrder'}"
                class="list-group-item list-group-item-action py-2 ripple"
                :class="{ active: $route.name === 'CreateOrder' }"
                >
                <i class="fas fa-chart-bar fa-fw me-3"></i>
                Create Order
            </router-link>

      </div>
    </div>
  </nav>
  <!-- Sidebar -->

  <!-- Navbar -->
  <nav
       id="main-navbar"
       class="navbar navbar-expand-lg navbar-light bg-white fixed-top"
       >
    <!-- Container wrapper -->
    <div class="container-fluid">
      <!-- Toggle button -->
      <button
              class="navbar-toggler"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#sidebarMenu"
              aria-controls="sidebarMenu"
              aria-expanded="false"
              aria-label="Toggle navigation"
              >
        <i class="fas fa-bars"></i>
      </button>

      <!-- Brand -->
      <a class="navbar-brand" href="#">
        Laravel Vue Crud
      </a>


    </div>
    <!-- Container wrapper -->
  </nav>
  <!-- Navbar -->
</header>
<!--Main Navigation-->

<!--Main layout-->
<main style="margin-top: 58px">
  <div class="container pt-4">
    <RouterView></RouterView>
  </div>
</main>




</template>

<script>
export default {
    name: "App",
};
</script>
