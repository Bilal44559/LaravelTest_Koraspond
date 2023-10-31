<template>
    <div class="card">
        <div class="card-header bg-primary text-light">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="m-0">Products</h3>

            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover rounded">
                <thead>
                    <tr>
                        <th class="bg-primary text-light">#</th>
                        <th class="bg-primary text-light">Name</th>
                        <th class="bg-primary text-light">Arabic Name</th>
                        <th class="bg-primary text-light">Price</th>
                        <th class="bg-primary text-light">Stock</th>
                        <th class="bg-primary text-light">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="products.length <= 0">
                        <td colspan="6" align="center">
                            <h4>No Data Found !</h4>
                        </td>
                    </tr>
                    <tr v-for="(product, key) in products" v-bind:key="key">
                        <td>{{ key + 1 }}</td>
                        <td>{{ product.name }}</td>
                        <td>{{ product.arabic_name }}</td>
                        <td>{{ product.price }}</td>
                        <td>{{ product.stock }}</td>
                        <td>
                            <router-link
                                :to="{
                                    name: 'EditProduct',
                                    params: { id: product.id },
                                }"
                                class="btn btn-light"
                                ><i class="fa-solid fa-pen-to-square"></i></router-link
                            >
                            <button
                                type="button"
                                class="btn btn-danger ms-2"
                                v-on:click="deleteProduct(product.id)"
                            >
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import axios from "../../config/axios.js";
import toastr from "toastr";
export default {
    name: "ProductsList",
    data() {
        return {
            products: [], // Initial state
        };
    },
    mounted() {
        this.getProducts();
    },
    methods: {
        async getProducts() {
            let res = await axios.get("/api/products");
            this.products = res.data.product;
        },
        async deleteProduct(id) {
            if(!confirm('Are you sure you want to delete this product?'))
                return false;
            let res = await axios.get(`/api/products/delete/${id}`);
            toastr.success(res.data.message);
            this.getProducts();
        },
    },
};
</script>
