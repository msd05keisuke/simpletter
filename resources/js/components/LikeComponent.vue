<template>
  <div class="container">
    <div class="row justify-content-center mt-1">
      <div class="col-md-12">
        <div>
          <a href="javascript:void(0)" @click="unfavorite()" v-if='result'>
              <i class="fa fa-thumbs-up"> {{ count }}</i>
          </a>
          <a href="javascript:void(0)" @click="favorite()" class="u-link-v5 g-color-gray-dark-v4" v-else>
              <i class="fa fa-thumbs-up"> {{ count }}</i>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["blog"],
  data() {
    return {
      count: "",
      result: "false",
    };
  },
  mounted() {
    //最初にフォローしてるかしてないかの判定を行う
    this.hasfavorites();
    //いいねの数を取得する
    this.countfavorites();
  },
  methods: {
    favorite() {
      axios
        .post("/blog/favorite/" + this.blog.id)
        .then((res) => {
          this.result = res.data.result;
          this.count = res.data.count;
          //console.log(this.result)
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    unfavorite() {
      axios
        .post("/blog/unfavorite/" + this.blog.id)
        .then((res) => {
          this.result = res.data.result;
          this.count = res.data.count;
          //console.log(this.result)
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    countfavorites() {
      axios
        .get("/blog/countfavorite/" + this.blog.id)
        .then((res) => {
          this.count = res.data;
          //console.log(this.count = res.data)
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    hasfavorites() {
      axios
        .get("/blog/hasfavorite/" + this.blog.id)
        .then((res) => {
          this.result = res.data;
          //console.log(this.result)
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>