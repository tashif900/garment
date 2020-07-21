<template>
    <div class="container">
        <div class="card card-dark mt-3">
              <div class="card-header">
                <h3 class="card-title">Transaction</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" @submit.prevent="createTransaction()">
                <div class="card-body">
                    <div class="row">
                      <div class="form-group col-md-4">
                        <label>Client</label>
                        <input v-model="form.client_name" id="client_name" type="text" name="client_name" placeholder="Enter Quantity"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('client_name') }">
                        <has-error :form="form" field="client_name"></has-error>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Price</label>
                        <input v-model="form.price" id="price" type="text" name="price" placeholder="Enter Quantity"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('price') }">
                        <has-error :form="form" field="price"></has-error>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Discount</label>
                        <input v-model="form.discount" id="discount" type="text" name="discount" placeholder="Enter Quantity"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('discount') }">
                        <has-error :form="form" field="discount"></has-error>
                      </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button class="btn btn-dark" @click="showChild">Add</button>
                </div>
              </form>
            </div>


            <div class="card card-dark child">
              <div class="card-header">
                <h3 class="card-title">Add Details</h3>
              </div>
              <div class="card-body">
                <div class="row" v-for="(childs,index) in child">
                  <div class="form-group col-md-2">
                    <label>Product</label>
                    <select v-model="childs.product_id" id="product_id" name="product_id" class="form-control">
                      <option value="">Select Type</option>
                      <option v-for="product in products" :value="product.id">{{product.name}}</option>
                    </select>
                  </div>
                  <div class="form-group col-md-2">
                    <label>Quantity</label>
                    <input v-model="childs.quantity" id="quantity" type="text" name="quantity" placeholder="Enter Quantity"
                    class="form-control">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Color</label>
                    <input v-model="childs.color" id="color" type="text" name="color" placeholder="Enter Color"
                    class="form-control">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Price</label>
                    <input v-model="childs.price" id="price" type="text" name="price" placeholder="Enter Color"
                    class="form-control">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Discount</label>
                    <input v-model="childs.discount" id="discount" type="text" name="discount" placeholder="Enter Color"
                    class="form-control">
                  </div>
                  <div class="form-group col-md-2" style="margin-top:3%">
                    <button class="btn btn-info btn-sm" @click="addChild"><span class="fas fa-plus"></span></button>
                    <button class="btn btn-danger btn-sm" @click="deleteChild(index)"><span class="fas fa-minus"></span></button>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button class="btn btn-dark" @click="submit">Submit</button>
              </div>
            </div>
    </div>
</template>

<script>
    export default {
        data(){
          return{
            count:0,
            master_id:{},
            products:{},
            child:[
              {
                product_id:'',
                master_transaction_id:0,
                quantity:'',
                color:'',
                price:'',
                discount:'',
              }
            ],
            form: new Form({
              client_id: '',
              price:     '',
              discount:  ''
            })
          }
        },
        methods:{
            loadProduct(){
                axios.get('api/get_product').then(({data})=>(this.products = data))
            },
            showChild(){
               this.form.post('api/master_transaction').then(({data})=>{
                this.master_id = data;
                console.log(this.master_id);
                this.child[0].master_transaction_id = this.master_id;
                }
                );
              $('.child').show();
              this.count++;
            },
            addChild(){
              this.count++;
              this.child.push({
                product_id:'',
                master_transaction_id: this.master_id,
                quantity:'',
                color:'',
                price:'',
                discount:'',
              });
            },
            deleteChild(index){
              this.count--;
              this.child.splice(index,1);
            },
            submit(){
              this.$Progress.start();
              axios({
                url: 'api/child_transaction?count='+this.count,
                method: 'post',
                data: this.child
              }).then(()=>{
                Toast.fire({
                icon: 'success',
                title: 'Transaction Successfull'
                });
                this.$Progress.finish();
              }).then(()=>{
                this.child[0].product_id = '';
                this.child[0].master_transaction_id = '';
                this.child[0].quantity = '';
                this.child[0].color = '';
                this.child[0].price = '';
                this.child[0].discount = '';
                $('.child').hide();
              });
            }
        },
        mounted() {
            this.loadProduct();
            $('.child').hide();
        }
    };
</script>
