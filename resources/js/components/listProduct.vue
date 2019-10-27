<template>
    <div class="container">
        <div class="row justify-content-center" style="margin: 40px;">
            <form method="post" @submit.prevent="addProduct" class="row justify-content-center form-add-product">
                <div class="form-group">
                    <label for="">Nome</label>
                    <input type="text" class="form-control" v-model="product.name">
                </div>

                <div class="form-group">
                    <label for="">Quantidade</label>
                    <input type="text" class="form-control" v-model="product.amount">
                </div>

                <div class="form-group">
                    <label for="">Preço</label>
                    <input type="text" class="form-control" v-model="product.price">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Novo Produto
                    </button>
                </div>
            </form>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Price</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products" v-bind:key="product.id">
                        <td scope="row">{{product.name}}</td>
                        <td>{{product.amount}}</td>
                        <td>{{product.price}}</td>
                        <td>
                            <button type="button" class="btn btn-success" @click="showProduct(product.id)">
                                <i class="fa fa-pencil" ></i>
                            </button>
                            <button type="button" class="btn btn-danger" @click="deleteProduct(product.id)">
                                <i class="fa fa-trash" ></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</template>
<script>
    export default {
        mounted() {
            this.loadProducts();
        },
        data: () => {
            return {
                products: [],
                product: {
                    id: '',
                    name: '',
                    amount: '',
                    price: ''
                },
            }
        },
        methods: {
            loadProducts(){
                axios.get('/products').then(res => this.products = res.data)
            },
            addProduct(){
                axios
                    .post('/products/' + this.product.id, this.product)
                    .then(res =>  {
                            this.loadProducts();
                            this.product = '';
                        }
                    )
            },
            deleteProduct(id){
                axios.delete('/products/' + id)
                .then(res => {
                    this.loadProducts();
                })
            },
            showProduct(id){
                axios.get('/products/' + id)
                .then(res => {
                    let product = res.data;
                    this.product = product;
                })
            }
        },
    }
</script>
