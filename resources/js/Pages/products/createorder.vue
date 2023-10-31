<template>
    <div class="d-flex align-items-center justify-content-end">
        <button
            type="button"
            class="btn btn-primary mb-3"
            v-on:click="saveOrder()"
        >
            Save Order
        </button>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-primary text-light">
                    <div
                        class="d-flex align-items-center justify-content-between align-items-center"
                    >
                        <h3 class="m-0">Create Order</h3>
                        <router-link to="/" class="btn btn-light"
                            >Back</router-link
                        >
                    </div>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="form-group">
                            <label for="product">Product:</label>
                            <select
                                name="product_id"
                                id="product_id"
                                class="form-control"
                                v-model="item.product_id"
                                v-on:change="getPrice(event)"
                            >
                                <option
                                    v-for="(product, key) in products"
                                    v-bind:key="key"
                                    :value="product.id"
                                >
                                    {{ product.name }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input
                                type="number"
                                name="price"
                                id="price"
                                v-model="item.price"
                                class="form-control"
                            />
                        </div>
                        <div class="form-group">
                            <label for="qty">qty:</label>
                            <input
                                type="number"
                                name="qty"
                                id="qty"
                                v-model="item.qty"
                                class="form-control"
                                v-on:keyup="calculateTotal()"
                                v-on:change="calculateTotal()"
                            />
                        </div>
                        <div class="form-group">
                            <label for="total">Total:</label>
                            <input
                                type="number"
                                name="total"
                                id="total"
                                v-model="item.total"
                                class="form-control"
                            />
                        </div>
                        <button
                            type="button"
                            class="btn btn-primary mt-2"
                            v-on:click="addItem()"
                        >
                            Add To Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div
                    class="card-header bg-primary text-light d-flex align-items-center justify-content-between"
                >
                    <h3 class="m-0">Cart</h3>
                    <p style="font-size: 16px; margin: 0">
                        <strong>Grand Total: </strong>{{ grandTotal }}$
                    </p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div
                            class="col-md-6"
                            v-for="(item, key) in order"
                            v-bind:key="key"
                        >
                            <div class="card">
                                <div
                                    class="card-header bg-primary text-light d-flex justify-content-between align-items-center"
                                >
                                    <h6 class="m-0">{{ item.name }}</h6>
                                    <button
                                        class="btn btn-sm btn-danger"
                                        v-on:click="removeItem(key)"
                                        style="height: 26px; line-height: 17px;"
                                    >
                                        <i class="fa-solid fa-times"></i>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <p>
                                        <strong>Price: </strong>{{ item.price }}
                                    </p>
                                    <p>
                                        <strong>Quantity: </strong
                                        >{{ item.qty }}
                                    </p>
                                    <p>
                                        <strong>Sub Total: </strong
                                        >{{ item.total }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "../../config/axios.js";
import toastr from "toastr";

export default {
    name: "CreateOrderPage",
    data() {
        return {
            order: [], // Initial state
            item: {},
            products: [],
            grandTotal: 0,
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

        getPrice() {
            let productfiltered = this.products.filter(
                (product) => product.id == this.item.product_id
            );
            this.item.price = productfiltered[0].price;
            this.item.name = productfiltered[0].name;
        },
        calculateTotal() {
            this.item.total = this.item.price * this.item.qty;
        },
        addItem() {
            if (
                this.item.price == null ||
                this.item.qty == null ||
                this.item.product_id == null ||
                this.item.total == null
            ) {
                toastr.error("Add all field properly");
                return;
            }
            this.order.push(this.item);
            this.item = {};
            this.grandTotal = this.order.reduce(
                (total, order) => total + order.total,
                0
            );
        },
        removeItem(key) {
            if(!confirm('Are you sure you want to remove this item?'))
                return false
            console.log("remove= ", key);
            this.order.splice(key, 1);
            this.grandTotal = this.order.reduce(
                (total, order) => total + order.total,
                0
            );
        },
        async saveOrder() {
            if (this.order.length < 1) {
                toastr.error("add items to order");
                return;
            }
            let data = { order: this.order, grandTotal: this.grandTotal };
            let res = await axios.post("/api/orders/save", data);
            toastr.success(res.data.message);
            this.order = [];
            this.grandTotal = 0;
        },
    },
};
</script>
