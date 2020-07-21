<template>
    <div class="container">
        <div class="row mt-3 ml-1">
            <h2>Dashboard</h2>
        </div>
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box light-blue">
              <span class="info-box-icon dark-blue"><i class="fas fa-envelope white"></i></span>

              <div class="info-box-content">
                <span class="info-box-text white">Messages</span>
                <span class="info-box-number white">
                  <number
                    ref="number1"
                    :from="0"
                    :to="messages_limit"
                    :duration="1"
                    :delay="2"
                    easing="Power2.easeOut"/>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box light-blue">
              <span class="info-box-icon dark-blue"><i class="fas fa-flag white"></i></span>

              <div class="info-box-content">
                <span class="info-box-text white">Bookmarks</span>
                <span class="info-box-number white">
                  <number
                    ref="number1"
                    :from="0"
                    :to="bookmarks_limit"
                    :duration="1"
                    :delay="2"
                    easing="Power2.easeOut"/>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box light-blue">
              <span class="info-box-icon dark-blue"><i class="fas fa-copy white"></i></span>

              <div class="info-box-content">
                <span class="info-box-text white">Uploads</span>
                <span class="info-box-number white">
                  <number
                    ref="number1"
                    :from="0"
                    :to="uploads_limit"
                    :duration="1"
                    :delay="2"
                    easing="Power2.easeOut"/>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box light-blue">
              <span class="info-box-icon dark-blue"><i class="fas fa-star white"></i></span>

              <div class="info-box-content">
                <span class="info-box-text white">Likes</span>
                <span class="info-box-number white">
                  <number
                    ref="number1"
                    :from="0"
                    :to="likes_limit"
                    :duration="1"
                    :delay="2"
                    easing="Power2.easeOut"/>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>


        <div class="row mt-2">
          <div class="col-sm-4">
            <div class="card">
              <div class="card-body">
                <line-chart :data="ChartData"></line-chart>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card">
              <div class="card-body">
                <pie-chart :donut="true" :data="ChartData"></pie-chart>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card">
              <div class="card-body">
                <column-chart :data="ChartData"></column-chart>
              </div>
            </div>
          </div>
        </div>

    </div>
</template>

<script>
    export default {
        data(){
            return{
                ChartData: {},
                messages_limit:'',
                bookmarks_limit:'',
                uploads_limit:'',
                likes_limit:''
            }
        },
        methods:{
          loadData(){
              axios.get('api/chart_data')
              .then(({data})=>{
                  this.ChartData = {
                      "admin" :data[0].user_count,
                      "user"  :data[1].user_count
                  }
                })
          },
          loadNumber(){
              axios.get('api/get_number')
              .then(({data})=>{
                this.messages_limit = data.messages_limit;
                this.bookmarks_limit = data.bookmarks_limit;
                this.uploads_limit = data.uploads_limit;
                this.likes_limit = data.likes_limit;
              })
          }
        },
        mounted() {
          this.loadNumber();
          this.loadData();
        }
    };
</script>
