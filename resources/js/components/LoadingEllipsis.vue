<template>
  <div ref="wrapper" :class="$attrs.className">
    <div class="spinner-ellipsis-wrapper" style="transform: scale(0.5);">
      <div class="spinner-ellipsis">
        <div class="bg-gray-100"></div>
        <div class="bg-gray-200"></div>
        <div class="bg-gray-300"></div>
        <div class="bg-gray-200"></div>
        <div class="bg-gray-100"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
@keyframes ldio-p0haaj8s20g {
  0% {
    transform: translate(12px, 80px) scale(0);
  }
  25% {
    transform: translate(12px, 80px) scale(0);
  }
  50% {
    transform: translate(12px, 80px) scale(1);
  }
  75% {
    transform: translate(80px, 80px) scale(1);
  }
  100% {
    transform: translate(148px, 80px) scale(1);
  }
}
@keyframes ldio-p0haaj8s20g-r {
  0% {
    transform: translate(148px, 80px) scale(1);
  }
  100% {
    transform: translate(148px, 80px) scale(0);
  }
}

.spinner-ellipsis div {
  position: absolute;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  transform: translate(80px, 80px) scale(1);
  animation: ldio-p0haaj8s20g 1s infinite cubic-bezier(0, 0.5, 0.5, 1);
}
.spinner-ellipsis div:nth-child(1) {
  transform: translate(148px, 80px) scale(1);
  animation: ldio-p0haaj8s20g-r 0.25s infinite cubic-bezier(0, 0.5, 0.5, 1),
    ldio-p0haaj8s20g-c 1s infinite step-start;
}
.spinner-ellipsis div:nth-child(2) {
  animation-delay: -0.25s;
}
.spinner-ellipsis div:nth-child(3) {
  animation-delay: -0.5s;
}
.spinner-ellipsis div:nth-child(4) {
  animation-delay: -0.75s;
}
.spinner-ellipsis div:nth-child(5) {
  animation-delay: -1s;
}
.spinner-ellipsis-wrapper {
  width: 200px;
  height: 200px;
  display: inline-block;
  overflow: hidden;
}
.spinner-ellipsis {
  width: 100%;
  height: 100%;
  position: relative;
  transform: translateZ(0) scale(1);
  backface-visibility: hidden;
  transform-origin: 0 0; /* see note above */
}
.spinner-ellipsis div {
  box-sizing: content-box;
}
</style>