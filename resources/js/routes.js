import ProductList from "./Pages/products/products.vue";
import CreateProduct from "./Pages/products/createproduct.vue";
import EditProduct from "./Pages/products/editproduct.vue";
import CreateOrder from "./Pages/products/createorder.vue";
export const routes = [
    {
        path: "/",
        name: "ProductList",
        component: ProductList,
    },
    {
        path: "/create-product",
        name: "CreateProduct",
        component: CreateProduct,
    },
    {
        path: "/edit-product/:id",
        name: "EditProduct",
        component: EditProduct,
    },
    {
        path: "/create-order",
        name: "CreateOrder",
        component: CreateOrder,
    },
];
