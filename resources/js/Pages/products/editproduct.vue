<template>
    <div class="card">
        <div class="card-header bg-primary text-light">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="m-0">Edit Product</h3>
                <router-link to="/" class="btn btn-outline-light">Back</router-link>
            </div>
        </div>
        <div class="card-body">
            <form action="">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control"
                        v-model="product.name"
                    />
                </div>
                <div class="form-group">
                    <label for="arabic_name">Arabic name:</label>
                    <input
                        type="text"
                        name="arabic_name"
                        id="arabic_name"
                        v-model="product.arabic_name"
                        class="form-control"
                    />
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input
                        type="number"
                        name="price"
                        id="price"
                        v-model="product.price"
                        class="form-control"
                    />
                </div>
                <div class="form-group">
                    <label for="stock">Stock:</label>
                    <input
                        type="number"
                        name="stock"
                        id="stock"
                        v-model="product.stock"
                        class="form-control"
                    />
                </div>
                <button
                    type="button"
                    class="btn btn-primary mt-2"
                    v-on:click="updateProduct()"
                >
                    Save
                </button>
            </form>
        </div>
    </div>
</template>

<script>
import axios from "../../config/axios.js";
import toastr from "toastr";

export default {
    name: "EditPostPage",
    data() {
        return {
            product: {}, // Initial state
        };
    },
    mounted() {
        this.getProduct(this.$route.params.id);
    },
    methods: {
        async updateProduct() {
            try {
                let res = await axios.post(
                    "/api/products/update",
                    this.product
                );
                toastr.success("Post updated Successfully");
                this.$router.push('/');
            } catch (error) {
                let errors = error.response.data.errors;
                for (let key in errors) {
                    toastr.error(errors[key]);
                }
            }
        },
        async getProduct(id) {
            let res = await axios.get(`/api/products/get/${id}`);
            this.product = res.data.product;
        },
    },
};
</script>
