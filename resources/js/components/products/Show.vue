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
                            <td>Test Category</td>
                        </tr>

                        <tr>
                            <td>Photo</td>
                            <td>Photo Category</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    name: 'Show',

    data() {
        return {

            product: {
                name: "",
                category: "",
            },
        };
    },


    created() {
        this.showProducts();
      
      
    },

    methods: {
        showProducts() {
            const self = this;
            axios
                .get("http://127.0.0.1:8000/api/product-single/" + 1)
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
