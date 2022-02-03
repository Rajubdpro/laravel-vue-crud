<template>
    <div class="card">
        <div class="alert alert-success" role="alert" v-if="success.status">
            {{ success.message }}
        </div>

        <div class="card-header text-center">
            <h3>Create New Product</h3>
        </div>

        <form class="card-body" @submit.prevent="productSubmit">
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input
                    type="text"
                    class="form-control"
                    id="name"
                    v-model="product.name"
                    aria-describedby="nameHelp"
                />
                <div class="form-text text-danger" v-if="errors && errors.name">
                    {{ errors.name[0] }}
                </div>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select
                    id="category"
                    class="form-control"
                    v-model="product.category"
                >
                    <option value="man">Man</option>
                    <option value="whomen">Woman</option>
                    <option value="child">Child</option>
                    <option value="whiter">Winter</option>
                </select>
                <div
                    class="form-text text-danger"
                    v-if="errors && errors.category"
                >
                    {{ errors.category[0] }}
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label"
                    >Product Description</label
                >
                <textarea
                    class="form-control"
                    id="description"
                    aria-describedby="nameHelp"
                    v-model="product.description"
                ></textarea>
                <div
                    class="form-text text-danger"
                    v-if="errors && errors.description"
                >
                    {{ errors.description[0] }}
                </div>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Product Price</label>
                <input
                    type="number"
                    class="form-control"
                    id="price"
                    aria-describedby="nameHelp"
                    v-model="product.price"
                />
                <div
                    class="form-text text-danger"
                    v-if="errors && errors.price"
                >
                    {{ errors.price[0] }}
                </div>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Produc Image</label>
                <input
                    type="file"
                    class="form-control"
                    id="image"
                    aria-describedby="nameHelp"
                    v-on:change="uploadImage"
                />
                <div
                    class="form-text text-danger"
                    v-if="errors && errors.image"
                >
                    {{ errors.image[0] }}
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Create",

    data() {
        return {
            product: {
                name: "",
                category: "",
                description: "",
                price: "",
                image: "",
            },
            success: { status: false, message: "Data Created Successfully." },
            errors: {},
        };
    },

    created() {
        console.log(this.base_url);
    },

    methods: {
        uploadImage(e) {
            this.product.image = e.target.files[0];
        },

        productSubmit() {

            // Add Header to Upload Image.
            let config = {
                header: {
                    "Content-Type": "multipart/form-data",
                },
            };

            let data = new FormData();
            data.append("name", this.product.name);
            data.append("category", this.product.category);
            data.append("description", this.product.description);
            data.append("price", this.product.price);
            data.append("image", this.product.image);

            console.log(data);

            axios
                .post(this.base_url + "/api/product-create", data, config)
                .then((res) => {
                    console.log(res.data);
                    console.log(res.data.message);
                    this.product = "";
                    this.success.status = true;
                })
                .catch((err) => {
                    console.log(err);
                    if ((err.response.status = 422)) {
                        this.errors = err.response.data.errors;
                    }
                });
        },
    },
};
</script>
