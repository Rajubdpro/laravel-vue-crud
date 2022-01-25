<template>
    <div class="card">
        <div class="card-header text-center">
            <h3>Create New Product</h3>
        </div>

        <form class="card-body" @click="productSubmit">
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input
                    type="email"
                    class="form-control"
                    id="name"
                    aria-describedby="nameHelp"
                />
                <div id="nameHelp" class="form-text text-danger">
                    We'll never share your email with anyone else.
                </div>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select name="category" id="category" class="form-control">
                    <option value="man">Man</option>
                    <option value="whomen">Woman</option>
                    <option value="child">Child</option>
                    <option value="whiter">Winter</option>
                </select>
                <div id="nameHelp" class="form-text text-danger">
                    We'll never share your email with anyone else.
                </div>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Produc Image</label>
                <input
                    type="file"
                    class="form-control"
                    id="name"
                    aria-describedby="nameHelp"
                />
                <div id="nameHelp" class="form-text text-danger">
                    We'll never share your email with anyone else.
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>

export default {
    name: "Create",

    data() {

      return{
      
      }
     

    },

    methods:{
   
      productSubmit(e){
        alert(this.serealize());
      }
     
    },



};
</script>
