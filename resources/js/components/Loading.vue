<template>
  <div class="flex items-center justify-center flex-wrap">
    <div style="height: 60px;" class="relative w-full">
      <div class="icon" v-for="icon in icons" :key="icon.url">
        <span
          :class="`icon-bg bg-${bg || 'white'}`"
          :style="`background-image: url('${icon.url}'); background-size: ${icon.size};opacity:${icon.opacity};transform:rotateY(${rotation}deg);`"
        ></span>
      </div>
    </div>

    <div class="text-xl bg-white">Loading</div>
  </div>
</template>

<script>
export default {
  name: "loading",
  props: ["bg"],
  data() {
    return {
      current_icon: 0,
      rotation: 0,
      icons: [
        {
          url: "/svg/socks.svg",
          size: "100%"
        },
        {
          url: "/svg/tshirt-blank.svg",
          size: "100%"
        },
        {
          url: "/svg/sweats.svg",
          size: "100%"
        },
        {
          url: "/svg/jordan.svg",
          size: "100%"
        },
        {
          url: "/svg/tie.svg",
          size: "100%"
        },
        {
          url: "/svg/dress.svg",
          size: "100%"
        },
        {
          url: "/svg/boxers.svg",
          size: "100%"
        }
      ]
    };
  },
  mounted() {
    var setup = () => {
      this.draw();
      window.requestAnimationFrame(setup);
    };
    window.requestAnimationFrame(setup);
  },
  methods: {
    draw() {
      this.rotation = (this.rotation % 360) + 2;
      if (this.rotation == 90 || this.rotation == 270) {
        this.current_icon = (this.current_icon + 1) % this.icons.length;
        // this.rotation = 0;
      }
      this.icons.forEach(icon => (icon.opacity = 0));
      this.icons[this.current_icon].opacity = 1;
    }
  }
};
</script>

<style lang="scss" scoped>
.icon,
.icon-bg {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
}
.icon {
  height: 60px;
  width: 60px;
  left: 50%;
  right: 50%;
  transform: translateX(-50%);
}
.icon-bg {
  background-size: contain;
  background-position: center;
}
</style>