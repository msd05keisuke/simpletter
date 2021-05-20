<template>
  <span class="float-center">
    <button
      v-if="result"
      type="button"
      class="btn-sm shadow-none border border-primary p-2"
      @click="unfollow()"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        width="16"
        height="16"
        fill="currentColor"
        class="bi bi-check2"
        viewBox="0 0 16 16"
      >
        <path
          d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"
        />
      </svg>
      フォロー中
    </button>

    <button
      v-else
      type="button"
      class="btn-sm shadow-none border border-primary p-2 bg-primary text-white"
      @click="follow()"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        width="16"
        height="16"
        fill="currentColor"
        class="bi bi-plus"
        viewBox="0 0 16 16"
      >
        <path
          d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"
        />
      </svg>
      フォローする
    </button>
  </span>
</template>
<script>
export default {
  props: ["user"],
  data() {
    return {
      count: "",
      result: "false",
    };
  },
  beforeMount() {
    this.hasfollow();
    this.countfollow();
  },
  methods: {
    follow() {
      axios
        .get("/profile/follow/" + this.user.id)
        .then((res) => {
          this.result = res.data.result;
          this.count = res.data.count;
          //console.log(res.data.result);
          //console.log(res.data.count);
        })
        .catch((error) => {
          alert(error);
        });
    },
    unfollow() {
      axios
        .get("/profile/unfollow/" + this.user.id)
        .then((res) => {
          this.result = res.data.result;
          this.count = res.data.count;
          //console.log(res.data.result);
          //console.log(res.data.count);
        })
        .catch((error) => {
          alert(error);
        });
    },
    countfollow() {
      axios
        .get("/profile/countfollow/" + this.user.id)
        .then((res) => {
          this.count = res.data;
          //console.log(this.count = res.data)
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    hasfollow() {
      axios
        .get("/profile/hasfollow/" + this.user.id)
        .then((res) => {
          this.result = res.data;
          //console.log(res.data);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>