<template>
    <div class="container">
        <div style="margin: 10px;">
            <h1>Produtos</h1>
            <form method="post" @submit.prevent="storeProduct" style="margin: 20px;">
                <div class="form-group">
                    <label for="">Nome</label>
                    <input type="text" v-model="product.name">
                </div>

                <br>

                <div class="form-group">
                    <label for="">Quantidade</label>
                    <input type="number" v-model="product.amount" required style="margin-left: 10px !important; ">
                </div>

                <br>

                <div class="form-group">
                    <label for="">Preço</label>
                    <input type="number" v-model="product.price" required>
                </div>

                <small>{{error}}</small>

                <br>
                <br>

                <div class="form-group">
                    <button type="submit">
                        Cadastrar/Editar
                    </button>
                </div>
            </form>

            <table>
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
                            <button type="button" @click="showProduct(product.id)">
                                Editar
                            </button>
                            <button type="button" @click="deleteProduct(product.id)">
                                Remover
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
                error: "",
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
            storeProduct(){
                axios
                    .post('/products/' + this.product.id, this.product)
                    .then(res =>  {
                            if (res.data.error) {
                                this.error = res.data.error;
                            }
                            this.product.id = '';
                            this.product.name = '';
                            this.product.amount = '';
                            this.product.price = '';
                            this.loadProducts();
                        }
                    )
            },
            deleteProduct(id){
                axios.delete('/products/' + id)
                    .then(res => {
                            if (res.data.success == true) {
                                this.loadProducts()
                            }
                        }
                    )
            },
            showProduct(id){
                axios.get('/products/' + id)
                    .then(res => this.product = res.data)
            }
        },
    }
</script>
