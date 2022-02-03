<template>
    <div class="card">
        <div class="alert alert-success" role="alert" v-if="success.status">
            {{ success.message }}
        </div>

        <div class="card-header text-center">
            <h3>Update Product</h3>
        </div>

        <form class="card-body" @submit.prevent="updateProduct(product.id)">
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

                <img
                    :src="this.upload_path + '/image/' + product.image"
                    alt="image"
                    width="200"
                />
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</template>

<script>
export default {
    name: "Edit",

    data() {
        return {
            product: {},
            success: { status: false, message: "Data Updated Successfully" },
            errors: {},
        };
    },

    mounted() {
        this.editProduct(this.$route.params.id);
    },

    methods: {
        editProduct(id) {
            const self = this;
            axios
                .get(this.base_url + "/api/product-details/" + id)
                .then((res) => {
                    self.product = res.data.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        uploadImage(e) {
            this.product.image = e.target.files[0];
        },

        updateProduct(id) {
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
            data.append("_method", "put");

            axios
                .post(this.base_url + "/api/product-update/" + id, data, config)
                .then((res) => {
                    console.log(res.data);
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
