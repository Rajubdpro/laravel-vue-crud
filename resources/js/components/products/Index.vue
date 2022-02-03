<template>
    <div class="product-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table table-image">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(product, index) in productList"
                                :key="index"
                            >
                                <th scope="row">{{ index + 1 }}</th>
                                <td class="w-25">
                                    <img
                                        :src="
                                            this.upload_path +
                                            '/image/' +
                                            product.image
                                        "
                                        class="img-fluid img-thumbnail"
                                        alt="Sheep"
                                    />
                                </td>
                                <td>{{ product.name }}</td>
                                <td>{{ product.category }}</td>
                                <td>{{ product.price }}</td>
                                <td>
                                    <div class="btn-group">
                                        <router-link
                                            :to="
                                                '/admin/edit-product/' +
                                                product.id
                                            "
                                            ><button class="btn btn-primary">
                                                Edit
                                            </button></router-link
                                        >
                                        <router-link
                                            :to="
                                                '/admin/view-product/' +
                                                product.id
                                            "
                                            ><button class="btn btn-info">
                                                View
                                            </button></router-link
                                        >
                                        <button
                                            class="btn btn-danger"
                                            @click.prevent="
                                                deleteProduct(product.id)
                                            "
                                        >
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";

export default {
    name: "Index",

    data() {
        return {
            productList: [],
        };
    },

    created() {
        this.getProductList();
    },

    methods: {
        getProductList() {
            const vm = this;
            axios
                .get(this.base_url + "/api/product-list")
                .then((res) => {
                    vm.productList = res.data.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        deleteProduct(id) {
            axios
                .delete(this.base_url + "/api/product-delete/" + id)
                .then((res) => {
                    console.log(res);
                    this.$router.go();
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
};
</script>