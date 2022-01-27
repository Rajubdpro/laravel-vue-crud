<template>
    <div class="product-details">
        <div class="container">
            <div class="card">
                <div class="card-header text-center">
                    <h4>View Product Details</h4>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <td>Name</td>
                            <td>{{ product.name }}</td>
                        </tr>

                        <tr>
                            <td>Category</td>
                            <td>{{product.category}}</td>
                        </tr>

                        <tr>
                            <td>Description</td>
                            <td>
                                {{product.description}}
                            </td>
                        </tr>


                        <tr>
                            <td>Price</td>
                            <td>
                                {{product.price}}
                            </td>
                        </tr>


                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Show",

    data() {
        return {
            product: {},
        };
    },

    mounted() {
      
        this.showProducts(this.$route.params.id);
    },

    methods: {
        showProducts(id) {
            const self = this;
            axios
                .get("http://127.0.0.1:8000/api/product-single/" + id)
                .then((res) => {
                    self.product = res.data.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
};
</script>
