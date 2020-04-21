<template>
  <div class="relative">
    <transition
      :name="`slide-${direction}`"
      tag="div"
      mode="out-in"
      :duration="{enter: duration, leave: duration}"
    >
      <slot></slot>
    </transition>
  </div>
</template>

<script>
export default {
  props: {
    direction: {
      default: "right"
    },
    duration: {
      default: 300
    }
  }
};
</script>

<style>
.slide-left-enter-active,
.slide-right-enter-active,
.slide-left-leave-active,
.slide-right-leave-active {
  transition: all 0.3s ease;
}

.slide-left-enter,
.slide-right-leave-to {
  transform: translateX(110%);
  opacity: 0;
}

.slide-left-enter-to,
.slide-right-leave,
.slide-right-enter-to,
.slide-left-leave {
  transform: translateX(0%);
  opacity: 1;
}

.slide-left-leave-to,
.slide-right-enter {
  transform: translateX(-110%);
  opacity: 0;
}
</style>